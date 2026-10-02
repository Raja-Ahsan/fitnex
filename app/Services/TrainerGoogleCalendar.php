<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\CentralGoogleAccount;
use App\Models\Trainer;
use App\Models\TrainerGoogleAccount;
use Carbon\Carbon;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;
use Google\Service\Calendar\Event as GoogleEvent;
use Google\Service\Calendar\EventDateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Writes booking events to Google Calendar using saved OAuth tokens:
 * the trainer's own calendar (TrainerGoogleAccount) and the FITNEX
 * central calendar (CentralGoogleAccount).
 */
class TrainerGoogleCalendar
{
    public function connectedAccount(?Trainer $trainer): ?TrainerGoogleAccount
    {
        if (!$trainer || !google_oauth_configured()) {
            return null;
        }

        $account = $trainer->googleAccount;

        if (!$account || !$account->is_connected || !$account->access_token) {
            return null;
        }

        return $account;
    }

    public function centralAccount(): ?CentralGoogleAccount
    {
        if (!google_oauth_configured()) {
            return null;
        }

        try {
            $account = CentralGoogleAccount::current();
        } catch (Throwable $e) {
            return null;
        }

        if (!$account || !$account->is_connected || !$account->access_token) {
            return null;
        }

        return $account;
    }

    public function createEvent(
        Model $account,
        string $title,
        Carbon $start,
        Carbon $end,
        string $description = '',
        array $attendees = []
    ): ?string {
        $service = $this->calendarService($account);
        if (!$service) {
            return null;
        }

        $event = new GoogleEvent([
            'summary' => $title,
            'description' => $description,
        ]);
        $event->setStart($this->eventTime($start));
        $event->setEnd($this->eventTime($end));

        $emails = collect($attendees)
            ->map(fn ($item) => is_array($item) ? ($item['email'] ?? null) : $item)
            ->filter(fn ($email) => is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
            ->unique()
            ->map(fn ($email) => ['email' => $email])
            ->values()
            ->all();

        if ($emails !== []) {
            $event->setAttendees($emails);
        }

        try {
            $created = $service->events->insert($this->calendarId($account), $event);

            return $created->getId();
        } catch (Throwable $e) {
            Log::error("Google Calendar create failed ({$this->label($account)}): " . $e->getMessage());

            return null;
        }
    }

    public function updateEvent(Model $account, string $eventId, array $data): bool
    {
        $service = $this->calendarService($account);
        if (!$service) {
            return false;
        }

        try {
            $calendarId = $this->calendarId($account);
            $event = $service->events->get($calendarId, $eventId);

            if (isset($data['title'])) {
                $event->setSummary($data['title']);
            }
            if (isset($data['description'])) {
                $event->setDescription($data['description']);
            }
            if (isset($data['start']) && $data['start'] instanceof Carbon) {
                $event->setStart($this->eventTime($data['start']));
            }
            if (isset($data['end']) && $data['end'] instanceof Carbon) {
                $event->setEnd($this->eventTime($data['end']));
            }

            $service->events->update($calendarId, $eventId, $event);

            return true;
        } catch (Throwable $e) {
            Log::warning("Google Calendar update failed ({$this->label($account)}, event {$eventId}): " . $e->getMessage());

            return false;
        }
    }

    public function deleteEvent(Model $account, string $eventId): bool
    {
        $service = $this->calendarService($account);
        if (!$service) {
            return false;
        }

        try {
            $service->events->delete($this->calendarId($account), $eventId);

            return true;
        } catch (Throwable $e) {
            Log::warning("Google Calendar delete failed ({$this->label($account)}, event {$eventId}): " . $e->getMessage());

            return false;
        }
    }

    /**
     * Create or update the calendar events for a website appointment.
     * Always copies it to the central calendar when that is connected.
     * Returns false when the trainer has not connected Google Calendar.
     */
    public function syncAppointment(Appointment $appointment, string $statusLabel): bool
    {
        $this->syncCentralAppointment($appointment, $statusLabel);

        $account = $this->connectedAccount($appointment->trainer);

        if (!$account) {
            return false;
        }

        [$start, $end] = $this->appointmentTimes($appointment);

        $title = 'FITNEX session with ' . ($appointment->name ?: 'client');
        if ($statusLabel !== 'Confirmed') {
            $title .= " ({$statusLabel})";
        }

        $description = $this->appointmentDescription($appointment, $statusLabel);

        if ($appointment->google_calendar_event_id) {
            $updated = $this->updateEvent($account, $appointment->google_calendar_event_id, [
                'title' => $title,
                'description' => $description,
                'start' => $start,
                'end' => $end,
            ]);

            if ($updated) {
                return true;
            }
        }

        $eventId = $this->createEvent($account, $title, $start, $end, $description, [$appointment->email]);

        if ($eventId) {
            $appointment->google_calendar_event_id = $eventId;
            $appointment->saveQuietly();
        }

        return true;
    }

    public function syncCentralAppointment(Appointment $appointment, string $statusLabel): bool
    {
        $account = $this->centralAccount();

        if (!$account) {
            return false;
        }

        [$start, $end] = $this->appointmentTimes($appointment);

        $trainerName = $this->trainerName($appointment);
        $title = ($appointment->name ?: 'Client') . ' with ' . $trainerName;
        if ($statusLabel !== 'Confirmed') {
            $title .= " ({$statusLabel})";
        }

        $description = 'Trainer: ' . $trainerName . "\n" . $this->appointmentDescription($appointment, $statusLabel);

        if ($appointment->central_google_event_id) {
            $updated = $this->updateEvent($account, $appointment->central_google_event_id, [
                'title' => $title,
                'description' => $description,
                'start' => $start,
                'end' => $end,
            ]);

            if ($updated) {
                return true;
            }
        }

        $eventId = $this->createEvent($account, $title, $start, $end, $description);

        if (!$eventId) {
            return false;
        }

        $appointment->central_google_event_id = $eventId;
        $appointment->saveQuietly();

        return true;
    }

    public function removeAppointment(Appointment $appointment): void
    {
        $this->removeCentralAppointment($appointment);

        if (!$appointment->google_calendar_event_id) {
            return;
        }

        $account = $this->connectedAccount($appointment->trainer);
        if (!$account) {
            return;
        }

        if ($this->deleteEvent($account, $appointment->google_calendar_event_id)) {
            $appointment->google_calendar_event_id = null;
            $appointment->saveQuietly();
        }
    }

    public function removeCentralAppointment(Appointment $appointment): void
    {
        if (!$appointment->central_google_event_id) {
            return;
        }

        $account = $this->centralAccount();
        if (!$account) {
            return;
        }

        if ($this->deleteEvent($account, $appointment->central_google_event_id)) {
            $appointment->central_google_event_id = null;
            $appointment->saveQuietly();
        }
    }

    public function calendarSummary(Model $account): ?string
    {
        $service = $this->calendarService($account);
        if (!$service) {
            return null;
        }

        try {
            return $service->calendars->get($this->calendarId($account))->getSummary();
        } catch (Throwable $e) {
            Log::warning("Google Calendar test failed ({$this->label($account)}): " . $e->getMessage());

            return null;
        }
    }

    protected function appointmentTimes(Appointment $appointment): array
    {
        $start = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);

        return [$start, $start->copy()->addMinutes(60)];
    }

    protected function appointmentDescription(Appointment $appointment, string $statusLabel): string
    {
        $description = 'Client: ' . ($appointment->name ?: '-') . "\n";
        $description .= 'Email: ' . ($appointment->email ?: '-') . "\n";
        if ($appointment->phone) {
            $description .= 'Phone: ' . $appointment->phone . "\n";
        }
        $description .= 'Status: ' . $statusLabel . "\n";
        if ($appointment->description) {
            $description .= "\nNotes: " . $appointment->description;
        }

        return $description;
    }

    protected function trainerName(Appointment $appointment): string
    {
        $user = $appointment->trainer?->user;
        $name = trim(($user->name ?? '') . ' ' . ($user->last_name ?? ''));

        return $name !== '' ? $name : ($appointment->trainer->name ?? 'trainer');
    }

    protected function calendarService(Model $account): ?GoogleCalendar
    {
        $client = $this->clientFor($account);

        return $client ? new GoogleCalendar($client) : null;
    }

    public function oauthClient(): ?GoogleClient
    {
        if (!google_oauth_configured()) {
            return null;
        }

        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->addScope(GoogleCalendar::CALENDAR);
        $client->setAccessType('offline');

        return $client;
    }

    protected function clientFor(Model $account): ?GoogleClient
    {
        $client = $this->oauthClient();
        if (!$client) {
            return null;
        }

        $expiresIn = $account->token_expiry ? max(0, now()->diffInSeconds($account->token_expiry, false)) : 0;
        $client->setAccessToken([
            'access_token' => $account->access_token,
            'refresh_token' => $account->refresh_token,
            'expires_in' => (int) $expiresIn,
            'created' => time(),
        ]);

        if ($client->isAccessTokenExpired()) {
            if (!$account->refresh_token) {
                Log::warning("Google token expired and no refresh token is stored ({$this->label($account)}). Reconnect required.");

                return null;
            }

            try {
                $token = $client->fetchAccessTokenWithRefreshToken($account->refresh_token);
            } catch (Throwable $e) {
                Log::error("Google token refresh failed ({$this->label($account)}): " . $e->getMessage());

                return null;
            }

            if (isset($token['error'])) {
                Log::warning("Google token refresh rejected ({$this->label($account)}): " . ($token['error_description'] ?? $token['error']));
                $account->update(['is_connected' => false]);

                return null;
            }

            $account->update([
                'access_token' => $token['access_token'],
                'token_expiry' => now()->addSeconds((int) ($token['expires_in'] ?? 3600)),
            ]);
        }

        return $client;
    }

    protected function calendarId(Model $account): string
    {
        return $account->calendar_id ?: 'primary';
    }

    protected function label(Model $account): string
    {
        return $account instanceof CentralGoogleAccount ? 'central calendar' : "trainer {$account->trainer_id}";
    }

    protected function eventTime(Carbon $time): EventDateTime
    {
        return new EventDateTime([
            'dateTime' => $time->toRfc3339String(),
            'timeZone' => config('app.timezone', 'UTC'),
        ]);
    }
}
