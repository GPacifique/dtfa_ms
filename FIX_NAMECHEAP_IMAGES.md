# 🖼️ Fix Images Not Displaying on Namecheap Hosting

## Problem
Images work locally but don't display on Namecheap production server.

## Root Cause
The storage symbolic link is missing on the production server. Laravel stores uploaded files in `storage/app/public` but serves them via `public/storage`, which requires a symlink.

## ✅ Solution

### Step 1: SSH into Namecheap Server

Connect to your server via cPanel Terminal or SSH.

### Step 2: Navigate to Your App Directory

```bash
cd ~/sportacademyms
# or wherever your app is located
```

### Step 3: Create Storage Symbolic Link

```bash
php artisan storage:link
```

You should see:
```
The [public/storage] link has been connected to [storage/app/public].
The links have been created.
```

### Step 4: Verify the Link Was Created

```bash
ls -la public/ | grep storage
```

You should see:
```
lrwxrwxrwx  1 user user   34 Dec  3 12:00 storage -> ../storage/app/public
```

### Step 5: Set Correct Permissions

```bash
# Set permissions for storage directories
chmod -R 755 storage
chmod -R 755 storage/app/public
chmod -R 755 public/storage

# Set ownership (replace 'username' with your actual cPanel username)
chown -R username:username storage
chown -R username:username storage/app/public
```

### Step 6: Update Production .env File

Make sure your production `.env` has the correct APP_URL:

```bash
nano ~/.env
```

Update or add:
```env
APP_URL=https://sportacademyms.app.avanciafitness.com
```

Press `Ctrl+X`, then `Y`, then `Enter` to save.

### Step 7: Clear Caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:cache
```

### Step 8: Test Image Access

Try accessing an image directly in your browser:
```
https://sportacademyms.app.avanciafitness.com/storage/photos/students/[filename].png
```

If you see the image, the fix worked!

## 🔍 Troubleshooting

### If `php artisan storage:link` gives an error:

**Error: "symlink(): Protocol error"**

Some shared hosting (including Namecheap) don't allow `symlink()`. Use this workaround:

#### Option A: Manual Symlink via SSH

```bash
cd ~/sportacademyms/public
ln -s ../storage/app/public storage
```

#### Option B: Copy Instead of Link (Not Recommended)

If symlinks are completely disabled:

```bash
cd ~/sportacademyms/public
cp -r ../storage/app/public storage
```

⚠️ **Warning:** With Option B, you'll need to re-copy after every file upload.

### If images still don't show:

1. **Check file exists:**
   ```bash
   ls -la storage/app/public/photos/students/
   ```

2. **Check permissions:**
   ```bash
   ls -la storage/app/public/photos/
   ```
   All should be `755` or `775`.

3. **Check .htaccess in public folder:**
   ```bash
   cat public/.htaccess
   ```
   Make sure it has `FollowSymLinks`:
   ```apache
   <IfModule mod_rewrite.c>
       Options +FollowSymLinks
       RewriteEngine On
       # ... rest of rules
   </IfModule>
   ```

4. **Check APP_URL matches your domain:**
   ```bash
   php artisan tinker
   >>> config('app.url')
   ```
   Should output: `"https://sportacademyms.app.avanciafitness.com"`

5. **Test direct file access:**
   Create a test file:
   ```bash
   echo "Test file" > storage/app/public/test.txt
   ```
   
   Then try accessing:
   ```
   https://sportacademyms.app.avanciafitness.com/storage/test.txt
   ```

### If you get 403 Forbidden:

```bash
# Fix ownership (replace 'username' with your cPanel username)
chown -R username:username storage/app/public

# Fix permissions
find storage/app/public -type f -exec chmod 644 {} \;
find storage/app/public -type d -exec chmod 755 {} \;
```

### If you need to re-upload photos:

If photos are on your local machine but not on production:

1. **Package local photos:**
   ```powershell
   # On your local machine
   cd C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms
   Compress-Archive -Path storage\app\public\photos -DestinationPath photos-backup.zip
   ```

2. **Upload to server via cPanel File Manager**

3. **Extract on server:**
   ```bash
   cd ~/sportacademyms/storage/app/public
   unzip ~/photos-backup.zip
   chmod -R 755 photos
   ```

## 📋 Quick Checklist

- [ ] Run `php artisan storage:link`
- [ ] Verify symlink: `ls -la public/ | grep storage`
- [ ] Set permissions: `chmod -R 755 storage/app/public`
- [ ] Update APP_URL in `.env` to production URL
- [ ] Clear caches: `php artisan config:clear && php artisan cache:clear`
- [ ] Test direct image URL in browser
- [ ] Check HasPhoto trait is using correct storage disk

## 🎯 Expected Result

After completing these steps:
- ✅ Student photos display in cards view
- ✅ Student photos display in table view
- ✅ Staff photos display correctly
- ✅ User profile pictures work
- ✅ Direct image URLs are accessible

## 📞 Support

If issues persist, check:
- Laravel logs: `storage/logs/laravel.log`
- Server error logs: Check cPanel → Error Log
- PHP version: Should be 8.2+ (check in cPanel → Select PHP Version)

---

**Last Updated:** December 3, 2025  
**Production URL:** https://sportacademyms.app.avanciafitness.com
