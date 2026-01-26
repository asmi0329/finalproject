# Gmail SMTP Configuration for Simple OTP System

## Current Issue:
Your .env file is using:
```
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

This uses `mailpit` (local testing server) - **NO REAL EMAILS ARE SENT!**

## Solution - Replace these lines in your .env file:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail-address@gmail.com
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

## Quick Test:
After configuration, try registering at: http://localhost:8080/register-otp

The OTP will be sent to your Gmail account!

## Alternative: Use Mailtrap for Testing
If you don't want to use Gmail, you can use Mailtrap:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="test@neparates.com"
MAIL_FROM_NAME="${APP_NAME}"
```
