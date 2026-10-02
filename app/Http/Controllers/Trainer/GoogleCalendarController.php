<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\TrainerGoogleAccount;
use App\Services\TrainerGoogleCalendar;
use App\Services\TrainerProfileSync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;
use Exception;

class GoogleCalendarController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->middleware('auth');
        $this->initializeGoogleClient();
    }

    protected function initializeGoogleClient()
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');
        $redirectUri = config('services.google.redirect');

        if (!$clientId || !$clientSecret) {
            return;
        }

        $this->client = new GoogleClient();
        $this->client->setClientId($clientId);
        $this->client->setClientSecret($clientSecret);
        $this->client->setRedirectUri($redirectUri);
        $this->client->addScope(GoogleCalendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
    }

    /**
     * Show Google Calendar connection page.
     */
    public function index()
    {
        $trainer = TrainerProfileSync::resolveTrainer(Auth::user());
        $googleAccount = $trainer->googleAccount;

        $googleConfigured = google_oauth_configured();

        if (!$googleConfigured) {
            $message = $this->userIsAdmin()
                ? 'Google Calendar is not configured yet. Add the Google keys in Admin → Google Calendar.'
                : 'Google Calendar sync is not available yet. Please contact FITNEX support.';
            session()->now('warning', $message);
        }

        return view('trainer.google.connect', compact('trainer', 'googleAccount', 'googleConfigured'));
    }

    /**
     * Redirect to Google OAuth consent screen.
     */
    public function connect()
    {
        if (!$this->client || !google_oauth_configured()) {
            return redirect()->route('trainer.google.index')
                ->with('warning', 'Google Calendar is not set up on this site yet. Please contact FITNEX support.');
        }

        $authUrl = $this->client->createAuthUrl();
        return redirect($authUrl);
    }

    /**
     * Handle OAuth callback from Google.
     */
    public function callback(Request $request)
    {
        if (str_starts_with((string) $request->query('state'), 'central:')) {
            return app(\App\Http\Controllers\admin\GoogleCalendarAdminController::class)
                ->centralCallback($request, app(TrainerGoogleCalendar::class));
        }

        if ($request->query('error') === 'access_denied') {
            return redirect()->route('trainer.google.index')
                ->with('warning', 'Google Calendar was not connected because access was denied.');
        }

        if (!$request->has('code') || !$this->client) {
            return redirect()->route('trainer.google.index')
                ->with('error', 'Authorization failed. Please try again.');
        }

        try {
            $trainer = TrainerProfileSync::resolveTrainer(Auth::user());

            // Exchange authorization code for access token
            $token = $this->client->fetchAccessTokenWithAuthCode($request->code);

            if (isset($token['error'])) {
                throw new Exception($token['error_description'] ?? 'Failed to get access token');
            }

            // Get calendar ID (primary calendar)
            $this->client->setAccessToken($token);
            $calendarService = new GoogleCalendar($this->client);
            $calendarList = $calendarService->calendarList->listCalendarList();
            $primaryCalendar = collect($calendarList->getItems())->firstWhere('primary', true);

            $existing = TrainerGoogleAccount::where('trainer_id', $trainer->id)->first();

            // Google only returns a refresh token on first consent; keep the stored one on reconnect.
            TrainerGoogleAccount::updateOrCreate(
                ['trainer_id' => $trainer->id],
                [
                    'access_token' => $token['access_token'],
                    'refresh_token' => $token['refresh_token'] ?? $existing?->refresh_token,
                    'token_expiry' => now()->addSeconds((int) ($token['expires_in'] ?? 3600)),
                    'calendar_id' => $primaryCalendar ? $primaryCalendar->getId() : 'primary',
                    'is_connected' => true,
                ]
            );

            return redirect()->route('trainer.google.index')
                ->with('success', 'Google Calendar connected successfully!');
        } catch (Exception $e) {
            return redirect()->route('trainer.google.index')
                ->with('error', 'Failed to connect Google Calendar: ' . $e->getMessage());
        }
    }

    /**
     * Disconnect Google Calendar.
     */
    public function disconnect()
    {
        $trainer = TrainerProfileSync::resolveTrainer(Auth::user());
        $googleAccount = $trainer->googleAccount;

        if ($googleAccount) {
            if ($this->client && $googleAccount->access_token) {
                try {
                    $this->client->setAccessToken($googleAccount->access_token);
                    $this->client->revokeToken();
                } catch (Exception $e) {
                    // Continue even if revoke fails
                }
            }

            $googleAccount->update([
                'is_connected' => false,
                'access_token' => null,
                'refresh_token' => null,
            ]);
        }

        return redirect()->route('trainer.google.index')
            ->with('success', 'Google Calendar disconnected successfully.');
    }

    protected function userIsAdmin(): bool
    {
        $user = Auth::user();

        return $user && $user->isAdmin();
    }

    /**
     * Test calendar connection.
     */
    public function test(TrainerGoogleCalendar $trainerCalendar)
    {
        $trainer = TrainerProfileSync::resolveTrainer(Auth::user());
        $googleAccount = $trainerCalendar->connectedAccount($trainer);

        if (!$googleAccount) {
            return redirect()->route('trainer.google.index')
                ->with('error', 'Google Calendar is not connected.');
        }

        try {
            $calendar = $trainerCalendar->calendarSummary($googleAccount);

            if ($calendar === null) {
                throw new Exception('Google rejected the saved connection. Please disconnect and connect again.');
            }

            return redirect()->route('trainer.google.index')
                ->with('success', 'Connection successful! Calendar: ' . $calendar);
        } catch (Exception $e) {
            return redirect()->route('trainer.google.index')
                ->with('error', 'Connection test failed: ' . $e->getMessage());
        }
    }
}
