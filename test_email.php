<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('Test email from FITNEX Laravel application', function($message) {
        $message->to('asjadmmc67@gmail.com')
                ->subject('FITNEX Email Test');
    });

    echo "Test email sent successfully!\n";
} catch (Exception $e) {
    echo "Email sending failed: " . $e->getMessage() . "\n";
}
