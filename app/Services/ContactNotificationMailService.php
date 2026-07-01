<?php

namespace App\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactNotificationMailService
{
    public static function send(Mailable $mailable): array
    {
        $toAddress = config('mail.contact_notification_address');

        if (empty($toAddress)) {
            return [
                'ok' => false,
                'message' => 'Notification email address is not configured on the server. Set CONTACT_NOTIFICATION_EMAIL or MAIL_FROM_ADDRESS in .env.',
            ];
        }

        if (config('mail.default') === 'log') {
            return [
                'ok' => false,
                'message' => 'Mail is in "log" mode on the server, so emails are written to log files instead of being sent. Set MAIL_MAILER=smtp in .env and run php artisan config:clear.',
            ];
        }

        try {
            Mail::to($toAddress)->send($mailable);

            return [
                'ok' => true,
                'message' => 'Email sent successfully.',
            ];
        } catch (\Throwable $e) {
            Log::error('Contact notification email failed', [
                'mail_driver' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'to' => $toAddress,
                'error' => $e->getMessage(),
            ]);

            return [
                'ok' => false,
                'message' => self::userFacingMessage($e),
            ];
        }
    }

    protected static function userFacingMessage(\Throwable $e): string
    {
        $error = strtolower($e->getMessage());

        if (
            str_contains($error, 'starttls')
            || str_contains($error, 'could not connect')
            || str_contains($error, 'connection timed out')
            || str_contains($error, 'unable to connect')
        ) {
            return 'Could not connect to the mail server (SMTP). Your live hosting may be blocking outbound mail on port 587/465. Contact your host or switch to their SMTP (e.g. mail.fitnexusa.com). Technical detail: ' . $e->getMessage();
        }

        if (
            str_contains($error, 'authentication')
            || str_contains($error, 'username and password')
            || str_contains($error, 'invalid credentials')
        ) {
            return 'Mail login failed. Check MAIL_USERNAME and MAIL_PASSWORD in the server .env file (use a Gmail App Password, not your normal password). Technical detail: ' . $e->getMessage();
        }

        if (str_contains($error, 'ssl') || str_contains($error, 'certificate')) {
            return 'Secure mail connection failed. Try MAIL_PORT=465 and MAIL_ENCRYPTION=ssl in .env, then run php artisan config:clear. Technical detail: ' . $e->getMessage();
        }

        return 'Email could not be sent. Technical detail: ' . $e->getMessage();
    }
}
