<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

// Test URL generation
echo "Testing password reset URL generation...\n\n";

// Test 1: Basic URL generation
$url1 = url('/reset-password/test-token-123');
echo "1. Basic URL: " . $url1 . "\n";

// Test 2: Using config
$url2 = config('app.url') . '/reset-password/test-token-123';
echo "2. Config URL: " . $url2 . "\n";

// Test 3: Using route
$url3 = route('password.reset', 'test-token-123');
echo "3. Route URL: " . $url3 . "\n";

// Test 4: Check if user exists and test notification
$user = \App\Models\User::first();
if ($user) {
    echo "\n4. User found: " . $user->email . "\n";
    
    $token = 'test-token-123';
    $notification = new \App\Notifications\ResetPasswordNotification($token);
    $mailMessage = $notification->toMail($user);
    
    echo "5. Notification action URL: " . $mailMessage->actionUrl . "\n";
} else {
    echo "\n4. No users found in database\n";
}

echo "\nDone.\n";
