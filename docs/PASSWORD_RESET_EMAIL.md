# Password Reset Email Configuration

This application uses Gmail SMTP to send password reset emails. The configuration is already set up and ready to use.

## Current Configuration

**Mail Service**: Gmail SMTP
- **Host**: smtp.gmail.com
- **Port**: 587
- **Encryption**: TLS
- **From Email**: gashumbaaimable@gmail.com
- **From Name**: Sport Academy MS

## How It Works

1. User clicks "Forgot Password" on the login page
2. User enters their email address
3. System generates a password reset token
4. Custom `ResetPasswordNotification` is sent via Gmail SMTP
5. Email contains a reset link that expires in 60 minutes
6. User clicks link and resets their password

## Custom Password Reset Email

The password reset email is customized via:
- **File**: `app/Notifications/ResetPasswordNotification.php`
- **Features**:
  - Personalized greeting with user's name
  - Clear call-to-action button
  - Token expiration time displayed
  - Professional formatting with branding

## User Model Integration

The `App\Models\User` model has been updated with:
- Import of custom notification: `use App\Notifications\ResetPasswordNotification;`
- Method: `sendPasswordResetNotification($token)` - sends custom formatted email

## Testing the Feature

To test password reset emails in development:

1. **Local Testing** (if MAIL_MAILER=log in .env):
   - Check logs at `storage/logs/laravel.log`

2. **With Gmail SMTP**:
   - Ensure `MAIL_MAILER=smtp` in .env
   - Make sure the Gmail "App Password" is correctly set
   - Check spam folder if email doesn't arrive in inbox

## Email Contents

The password reset email includes:
- ✅ Personalized greeting with user's name
- ✅ Reason for receiving the email
- ✅ Reset password button (clickable link)
- ✅ Token expiration time (60 minutes)
- ✅ Note about no action needed if not requested
- ✅ Professional footer with app branding

## Important Notes

⚠️ **Gmail App Password**: 
- Regular Gmail passwords won't work with SMTP
- Use an "App Password" generated in Google Account settings
- See `docs/GMAIL_SETUP.md` for detailed Gmail setup instructions

## Troubleshooting

### Email not sent:
1. Check `MAIL_MAILER=smtp` in .env
2. Verify Gmail credentials are correct
3. Check that 2FA is enabled and App Password is generated
4. Look at logs: `tail -f storage/logs/laravel.log`

### Email in spam:
1. Add sender email to contacts
2. Check email whitelist settings
3. Use a custom domain email for better deliverability

### Token expired:
- Default expiration is 60 minutes
- Can be changed in `config/auth.php` under `passwords.users.expire`

## Routes Involved

- **Forgot Password Form**: `/forgot-password` (GET)
- **Send Reset Email**: `/forgot-password` (POST)
- **Reset Password Form**: `/reset-password/{token}` (GET)
- **Update Password**: `/reset-password` (POST)

## Related Files

- Model: `app/Models/User.php`
- Notification: `app/Notifications/ResetPasswordNotification.php`
- Config: `config/mail.php`
- Routes: `routes/auth.php`
