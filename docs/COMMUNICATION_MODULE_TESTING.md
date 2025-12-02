# Communication Module Testing Guide

## Overview
The DTFA Management System includes a robust communication module for sending emails to staff and users. This guide explains how to test and use the email functionality.

## Email System Architecture

### Components

1. **Model**: `App\Models\Communication`
   - Stores communication records (title, body, minutes, audience)
   - Tracks sender information

2. **Controller**: `App\Http\Controllers\Admin\CommunicationController`
   - Handles CRUD operations for communications
   - Orchestrates email sending via jobs

3. **Mailable**: `App\Mail\CommunicationSent`
   - Email template wrapper
   - Implements `ShouldQueue` for background processing
   - From: gashumbaaimable@gmail.com (DTFA)

4. **Job**: `App\Jobs\SendCommunicationChunk`
   - Processes email chunks (100 recipients per chunk)
   - Handles retries (3 attempts)
   - Logs failures without stopping the batch

5. **Email Template**: `resources/views/emails/communication.blade.php`
   - HTML email layout
   - Displays title, body, minutes, and sender info

## Mail Configuration

### Current Setup (`.env`)
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=Gashumba_Aimable
MAIL_PASSWORD=[configured]
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=gashumbaaimable@gmail.com
MAIL_FROM_NAME="DTFA"
```

### Supported Mailers
- **smtp**: Production email via SMTP server
- **log**: Development - writes emails to `storage/logs/laravel.log`
- **array**: Testing - stores emails in memory
- **mailgun**: Third-party service
- **postmark**: Third-party service
- **sendmail**: Local sendmail

## Testing the Communication Module

### Method 1: Using Artisan Command (Recommended)

```bash
# Interactive test
php artisan test:communication-email

# Direct test with email
php artisan test:communication-email your-email@example.com
```

**Options during test:**
1. **Sync (Immediate)**: Send email instantly in current process
2. **Queue (Background)**: Queue email for worker processing
3. **Direct Mail**: Send via Laravel Mail facade directly

### Method 2: Using Web Interface

1. Navigate to: `https://your-domain.com/admin/communications/create`
2. Fill in the form:
   - **Title**: Email subject line
   - **Body**: Main email content
   - **Minutes**: Optional meeting minutes
   - **Activity Type**: Optional activity categorization
   - **Audience**: 
     - `staff`: Sends to all staff with email addresses
     - `all`: Sends to both staff and registered users
   - **Send now**: Check to bypass queue (immediate send)

3. Click "Send" button

### Method 3: Manual Testing via Tinker

```bash
php artisan tinker
```

```php
// Create test communication
$comm = App\Models\Communication::create([
    'title' => 'Test Email',
    'body' => 'This is a test message',
    'sender_id' => 1,
    'audience' => 'staff'
]);

// Send to single email synchronously
App\Jobs\SendCommunicationChunk::dispatchSync($comm, ['test@example.com']);

// Or queue for background processing
App\Jobs\SendCommunicationChunk::dispatch($comm, ['test@example.com']);

// Direct mail send
Mail::to('test@example.com')->send(new App\Mail\CommunicationSent($comm));
```

## Audience Targeting

### Staff Only (`audience: 'staff'`)
- Retrieves emails from `staff` table
- Filters: `whereNotNull('email')`
- Unique emails only

### All Users (`audience: 'all'`)
- Retrieves from both `staff` AND `users` tables
- Combines and deduplicates emails
- Broader reach for system-wide announcements

## Queue Processing

### Development (Synchronous)
```env
QUEUE_CONNECTION=sync
```
- Emails sent immediately
- No queue worker needed
- Slower for large recipient lists

### Production (Asynchronous)
```env
QUEUE_CONNECTION=database
# or
QUEUE_CONNECTION=redis
```

**Start queue worker:**
```bash
php artisan queue:work --tries=3 --timeout=90
```

**Supervisor configuration** (Linux production):
```ini
[program:dtfa-queue-worker]
command=php /path/to/artisan queue:work --sleep=3 --tries=3
directory=/path/to/project
user=www-data
autostart=true
autorestart=true
```

## Email Chunking

**Why chunking?**
- Prevents memory exhaustion
- Avoids email provider rate limits
- Enables better error handling

**Chunk size**: 100 recipients per job
- Large lists automatically split
- Each chunk queued separately
- Failed chunks don't affect others

## Error Handling

### Logging
All email failures are logged:
```php
\Log::error('Failed to queue communication email', [
    'email' => $email,
    'communication_id' => $communication->id,
    'error' => $e->getMessage(),
]);
```

**Check logs:**
```bash
tail -f storage/logs/laravel.log
```

### Retry Mechanism
- **Tries**: 3 attempts per email
- **Backoff**: Exponential (1s, 2s, 4s)
- **Failed Jobs**: Stored in `failed_jobs` table

**Retry failed jobs:**
```bash
php artisan queue:retry all
```

## Verification Steps

### 1. Check Mail Configuration
```bash
php artisan config:show mail
```

### 2. Test SMTP Connection
```bash
php artisan test:communication-email test@example.com
```

### 3. Verify Recipients
```php
// Count staff with emails
DB::table('staff')->whereNotNull('email')->count();

// Count users with emails  
DB::table('users')->whereNotNull('email')->count();
```

### 4. Monitor Queue
```bash
# Watch queue in real-time
php artisan queue:listen --verbose

# Check failed jobs
php artisan queue:failed
```

## Common Issues & Solutions

### Issue: Emails not sending
**Solutions:**
1. Check `.env` mail credentials
2. Verify SMTP server allows connection
3. Check firewall/port access (587, 465, 25)
4. Review `storage/logs/laravel.log`

### Issue: Queue not processing
**Solutions:**
1. Ensure queue worker is running: `php artisan queue:work`
2. Check database connection for `database` driver
3. Verify Redis connection for `redis` driver
4. Clear failed jobs: `php artisan queue:flush`

### Issue: Emails in spam
**Solutions:**
1. Configure SPF records in DNS
2. Set up DKIM signing
3. Use authenticated SMTP server
4. Avoid spam trigger words in content
5. Use proper from address with domain

### Issue: Slow sending
**Solutions:**
1. Switch to queue driver (not `sync`)
2. Increase chunk size (default: 100)
3. Run multiple queue workers
4. Use faster mail provider (e.g., Mailgun, SendGrid)

## Production Checklist

- [ ] Update `MAIL_MAILER` to production SMTP
- [ ] Configure `MAIL_FROM_ADDRESS` with verified domain
- [ ] Set `QUEUE_CONNECTION` to `database` or `redis`
- [ ] Set up queue worker with Supervisor
- [ ] Configure DNS records (SPF, DKIM, DMARC)
- [ ] Test with small audience first
- [ ] Monitor `storage/logs/laravel.log`
- [ ] Set up email delivery monitoring

## Security Notes

1. **Email Validation**: All emails validated before sending
2. **Rate Limiting**: Consider implementing rate limits
3. **Authentication**: Only admin/super-admin roles can send
4. **Sanitization**: Email content escaped in template
5. **Audit Trail**: All communications logged with sender_id

## Performance Metrics

**Sending Speed** (per 100 recipients):
- Sync: ~30-60 seconds
- Queue: ~5-10 seconds (queuing) + background processing
- Multiple workers: Linear scaling

**Recommended Setup**:
- Queue Driver: Redis
- Workers: 3-5 concurrent
- Chunk Size: 100
- Timeout: 90 seconds

## Testing Checklist

- [x] Email system architecture verified
- [x] Test command created and working
- [x] SMTP configuration confirmed
- [x] Synchronous sending tested
- [x] Queue processing verified
- [x] Email template renders correctly
- [x] Error handling functional
- [x] Logging working
- [ ] Production SMTP tested
- [ ] Large recipient list tested
- [ ] Failed job retry tested
- [ ] Monitoring setup complete

## Additional Resources

- [Laravel Mail Documentation](https://laravel.com/docs/11.x/mail)
- [Laravel Queue Documentation](https://laravel.com/docs/11.x/queues)
- [Mailtrap Documentation](https://mailtrap.io/docs/)

---

**Last Updated**: December 2, 2025
**Tested By**: System Administrator
**Status**: ✅ Fully Functional
