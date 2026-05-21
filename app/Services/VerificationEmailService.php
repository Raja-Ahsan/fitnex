<?php

namespace App\Services;

use App\Mail\Email;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class VerificationEmailService
{
    public static function ensureTrainerRole(): void
    {
        Role::findOrCreate('trainer', 'web');
        Role::findOrCreate('Trainer', 'web');
    }

    public static function assignRegistrationRole(User $user, string $role): void
    {
        $role = strtolower(trim($role));

        if ($role === 'trainer') {
            self::ensureTrainerRole();
            $user->assignRole('trainer');
            $user->update(['role' => 'Trainer']);

            return;
        }

        if (\Spatie\Permission\Models\Role::where('name', $role)->where('guard_name', 'web')->exists()) {
            $user->assignRole($role);
        }

        $user->update(['role' => $role]);
    }

    public static function generateVerifyToken(User $user): string
    {
        do {
            $verifyToken = bin2hex(random_bytes(16));
        } while (User::where('verify_token', $verifyToken)->exists());

        $user->verify_token = $verifyToken;
        $user->save();

        return $verifyToken;
    }

    public static function verificationUrl(string $verifyToken): string
    {
        return URL::to('/email-verification/' . $verifyToken);
    }

    public static function send(User $user): bool
    {
        if (empty($user->verify_token)) {
            self::generateVerifyToken($user);
            $user->refresh();
        }

        try {
            $details = [
                'from' => 'verify',
                'title' => 'We have received your registration. Please verify your account.',
                'body' => 'Click the button below to verify your email address and activate your account.',
                'verify_token' => $user->verify_token,
                'verification_url' => self::verificationUrl($user->verify_token),
            ];

            Mail::to($user->email)->send(new Email($details));

            return true;
        } catch (\Throwable $e) {
            Log::error('Verification email failed', [
                'user_id' => $user->id,
                'email' => $user->email,
                'message' => $e->getMessage(),
            ]);

            return false;
        }
    }

    public static function resendForEmail(string $email): array
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return ['ok' => false, 'message' => 'No account found with this email address.'];
        }

        if ($user->status == 1 && $user->email_verified_at) {
            return ['ok' => false, 'message' => 'This account is already verified. You can log in.'];
        }

        if (!self::send($user)) {
            return [
                'ok' => false,
                'message' => 'Could not send email. Check mail settings (SMTP) on the server or try again later.',
            ];
        }

        return ['ok' => true, 'message' => 'Verification email sent. Please check your inbox and spam folder.'];
    }
}
