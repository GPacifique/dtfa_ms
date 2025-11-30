# Image Display & Storage Troubleshooting Guide

## Quick Checklist

- [ ] `public/storage` symlink exists
- [ ] Run `php artisan storage:link`
- [ ] Images stored in `storage/app/public/` directory
- [ ] File permissions are correct (755 for directories, 644 for files)
- [ ] `APP_URL` environment variable is set correctly
- [ ] Storage disk configuration is proper
- [ ] Browser cache is cleared
- [ ] Image paths are correct (no leading slashes)
- [ ] Fallback avatars load if images don't exist

---

## 1. STORAGE SYMLINK SETUP

### What It Is
A symbolic link that makes `storage/app/public/` accessible via the web at `/storage`.

### Create the Symlink
```bash
php artisan storage:link
```

### Verify It Exists
```bash
# On Windows (PowerShell as Admin)
Get-Item "C:\path\to\public\storage" | Format-List -Property LinkType

# On Linux/Mac
ls -la public/storage
```

### Expected Output
- Windows: `LinkType: SymbolicLink`
- Linux/Mac: `lrwxrwxrwx ... public/storage -> ../storage/app/public`

### If Symlink Doesn't Exist
```bash
# Windows (PowerShell as Admin)
New-Item -ItemType SymbolicLink -Path "C:\path\to\public\storage" -Target "C:\path\to\storage\app\public"

# Linux/Mac
ln -s ../storage/app/public public/storage
```

---

## 2. ENVIRONMENT CONFIGURATION

### .env File Setup
```bash
# Set correct APP_URL (must match your actual domain)
APP_URL=http://localhost              # Local development
APP_URL=http://your-domain.com        # Production
APP_URL=https://your-domain.com       # Production with SSL

# Optional: Specify default filesystem disk
FILESYSTEM_DISK=public
```

### Important Notes
- ⚠️ APP_URL must NOT have trailing slash
- ⚠️ APP_URL should include protocol (http:// or https://)
- ⚠️ APP_URL must match your actual domain (browser address bar)

### For Namecheap/Shared Hosting
```bash
APP_URL=https://yourdomain.com
# or with subdirectory
APP_URL=https://yourdomain.com/dtfa
```

---

## 3. STORAGE CONFIGURATION

### Current Config (`config/filesystems.php`)

#### Public Disk (for web-accessible images)
```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),           // Physical location
    'url' => env('APP_URL').'/storage',             // Web URL prefix
    'visibility' => 'public',
    'throw' => false,
    'report' => false,
],
```

#### URL Generation Logic
```
Physical file:  storage/app/public/photos/students/123.jpg
Web URL:        https://yourdomain.com/storage/photos/students/123.jpg
```

### How URLs Are Generated in Code
```php
// Method 1: Storage disk (preferred)
Storage::disk('public')->url('photos/students/123.jpg')
// Returns: https://yourdomain.com/storage/photos/students/123.jpg

// Method 2: Asset helper (fallback)
asset('storage/photos/students/123.jpg')
// Returns: https://yourdomain.com/storage/photos/students/123.jpg
```

---

## 4. MODEL ACCESSOR IMPLEMENTATION

### Student Photo URL Accessor
```php
// app/Models/Student.php
public function getPhotoUrlAttribute(): string
{
    $path = $this->photo_path ?? $this->image_path ?? null;
    
    if ($path) {
        // Try Storage disk first (recommended)
        try {
            return Storage::disk('public')->url(ltrim($path, '/'));
        } catch (\Throwable $e) {
            // Fallback to asset helper
            return asset('storage/' . ltrim($path, '/'));
        }
    }
    
    // Fallback to generated avatar
    $initials = /* ... generate from name ... */;
    return "https://ui-avatars.com/api/?name=" . urlencode($initials);
}
```

**How It Works**:
1. ✅ If photo exists → return Storage URL
2. ✅ If Storage fails → return Asset helper URL
3. ✅ If no photo → return ui-avatars.com generated avatar

### User Profile Picture URL Accessor
```php
// app/Models/User.php
public function getProfilePictureUrlAttribute(): string
{
    if ($this->profile_picture_path) {
        try {
            return Storage::disk('public')->url(ltrim($this->profile_picture_path, '/'));
        } catch (\Throwable $e) {
            return asset('storage/' . ltrim($this->profile_picture_path, '/'));
        }
    }
    
    // Fallback to generated avatar
    $initials = strtoupper(mb_substr($this->name ?? 'U', 0, 1));
    return "https://ui-avatars.com/api/?name=" . urlencode($initials);
}
```

---

## 5. FILE PERMISSIONS

### Directory Permissions
```bash
# Set correct permissions on storage directory
chmod -R 755 storage/app/public

# Or more specifically
chmod 755 storage/app/public                    # Directory
chmod 755 storage/app/public/photos             # Subdirectory
chmod 755 storage/app/public/photos/students    # Subdirectory
chmod 644 storage/app/public/photos/students/*  # Files
```

### On Shared Hosting
- Most hosts have default permissions set to 644 for files, 755 for directories
- Contact host support if images aren't displaying
- May need to set via cPanel File Manager → Properties

---

## 6. VIEW USAGE

### Displaying Photos in Blade Templates
```blade
<!-- Using the accessor (automatic) -->
<img src="{{ $student->photo_url }}" alt="{{ $student->first_name }}">

<!-- Or explicitly -->
<img src="{{ $student->getPhotoUrlAttribute() }}" alt="{{ $student->first_name }}">
```

### How URLs Look
```
Development:  http://localhost/storage/photos/students/abc123.jpg
Production:   https://yourdomain.com/storage/photos/students/abc123.jpg
Fallback:     https://ui-avatars.com/api/?name=JS&background=3b82f6&color=ffffff
```

---

## 7. COMMON ISSUES & SOLUTIONS

### Issue: "Broken Image" or "Image Not Found"

**Diagnosis**: Check browser developer tools → Network tab → Image request
- `404 Not Found` → File doesn't exist or wrong path
- `403 Forbidden` → Permission issue
- `500 Server Error` → Server configuration problem

**Solutions**:

#### 1. Symlink Missing
```bash
php artisan storage:link
# Verify: ls -la public/storage (Linux) or Get-Item public/storage (Windows)
```

#### 2. Wrong APP_URL
```bash
# Check .env
APP_URL=https://your-actual-domain.com  # No trailing slash!

# Clear config cache
php artisan config:clear
php artisan config:cache
```

#### 3. File Doesn't Exist
```bash
# Check if file is in storage/app/public/
ls storage/app/public/photos/students/

# Check database for correct path
# SELECT photo_path FROM students WHERE id = 1;
```

#### 4. Wrong File Permissions
```bash
chmod -R 755 storage/app/public
chmod 644 storage/app/public/photos/students/*
```

#### 5. Public Directory Not Web Root
On shared hosting, web root might be `public_html/` not `public/`
```bash
# Verify symlink points to correct location
ls -la public/storage
# Should show: public/storage -> ../storage/app/public
```

---

## 8. DEPLOYMENT CHECKLIST

### Before Going Live

- [ ] Storage symlink created: `php artisan storage:link`
- [ ] APP_URL set to production domain in `.env`
- [ ] APP_DEBUG set to `false` in `.env`
- [ ] File permissions set correctly (755 dirs, 644 files)
- [ ] `storage/app/public/` directory exists with correct permissions
- [ ] `public/storage` symlink verified
- [ ] Database migration run: `php artisan migrate`
- [ ] Test image upload and display
- [ ] Clear config cache: `php artisan config:cache`
- [ ] Clear view cache: `php artisan view:clear`

### Laravel Deployment Steps
```bash
# 1. Create storage link on server
php artisan storage:link

# 2. Set environment variables
# Edit .env: Set APP_URL, FILESYSTEM_DISK, etc.

# 3. Clear caches
php artisan config:cache
php artisan view:clear

# 4. Run migrations if needed
php artisan migrate
```

### On Namecheap/Shared Hosting
```bash
# Via SSH (if available)
php artisan storage:link

# Or via cPanel File Manager
# 1. Create symlink in File Manager
# 2. Set permissions to 755 for directories, 644 for files
# 3. Test by uploading a student photo

# Or manually create via File Manager
# - Create "storage" folder in public_html/
# - Point it to /home/username/public_html/storage/app/public
```

---

## 9. IMAGE UPLOAD & STORAGE

### Where Images Are Stored
```
Student Photos:      storage/app/public/photos/students/
User Profiles:       storage/app/public/profile-pictures/
Accessible at:       https://yourdomain.com/storage/photos/students/{filename}
                     https://yourdomain.com/storage/profile-pictures/{filename}
```

### Upload Handler (StudentService)
```php
if ($request->hasFile('photo')) {
    $student->photo_path = $request->file('photo')
        ->store('photos/students', 'public');
    // Stores to: storage/app/public/photos/students/
}
```

### Validation
```php
'photo' => 'nullable|image|mimes:jpeg,png,gif,webp|max:2048'
// Max size: 2MB
// Allowed formats: JPEG, PNG, GIF, WebP
```

---

## 10. TESTING IMAGE DISPLAY

### Manual Testing

#### 1. Check Symlink
```bash
# Should return the target path
ls -l public/storage
```

#### 2. Check File Exists
```bash
# List all student photos
ls storage/app/public/photos/students/
```

#### 3. Test Direct URL
```
Open in browser: https://yourdomain.com/storage/photos/students/filename.jpg
Should display the image, not 404 or forbidden
```

#### 4. Test in Blade
```blade
<img src="{{ $student->photo_url }}" alt="Test">
<!-- Should load image or fallback avatar
```

#### 5. Verify Database Path
```sql
SELECT id, first_name, photo_path FROM students LIMIT 5;
-- Example: photo_path = "photos/students/abc123.jpg"
```

### Debug Helper
Add to `.env`:
```bash
APP_DEBUG=true
```

Then check logs:
```bash
tail -f storage/logs/laravel.log
```

---

## 11. FALLBACK AVATAR SYSTEM

### How It Works
```
1. Check if photo_path exists in database
   ↓
2. If yes → Try to generate Storage URL
   ↓
3. If Storage fails → Use asset() fallback
   ↓
4. If no photo exists → Generate ui-avatars.com avatar with initials
```

### Fallback Avatar Format
```
https://ui-avatars.com/api/?name=JS&background=3b82f6&color=ffffff&size=128&bold=true
```

**Parameters**:
- `name`: User initials (extracted from name)
- `background`: Hex color (blue-600: 3b82f6)
- `color`: Text color (white: ffffff)
- `size`: Avatar size in pixels (128)
- `bold`: Bold text (true)

### Always Available
✅ Works offline (if cached)
✅ Works without symlink (fallback)
✅ Works without photos stored
✅ Consistent styling across app

---

## 12. PRODUCTION MONITORING

### Check Image Loading
```bash
# Monitor access logs for 404 errors
tail -f /var/log/apache2/access.log | grep "/storage/"

# Check for permission errors
tail -f /var/log/apache2/error.log | grep "permission"
```

### Monitor File System
```bash
# Check disk space
df -h storage/app/public

# Check inode usage
df -i storage/app/public

# Check directory size
du -sh storage/app/public
```

### Laravel Logs
```bash
# Check for errors
tail -f storage/logs/laravel.log
```

---

## Summary Table

| Component | Purpose | Status |
|-----------|---------|--------|
| Storage symlink | Makes images web-accessible | ✅ Required |
| APP_URL .env | Correct domain for URLs | ✅ Required |
| File permissions | 755 dirs, 644 files | ✅ Required |
| Model accessors | Generate correct URLs | ✅ Implemented |
| Storage disk config | Maps physical to web paths | ✅ Configured |
| Fallback avatars | Shows avatar if no image | ✅ Active |
| Error handling | Try/catch in accessors | ✅ Implemented |

---

## Quick Fix Commands

```bash
# If images suddenly stop showing:

# 1. Check symlink
php artisan storage:link --force

# 2. Clear all caches
php artisan config:clear
php artisan config:cache
php artisan view:clear
php artisan cache:clear

# 3. Fix permissions
chmod -R 755 storage/app/public

# 4. Test in browser
# Visit: https://yourdomain.com/storage/photos/students/test.jpg
# Should work or show fallback avatar
```

