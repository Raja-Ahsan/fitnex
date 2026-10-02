<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\TrainerGoogleCalendarReminderMail;
use App\Models\Appointment;
use App\Models\CentralGoogleAccount;
use App\Models\Trainer;
use App\Models\User;
use App\Notifications\TrainerGoogleCalendarReminderNotification;
use App\Services\GoogleCalendarSettings;
use App\Services\TrainerGoogleCalendar;
use Google\Service\Calendar as GoogleCalendar;
use Google\Service\Oauth2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class GoogleCalendarAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless(Auth::user() && Auth::user()->isAdmin(), 403);

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $page_title = 'Google Calendar';
        $filter = $request->query('filter', 'all');

        $trainers = Trainer::with(['user', 'googleAccount'])
            ->whereHas('user')
            ->orderByDesc('id')
            ->get();

        $isConnected = fn (Trainer $trainer) => $trainer->googleAccount && $trainer->googleAccount->is_connected;

        $connectedCount = $trainers->filter($isConnected)->count();
        $totalCount = $trainers->count();

        if ($filter === 'connected') {
            $trainers = $trainers->filter($isConnected)->values();
        } elseif ($filter === 'not_connected') {
            $trainers = $trainers->reject($isConnected)->values();
        }

        $stored = GoogleCalendarSettings::stored();
        $settings = [
            'client_id' => $stored['google_client_id'] ?: config('services.google.client_id'),
            'redirect_uri' => $stored['google_redirect_uri'] ?: config('services.google.redirect') ?: url('/trainer/google/callback'),
            'login_redirect_uri' => $stored['google_login_redirect_uri'] ?: config('services.google.login_redirect'),
            'secret_mask' => GoogleCalendarSettings::maskedSecret(),
            'source' => $stored['google_client_id'] ? 'dashboard' : (config('services.google.client_id') ? 'env' : 'none'),
        ];

        $configured = google_oauth_configured();
        $suggestedRedirects = array_values(array_unique(array_filter([
            $settings['redirect_uri'],
            url('/trainer/google/callback'),
            'https://fitnexusa.com/trainer/google/callback',
        ])));

        $central = CentralGoogleAccount::current();
        $centralConnected = $central && $central->is_connected;
        $centralSyncedCount = Appointment::whereNotNull('central_google_event_id')->count();

        return view('admin.google_calendar.index', compact(
            'page_title',
            'trainers',
            'connectedCount',
            'totalCount',
            'filter',
            'settings',
            'configured',
            'suggestedRedirects',
            'central',
            'centralConnected',
            'centralSyncedCount'
        ));
    }

    public const CENTRAL_STATE_KEY = 'google_central_oauth_state';

    public function centralConnect(TrainerGoogleCalendar $calendar)
    {
        $client = $calendar->oauthClient();
        if (!$client) {
            return back()->with('error', 'Save the Google Calendar settings first.');
        }

        $state = 'central:' . Str::random(40);
        session([self::CENTRAL_STATE_KEY => $state]);

        $client->addScope('email');
        $client->setPrompt('consent select_account');
        $client->setState($state);

        $hint = config('google-calendar.calendar_id');
        if (is_string($hint) && filter_var(trim($hint), FILTER_VALIDATE_EMAIL)) {
            $client->setLoginHint(trim($hint));
        }

        return redirect()->away($client->createAuthUrl());
    }

    /**
     * Called from the shared Google callback when the state belongs to the central flow.
     */
    public function centralCallback(Request $request, TrainerGoogleCalendar $calendar)
    {
        $expected = session()->pull(self::CENTRAL_STATE_KEY);
        $back = redirect()->route('admin.google-calendar.index');

        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        if (!$expected || !hash_equals($expected, (string) $request->query('state'))) {
            return $back->with('error', 'The Google sign-in expired. Please click Connect again.');
        }

        if ($request->query('error')) {
            return $back->with('warning', 'The FITNEX calendar was not connected because Google access was denied.');
        }

        $client = $calendar->oauthClient();
        if (!$client || !$request->query('code')) {
            return $back->with('error', 'Google authorization failed. Please try again.');
        }

        try {
            $token = $client->fetchAccessTokenWithAuthCode($request->query('code'));
            if (isset($token['error'])) {
                throw new \RuntimeException($token['error_description'] ?? $token['error']);
            }

            $client->setAccessToken($token);

            $email = null;
            try {
                $email = (new Oauth2($client))->userinfo->get()->getEmail();
            } catch (Throwable $e) {
                Log::info('Central Google Calendar: could not read account email: ' . $e->getMessage());
            }

            $primary = collect((new GoogleCalendar($client))->calendarList->listCalendarList()->getItems())
                ->firstWhere('primary', true);

            $existing = CentralGoogleAccount::current();
            $data = [
                'google_email' => $email ?? ($primary ? $primary->getId() : null),
                'access_token' => $token['access_token'],
                'refresh_token' => $token['refresh_token'] ?? $existing?->refresh_token,
                'token_expiry' => now()->addSeconds((int) ($token['expires_in'] ?? 3600)),
                'calendar_id' => $primary ? $primary->getId() : 'primary',
                'is_connected' => true,
                'connected_by' => Auth::id(),
            ];

            $existing ? $existing->update($data) : CentralGoogleAccount::create($data);
        } catch (Throwable $e) {
            Log::error('Central Google Calendar connect failed: ' . $e->getMessage());

            return $back->with('error', 'Could not connect the FITNEX calendar: ' . $e->getMessage());
        }

        return $back->with('message', 'FITNEX calendar connected. New bookings will now appear in it — use "Sync upcoming bookings" to add existing ones.');
    }

    public function centralDisconnect(TrainerGoogleCalendar $calendar)
    {
        $account = CentralGoogleAccount::current();

        if ($account) {
            $client = $calendar->oauthClient();
            if ($client && $account->access_token) {
                try {
                    $client->revokeToken($account->access_token);
                } catch (Throwable $e) {
                    // The local disconnect still applies if Google is unreachable.
                }
            }

            $account->update(['is_connected' => false, 'access_token' => null, 'refresh_token' => null]);
        }

        return back()->with('message', 'FITNEX calendar disconnected. Bookings will no longer be copied to it.');
    }

    public function centralTest(TrainerGoogleCalendar $calendar)
    {
        $account = $calendar->centralAccount();
        if (!$account) {
            return back()->with('error', 'The FITNEX calendar is not connected.');
        }

        $summary = $calendar->calendarSummary($account);

        return $summary === null
            ? back()->with('error', 'Google rejected the saved connection. Please disconnect and connect again.')
            : back()->with('message', "Connection works. Calendar: {$summary}");
    }

    public function centralSync(TrainerGoogleCalendar $calendar)
    {
        if (!$calendar->centralAccount()) {
            return back()->with('error', 'Connect the FITNEX calendar first.');
        }

        $appointments = Appointment::with('trainer.user')
            ->whereDate('appointment_date', '>=', now()->toDateString())
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        $synced = 0;
        foreach ($appointments as $appointment) {
            $label = $appointment->status === 'confirmed'
                ? 'Confirmed'
                : ($appointment->payment_status === 'pending' ? 'Pending Payment' : 'Pending');

            if ($calendar->syncCentralAppointment($appointment, $label)) {
                $synced++;
            }
        }

        if ($appointments->isEmpty()) {
            return back()->with('info', 'There are no upcoming bookings to sync.');
        }

        $failed = $appointments->count() - $synced;

        return $failed > 0
            ? back()->with('warning', "Synced {$synced} booking(s); {$failed} failed. Check the logs.")
            : back()->with('message', "Synced {$synced} upcoming booking(s) to the FITNEX calendar.");
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'google_client_id' => ['required', 'string', 'max:255', 'regex:/\.apps\.googleusercontent\.com$/'],
            'google_client_secret' => ['nullable', 'string', 'max:255'],
            'google_redirect_uri' => ['required', 'url', 'max:255'],
            'google_login_redirect_uri' => ['nullable', 'url', 'max:255'],
        ], [
            'google_client_id.regex' => 'Client ID should end with .apps.googleusercontent.com',
        ]);

        if (empty($data['google_client_secret'])) {
            if (!config('services.google.client_secret')) {
                return back()->withInput()->with('error', 'Please enter the Google Client Secret.');
            }
            unset($data['google_client_secret']);
        }

        GoogleCalendarSettings::save($data);

        return redirect()->route('admin.google-calendar.index')
            ->with('message', 'Google Calendar settings saved. Trainers can now connect their calendars.');
    }

    public function remind(Trainer $trainer)
    {
        $user = $trainer->user;

        if (!$user || !$user->email) {
            return back()->with('error', 'This trainer has no email address.');
        }

        if (!google_oauth_configured()) {
            return back()->with('error', 'Save the Google Calendar settings first, then send reminders.');
        }

        $this->notifyInDashboard($user);

        try {
            Mail::to($user->email)->send(new TrainerGoogleCalendarReminderMail($user));
        } catch (Throwable $e) {
            Log::error("Google Calendar reminder failed for trainer {$trainer->id}: " . $e->getMessage());

            return back()->with('warning', 'Dashboard notification sent, but the email could not be sent. Check the mail settings.');
        }

        return back()->with('message', "Reminder sent to {$user->email} and shown in their dashboard.");
    }

    private function notifyInDashboard(User $user): void
    {
        try {
            $user->notify(new TrainerGoogleCalendarReminderNotification());
        } catch (Throwable $e) {
            Log::error("Google Calendar dashboard notification failed for user {$user->id}: " . $e->getMessage());
        }
    }

    public function remindAll()
    {
        if (!google_oauth_configured()) {
            return back()->with('error', 'Save the Google Calendar settings first, then send reminders.');
        }

        $trainers = Trainer::with(['user', 'googleAccount'])
            ->where('status', 1)
            ->whereHas('user')
            ->get()
            ->reject(fn (Trainer $trainer) => $trainer->googleAccount && $trainer->googleAccount->is_connected);

        $sent = 0;
        $failed = 0;

        foreach ($trainers as $trainer) {
            if (!$trainer->user->email) {
                continue;
            }

            $this->notifyInDashboard($trainer->user);

            try {
                Mail::to($trainer->user->email)->send(new TrainerGoogleCalendarReminderMail($trainer->user));
                $sent++;
            } catch (Throwable $e) {
                $failed++;
                Log::error("Google Calendar reminder failed for trainer {$trainer->id}: " . $e->getMessage());
            }
        }

        if ($sent === 0 && $failed === 0) {
            return back()->with('info', 'All active trainers have already connected Google Calendar.');
        }

        $message = "Reminder emailed to {$sent} trainer(s) and shown in their dashboards.";
        if ($failed > 0) {
            return back()->with('warning', $message . " {$failed} email(s) failed, but those trainers still got the dashboard notification. Check the mail settings.");
        }

        return back()->with('message', $message);
    }
}
