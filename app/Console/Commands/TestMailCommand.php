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
        $to = $this->argument('email') ?: config('mail.contact_notification_address');

        if (empty($to)) {
            $this->error('No recipient. Set CONTACT_NOTIFICATION_EMAIL or MAIL_FROM_ADDRESS in .env');
            return self::FAILURE;
        }

        $this->info('Mail driver: ' . config('mail.default'));
        $this->info('SMTP host: ' . config('mail.mailers.smtp.host'));
        $this->info('From: ' . config('mail.from.address'));
        $this->info('Sending test email to: ' . $to);

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
}
