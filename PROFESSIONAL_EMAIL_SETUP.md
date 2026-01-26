# Professional Email Setup for NepaRates OTP System

## Solution: Use Dedicated Email Address

### Step 1: Create Dedicated Gmail Account
Create: noreply@neparates.com or support@neparates.com

### Step 2: Enable 2FA and Generate App Password
1. Go to: https://myaccount.google.com/security
2. Enable 2-Step Verification
3. Go to: https://myaccount.google.com/apppasswords
4. Select "Mail" → "Other (Custom name)" → "NepaRates OTP"
5. Copy the 16-character password

### Step 3: Update .env Configuration
Replace your current mail settings with:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=noreply@neparates.com
MAIL_PASSWORD=your-16-character-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@neparates.com"
MAIL_FROM_NAME="NepaRates"
```

### Step 4: Clear Cache
```bash
php artisan config:clear
```

### Step 5: Test
1. Go to: http://localhost:8080/register-otp
2. Register with any email address
3. OTP will be sent from noreply@neparates.com
4. User receives OTP in their inbox

## Benefits:
✅ Works for ALL users (any email domain)
✅ Professional appearance (noreply@neparates.com)
✅ Centralized email management
✅ Easy to maintain and update
✅ Production-ready solution

## Alternative: Use Mailtrap for Testing
If you want to test without real emails:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="test@neparates.com"
MAIL_FROM_NAME="NepaRates"
```

Sign up at: https://mailtrap.io
