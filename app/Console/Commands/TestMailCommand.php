<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMailCommand extends Command
{
    protected $signature = 'mail:test {email? : Recipient email address}';

    protected $description = 'Send a test email to verify SMTP/mail configuration';

    public function handle(): int
    {
        $to = $this->resolveRecipient();

        if (empty($to)) {
            $this->error('No recipient email found.');
            $this->line('');
            $this->warn('Add these to your live .env file:');
            $this->line('  MAIL_FROM_ADDRESS=joinfitnex@gmail.com');
            $this->line('  CONTACT_NOTIFICATION_EMAIL=joinfitnex@gmail.com');
            $this->line('');
            $this->warn('Then run: php artisan config:clear');
            $this->line('');
            $this->line('Or pass an email directly: php artisan mail:test joinfitnex@gmail.com');
            return self::FAILURE;
        }

        $this->info('Mail driver: ' . (config('mail.default') ?: '(not set)'));
        $this->info('SMTP host: ' . (config('mail.mailers.smtp.host') ?: '(not set)'));
        $this->info('SMTP port: ' . (config('mail.mailers.smtp.port') ?: '(not set)'));
        $this->info('From: ' . (config('mail.from.address') ?: '(not set)'));
        $this->info('Notification to: ' . (config('mail.contact_notification_address') ?: '(using fallback)'));
        $this->info('Sending test email to: ' . $to);

        if (config('mail.default') === 'log') {
            $this->warn('Warning: MAIL_MAILER=log — email will be written to log, not sent to inbox.');
        }

        try {
            Mail::raw('FITNEX mail test — if you received this, SMTP is working.', function ($message) use ($to) {
                $message->to($to)->subject('FITNEX SMTP Test');
            });

            $this->info('Test email sent successfully.');
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Failed to send test email.');
            $this->error($e->getMessage());
            return self::FAILURE;
        }
    }

    protected function resolveRecipient(): ?string
    {
        $candidates = [
            $this->argument('email'),
            config('mail.contact_notification_address'),
            config('mail.from.address'),
            'joinfitnex@gmail.com',
        ];

        foreach ($candidates as $email) {
            $email = is_string($email) ? trim($email) : '';
            if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $email;
            }
        }

        return null;
    }
}
