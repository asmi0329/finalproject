# Gmail SMTP Configuration for OTP System

## Current Issue:
Emails are not being sent because your .env file is using:
```
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

## Quick Fix - Update your .env file:

Replace these lines:
```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

With these:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=your-16-character-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-gmail@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Steps to Get Gmail App Password:

1. **Enable 2FA on Gmail**: https://myaccount.google.com/security
2. **Create App Password**: https://myaccount.google.com/apppasswords
3. **Select "Mail"** and "Other (Custom name)" → "NepaRates OTP"
4. **Copy the 16-character password**

## After updating .env:
1. Run: `php artisan config:clear`
2. Test the OTP registration form

## Test Flow:
1. Go to: http://localhost:8080/register-otp
2. Fill registration form
3. Check your Gmail for OTP code
4. Enter OTP to verify account

The OTP will be sent to your actual Gmail account!
