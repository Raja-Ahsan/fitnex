<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\TrainerGoogleAccount;
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
        $this->client = new GoogleClient();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect'));
        $this->client->addScope(GoogleCalendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
    }

    /**
     * Show Google Calendar connection page.
     */
    public function index()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $googleAccount = $trainer->googleAccount;

        return view('trainer.google.connect', compact('trainer', 'googleAccount'));
    }

    /**
     * Redirect to Google OAuth consent screen.
     */
    public function connect()
    {
        $authUrl = $this->client->createAuthUrl();
        return redirect($authUrl);
    }

    /**
     * Handle OAuth callback from Google.
     */
    public function callback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect()->route('trainer.google.index')
                ->with('error', 'Authorization failed. Please try again.');
        }

        try {
            $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

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

            // Save or update Google account
            TrainerGoogleAccount::updateOrCreate(
                ['trainer_id' => $trainer->id],
                [
                    'access_token' => $token['access_token'],
                    'refresh_token' => $token['refresh_token'] ?? null,
                    'token_expiry' => now()->addSeconds($token['expires_in']),
                    'calendar_id' => $primaryCalendar->getId(),
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
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $googleAccount = $trainer->googleAccount;

        if ($googleAccount) {
            // Revoke token
            try {
                $this->client->setAccessToken($googleAccount->access_token);
                $this->client->revokeToken();
            } catch (Exception $e) {
                // Continue even if revoke fails
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

    /**
     * Test calendar connection.
     */
    public function test()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $googleAccount = $trainer->googleAccount;

        if (!$googleAccount || !$googleAccount->isValid()) {
            return redirect()->route('trainer.google.index')
                ->with('error', 'Google Calendar is not connected.');
        }

        try {
            $this->client->setAccessToken($googleAccount->access_token);

            // Check if token is expired
            if ($this->client->isAccessTokenExpired()) {
                if ($googleAccount->refresh_token) {
                    $newToken = $this->client->fetchAccessTokenWithRefreshToken($googleAccount->refresh_token);
                    $googleAccount->update([
                        'access_token' => $newToken['access_token'],
                        'token_expiry' => now()->addSeconds($newToken['expires_in']),
                    ]);
                } else {
                    throw new Exception('Token expired and no refresh token available');
                }
            }

            $calendarService = new GoogleCalendar($this->client);
            $calendar = $calendarService->calendars->get($googleAccount->calendar_id);

            return redirect()->route('trainer.google.index')
                ->with('success', 'Connection successful! Calendar: ' . $calendar->getSummary());
        } catch (Exception $e) {
            return redirect()->route('trainer.google.index')
                ->with('error', 'Connection test failed: ' . $e->getMessage());
        }
    }
}
