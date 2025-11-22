Gmail SMTP Setup (App Password)
================================

This project can send email using Gmail's SMTP service. Google requires using an App Password for SMTP if your account has 2-Step Verification enabled (recommended).

Steps to generate an App Password (summary):

1. Enable 2-Step Verification for the Google account you will use as the `MAIL_USERNAME`.
2. Visit https://myaccount.google.com/apppasswords (you may need to sign in).
3. Under "Select app" choose "Mail" and under "Select device" choose "Other" then enter a name like "DTFA App".
4. Click "Generate" and copy the 16-character password shown.
5. Put the generated password in your `.env` as `MAIL_PASSWORD` (do NOT commit it).

Recommended `.env` values (example):

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-account@gmail.com
MAIL_PASSWORD=generated-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-account@gmail.com
MAIL_FROM_NAME="DTFA"

Notes & Troubleshooting:
- Use port `587` with `tls` encryption for modern setups. Port `465` with `ssl` also works in some environments.
- If you see authentication or connection errors, verify your local environment (firewall) allows outbound SMTP to `smtp.gmail.com` on the chosen port.
- Do not commit `MAIL_PASSWORD` or other secrets to git. Use environment variables on deployment.
- If your account is a Google Workspace (formerly G Suite) account, an administrator may restrict app passwords. Contact your workspace admin if you cannot generate one.

Testing email locally:

1. Set the values in your local `.env` (copy `.env.example` to `.env` and edit).
2. Restart queue workers and the app if necessary.
3. From a tinker session you can send a test email:

   php artisan tinker
   >>> Mail::raw('Test email', function($m) { $m->to('you@example.com')->subject('Test'); });

Or create a temporary route that triggers a `Mail::send()` call for easier browser testing.

Security reminder: Use app passwords and do not store real account passwords in source control.
