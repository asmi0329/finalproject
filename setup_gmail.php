<?php

echo "=== Gmail SMTP Setup Helper ===\n\n";

echo "CURRENT MAIL CONFIGURATION:\n";
echo "Checking your .env file...\n\n";

$envFile = '.env';
if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);
    
    if (strpos($envContent, 'MAIL_HOST=mailpit') !== false) {
        echo "✓ Found mailpit configuration - needs to be updated\n\n";
    } else {
        echo "✓ Mail configuration already updated\n\n";
    }
} else {
    echo "✗ .env file not found\n\n";
}

echo "SETUP INSTRUCTIONS:\n";
echo "==================\n\n";

echo "1. ENABLE 2FA ON GMAIL:\n";
echo "   - Go to: https://myaccount.google.com/security\n";
echo "   - Enable 2-Step Verification\n\n";

echo "2. CREATE APP PASSWORD:\n";
echo "   - Go to: https://myaccount.google.com/apppasswords\n";
echo "   - Select 'Mail' for the app\n";
echo "   - Select 'Other (Custom name)' and enter 'NepaRates OTP'\n";
echo "   - Copy the 16-character password\n\n";

echo "3. UPDATE .env FILE:\n";
echo "   Replace these lines:\n";
echo "   MAIL_HOST=mailpit\n";
echo "   MAIL_PORT=1025\n";
echo "   MAIL_USERNAME=null\n";
echo "   MAIL_PASSWORD=null\n";
echo "   MAIL_ENCRYPTION=null\n\n";

echo "   With these:\n";
echo "   MAIL_HOST=smtp.gmail.com\n";
echo "   MAIL_PORT=587\n";
echo "   MAIL_USERNAME=your-gmail@gmail.com\n";
echo "   MAIL_PASSWORD=your-16-character-app-password\n";
echo "   MAIL_ENCRYPTION=tls\n";
echo "   MAIL_FROM_ADDRESS=\"your-gmail@gmail.com\"\n";
echo "   MAIL_FROM_NAME=\"\${APP_NAME}\"\n\n";

echo "4. CLEAR CACHE:\n";
echo "   php artisan config:clear\n\n";

echo "5. TEST:\n";
echo "   Go to: http://localhost:8080/register-otp\n";
echo "   Fill form and check your Gmail for OTP!\n\n";

echo "IMPORTANT:\n";
echo "- Use App Password, NOT your regular Gmail password\n";
echo "- App Password is 16 characters long\n";
echo "- 2FA must be enabled on your Gmail account\n\n";

echo "READY TO SETUP? Please provide:\n";
echo "1. Your Gmail address\n";
echo "2. Your 16-character App Password\n\n";

?>
