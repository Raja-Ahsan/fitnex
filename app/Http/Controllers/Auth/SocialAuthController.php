<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TrainerProfileSync;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialAuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        if (!google_login_oauth_configured()) {
            return redirect()->route('login')->with('error', 'Google sign-in is not configured yet. Add GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET in .env, then run php artisan config:clear.');
        }

        config(['services.google.redirect' => config('services.google.login_redirect')]);

        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        if (!google_login_oauth_configured()) {
            return redirect()->route('login')->with('error', 'Google sign-in is not configured yet.');
        }

        config(['services.google.redirect' => config('services.google.login_redirect')]);

        try {
            $socialUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Google sign-in was cancelled or failed. Please try again.');
        }

        return $this->loginSocialUser($socialUser, 'Google');
    }

    public function redirectToApple(): RedirectResponse
    {
        if (!apple_oauth_configured()) {
            return redirect()->route('login')->with('error', 'Apple sign-in is not configured yet. Add APPLE_CLIENT_ID, APPLE_KEY_ID, APPLE_TEAM_ID, and APPLE_PRIVATE_KEY in .env, then run php artisan config:clear.');
        }

        return Socialite::driver('apple')
            ->scopes(['name', 'email'])
            ->redirect();
    }

    public function handleAppleCallback(): RedirectResponse
    {
        if (!apple_oauth_configured()) {
            return redirect()->route('login')->with('error', 'Apple sign-in is not configured yet.');
        }

        try {
            $socialUser = Socialite::driver('apple')->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Apple sign-in was cancelled or failed. Please try again.');
        }

        return $this->loginSocialUser($socialUser, 'Apple');
    }

    protected function loginSocialUser(SocialiteUser $socialUser, string $provider): RedirectResponse
    {
        $email = $socialUser->getEmail();

        if (!$email) {
            return redirect()->route('login')->with('error', $provider . ' did not provide an email address. Please use email login.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'No account found for this ' . $provider . ' email. Please register first.');
        }

        if (!$user->hasRole('Trainer') && !$user->hasRole('trainer')) {
            return redirect()->route('login')->with('error', 'This login is only for trainers. Please use the correct login page.');
        }

        if ((int) $user->status === 0) {
            return redirect()->route('login')->with('error', 'Your account is not active. Please verify your email.');
        }

        Auth::login($user, true);
        TrainerProfileSync::resolveTrainer($user);

        return redirect()->route('trainer.dashboard');
    }
}
