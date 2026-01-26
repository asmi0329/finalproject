<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "Testing password reset email sending...\n\n";

// Find a user to test with
$user = \App\Models\User::where('email', 'admin@nepalrates.com')->first();

if (!$user) {
    echo "No user found with email admin@nepalrates.com\n";
    exit;
}

echo "Found user: " . $user->email . "\n";

// Create a password reset token
$broker = \Illuminate\Support\Facades\Password::broker();
$token = $broker->createToken($user);

echo "Generated token: " . $token . "\n";

// Test the notification
try {
    $notification = new \App\Notifications\ResetPasswordNotification($token);
    $mailMessage = $notification->toMail($user);
    
    echo "Email subject: " . $mailMessage->subject . "\n";
    echo "Action URL: " . $mailMessage->actionUrl . "\n";
    
    // Display email content safely
    echo "Email content:\n";
    if (isset($mailMessage->introLines)) {
        foreach ($mailMessage->introLines as $line) {
            echo "- " . $line . "\n";
        }
    }
    if (isset($mailMessage->outroLines)) {
        foreach ($mailMessage->outroLines as $line) {
            echo "- " . $line . "\n";
        }
    }
    
    // Actually send the email
    echo "\nSending email...\n";
    \Illuminate\Support\Facades\Notification::send($user, $notification);
    echo "Email sent successfully!\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\nDone.\n";
