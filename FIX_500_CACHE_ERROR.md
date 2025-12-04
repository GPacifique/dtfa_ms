# 🔧 Fix 500 Error: Invalid Cache Path on Namecheap

## Error Message
```
InvalidArgumentException
Please provide a valid cache path.
```

## Root Cause
Laravel needs write permissions to the `storage` and `bootstrap/cache` directories to compile views and cache configuration. On production servers, these directories often have incorrect permissions after deployment.

## ✅ Quick Fix

### Step 1: SSH into Your Namecheap Server

Connect via cPanel Terminal or SSH.

### Step 2: Navigate to Your App Directory

```bash
cd ~/dtfa_updated
```

### Step 3: Fix Storage and Cache Permissions

```bash
# Set directory permissions (755 = read/write for owner, read/execute for others)
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Ensure Laravel can write to these directories
chmod -R 775 storage/framework
chmod -R 775 storage/framework/cache
chmod -R 775 storage/framework/sessions
chmod -R 775 storage/framework/views
chmod -R 775 storage/logs
```

### Step 4: Clear All Caches

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Step 5: Rebuild Caches for Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 6: Create Storage Symlink (if missing)

```bash
php artisan storage:link
```

### Step 7: Verify Permissions

```bash
# Check storage directory permissions
ls -la storage/
ls -la storage/framework/
ls -la bootstrap/cache/

# All directories should show drwxr-xr-x or drwxrwxr-x
```

## 🚀 Complete Deployment Command

Run this single command to fix everything:

```bash
cd ~/dtfa_updated && \
chmod -R 755 storage bootstrap/cache && \
chmod -R 775 storage/framework storage/logs && \
php artisan cache:clear && \
php artisan config:clear && \
php artisan route:clear && \
php artisan view:clear && \
php artisan config:cache && \
php artisan route:cache && \
php artisan storage:link && \
echo "✅ All permissions and caches fixed!"
```

## 🔍 Troubleshooting

### Still Getting 500 Error?

1. **Check Logs**
```bash
tail -n 50 storage/logs/laravel.log
```

2. **Check Directory Ownership**
```bash
ls -la storage/
# Owner should match your hosting user
```

3. **Reset Permissions More Aggressively**
```bash
find storage -type d -exec chmod 775 {} \;
find storage -type f -exec chmod 664 {} \;
find bootstrap/cache -type d -exec chmod 775 {} \;
find bootstrap/cache -type f -exec chmod 664 {} \;
```

4. **Check .env File**
```bash
cat .env | grep -E "(APP_ENV|APP_DEBUG)"
# Should show: APP_ENV=production, APP_DEBUG=false
```

5. **Check PHP Version**
```bash
php -v
# Should be 8.2 or higher
```

### Permission Denied on Artisan Commands?

```bash
# Make artisan executable
chmod +x artisan

# Try commands again
php artisan cache:clear
```

### Public Storage Link Not Working?

```bash
# Remove old link if exists
rm -f public/storage

# Recreate it
php artisan storage:link

# Verify it's a symlink
ls -la public/ | grep storage
# Should show: storage -> ../storage/app/public
```

## 📋 After Every Git Pull

After pulling new code from GitHub, always run:

```bash
cd ~/dtfa_updated
git pull origin main
composer install --no-dev --optimize-autoloader
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/framework storage/logs
php artisan config:clear
php artisan cache:clear
php artisan route:cache
php artisan config:cache
```

## 🔒 Security Note

- **755** = Owner can read/write/execute, others can only read/execute
- **775** = Owner and group can read/write/execute, others can only read/execute
- **664** = Owner and group can read/write, others can only read

Never use **777** permissions on production servers as it's a security risk.

## ✅ Verification

Visit your site URL:
```
https://sportacademyms.app.avanciafitness.com
```

You should see your application load without errors.

## 📱 Quick Reference Commands

```bash
# Fix permissions quickly
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/framework storage/logs

# Clear everything
php artisan optimize:clear

# Cache everything
php artisan optimize

# Check Laravel status
php artisan about
```
