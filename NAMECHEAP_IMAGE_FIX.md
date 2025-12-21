# Image Display Fix for Namecheap Production

## Problem
Images show locally but not on Namecheap production server.

## Root Cause
Shared hosting often restricts symbolic links (`public/storage → storage/app/public`), which Laravel uses by default to serve uploaded files.

## Solution Implemented
Added a **Storage Proxy Route** that serves files from `storage/app/public/*` via a Laravel controller, bypassing the need for symlinks.

---

## Quick Deploy to Namecheap

### 1. SSH into your Namecheap server
```bash
ssh username@yourserver.com
```

### 2. Navigate to your project
```bash
cd ~/sportacademyms
```

### 3. Run the deployment script
```bash
bash deploy-images-namecheap.sh
```

---

## Manual Deployment Steps

If you prefer manual deployment:

### Step 1: Pull Latest Code
```bash
cd ~/sportacademyms
git pull origin main
```

### Step 2: Update .env File
Ensure your `.env` has the correct production URL:
```env
APP_URL=https://sportacademyms.app.avanciafitness.com
FILESYSTEM_DISK=public
```

### Step 3: Try Creating Symlink (may fail on shared hosting)
```bash
php artisan storage:link
```
> **Note:** If this fails, it's okay! The proxy route will handle it.

### Step 4: Clear All Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Step 5: Rebuild Caches for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 6: Set File Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public
```

### Step 7: Verify Storage Directory Exists
```bash
mkdir -p storage/app/public/photos/students
mkdir -p storage/app/public/photos/staff
chmod -R 755 storage/app/public
```

---

## How the Fix Works

1. **Storage Proxy Route** (`/storage/{path}`):
   - Catches all requests to `/storage/*`
   - Serves files directly from `storage/app/public/`
   - Works even without symlink

2. **HasPhoto Trait**:
   - Uses `Storage::url()` to generate URLs
   - Returns `/storage/photos/students/xxx.jpg`
   - Falls back to SVG avatar if file missing

3. **PhotoController Routes**:
   - `/photos/students/{student}` - Serves student photos
   - `/photos/staff/{staff}` - Serves staff photos
   - Returns SVG avatar with initials if photo missing

---

## Testing After Deployment

### 1. Check if Images Load
Visit your students page:
```
https://sportacademyms.app.avanciafitness.com/students-modern
```

### 2. Test Direct Image URL
Try accessing an image directly:
```
https://sportacademyms.app.avanciafitness.com/storage/photos/students/1.Profile Picture.120245.png
```

### 3. Check Browser Console
- Press F12 to open Developer Tools
- Go to Console tab
- Look for 404 errors on image URLs

### 4. Verify Files Exist on Server
```bash
ls -la storage/app/public/photos/students/
```

---

## Troubleshooting

### Images Still Not Showing?

#### Problem 1: Incorrect APP_URL
**Symptom:** Image URLs point to localhost
**Fix:** Update `.env`:
```bash
APP_URL=https://sportacademyms.app.avanciafitness.com
php artisan config:cache
```

#### Problem 2: File Permissions
**Symptom:** 403 Forbidden errors
**Fix:**
```bash
chmod -R 755 storage
chmod -R 755 public
```

#### Problem 3: Files Not Uploaded
**Symptom:** No files in `storage/app/public/photos/`
**Fix:** Re-upload student photos through the admin panel

#### Problem 4: Route Cache Issues
**Symptom:** 404 on `/storage/*` URLs
**Fix:**
```bash
php artisan route:clear
php artisan route:cache
```

#### Problem 5: Wrong Storage Path in Database
**Symptom:** Images worked before but not now
**Fix:** Check database paths should be `photos/students/xxx.jpg` (no leading slash)

---

## Database Path Format

Student photos should be stored as:
```
photos/students/1.Profile Picture.120245.png
```

NOT:
- ❌ `/photos/students/...`
- ❌ `storage/photos/students/...`
- ❌ `public/storage/photos/students/...`

---

## Code Changes Summary

### New Files:
1. `app/Http/Controllers/StorageProxyController.php` - Serves files from storage
2. `deploy-images-namecheap.sh` - Deployment script

### Modified Files:
1. `routes/web.php` - Added `/storage/{path}` route
2. `app/Traits/HasPhoto.php` - Uses `Storage::url()` with SVG fallback
3. All Blade views - Use `$student->photo_url` accessor

---

## Production Checklist

- [ ] Updated APP_URL in .env
- [ ] Set FILESYSTEM_DISK=public
- [ ] Pulled latest code from GitHub
- [ ] Cleared all caches
- [ ] Rebuilt route/config cache
- [ ] Set file permissions (755)
- [ ] Verified storage directory exists
- [ ] Tested image display on website
- [ ] Checked browser console for errors

---

## Support

If images still don't show after following these steps:

1. Check Laravel logs:
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. Test the storage proxy directly:
   ```bash
   curl -I https://your-domain.com/storage/photos/students/test.jpg
   ```

3. Verify route is working:
   ```bash
   php artisan route:list | grep storage
   ```
