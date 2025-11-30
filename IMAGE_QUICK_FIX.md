# Image Display - Quick Reference

## Your Status ✅

| Check | Result |
|-------|--------|
| Storage Symlink | ✅ Working |
| Image Files | ✅ 72 files found |
| Configuration | ✅ Correct |
| Models | ✅ Proper accessors |
| Database Schema | ✅ Has photo_path |

## If Images Don't Show

### 1. Quick Test (30 seconds)
```bash
php artisan tinker
>>> $s = App\Models\Student::first();
>>> echo $s->photo_path;           # See stored path
>>> echo $s->photo_url;             # See generated URL
>>> dd(Storage::disk('public')->exists($s->photo_path));  # File exists?
```

### 2. Most Likely Fixes

**Images show as avatars?**
```php
// Students have no photo_path stored
php artisan tinker
>>> App\Models\Student::whereNull('photo_path')->update(['photo_path' => null]);
// Or manually update each student with correct path
```

**404 errors in Network tab?**
```php
// Filename in database doesn't match file
// Check spelling, spaces, capitalization exactly
```

**Wrong path format (contains "public/")?**
```php
php artisan tinker
>>> DB::table('students')
    ->where('photo_path', 'LIKE', 'public/%')
    ->update(['photo_path' => DB::raw("REPLACE(photo_path, 'public/', '')")]);
```

**Images worked before, now broken?**
```bash
php artisan cache:clear
php artisan config:cache
```

### 3. Debug View

Add to any Blade template temporarily:
```blade
@if(app()->isLocal())
    <div style="background: #f0f0f0; padding: 10px; font-size: 11px; margin: 10px 0;">
        <strong>DEBUG:</strong><br>
        Path: {{ $student->photo_path ?? 'NULL' }}<br>
        URL: {{ $student->photo_url }}<br>
        Exists: {{ \Illuminate\Support\Facades\Storage::disk('public')->exists(ltrim($student->photo_path ?? '', '/')) ? 'YES' : 'NO' }}<br>
    </div>
@endif
```

## File Locations

- **Actual Images**: `storage/app/public/photos/students/`
- **Database**: Column `photo_path` in `students` table
- **Model**: `app/Models/Student.php` → `getPhotoUrlAttribute()`
- **Config**: `config/filesystems.php` → `public` disk
- **Symlink**: `public/storage` → `storage/app/public`

## Expected Path Format

| Type | Format | Example |
|------|--------|---------|
| ✅ Correct | `photos/students/{file}` | `photos/students/1.Profile Picture.120245.png` |
| ❌ Wrong | `public/photos/...` | ❌ Don't use |
| ❌ Wrong | `storage/photos/...` | ❌ Don't use |
| ❌ Wrong | `public/public/photos/...` | ❌ Don't use |

## Generated URL Format

```
http://yourapp.com/storage/photos/students/1.Profile Picture.120245.png
                   ↑        ↑      ↑
                   |        |      └─ photo_path value
                   |        └─ public disk root
                   └─ APP_URL
```

## Common Commands

```bash
# Clear all caches
php artisan cache:clear && php artisan config:cache

# Create storage symlink
php artisan storage:link

# Test in tinker
php artisan tinker

# Run diagnostics
php scripts/check_images.php

# View full guides
# See: IMAGE_FIX_GUIDE.md
# See: IMAGE_DIAGNOSTIC_REPORT.md
```

## Blade Usage

```blade
<!-- Correct ✅ -->
<img src="{{ $student->photo_url }}" alt="Photo">

<!-- Also works ✅ -->
<img src="{{ $user->profile_picture_url }}" alt="Profile">

<!-- Wrong ❌ -->
<img src="{{ $student->photo_path }}" alt="Photo">
<!-- This shows raw path, not URL -->

<!-- Wrong ❌ -->
<img src="{{ asset('storage/' . $student->photo_path) }}" alt="Photo">
<!-- Redundant - photo_url already does this -->
```

## Real-World Example

### Database
```
id: 1
first_name: John
second_name: Doe
photo_path: photos/students/1.Profile Picture.120245.png
```

### Generated
```
$student->photo_url = "http://yourapp.local/storage/photos/students/1.Profile Picture.120245.png"
```

### File System
```
storage/app/public/photos/students/1.Profile Picture.120245.png  ← File exists here
↑
└─ Symlinked as public/storage/photos/students/1.Profile Picture.120245.png
```

### HTML Output
```html
<img src="http://yourapp.local/storage/photos/students/1.Profile Picture.120245.png" alt="John">
```

---

## Still Stuck?

1. Read `IMAGE_FIX_GUIDE.md` for detailed step-by-step solutions
2. Read `IMAGE_DIAGNOSTIC_REPORT.md` for technical details
3. Run `php scripts/check_images.php` for quick verification
4. Check browser Network tab for actual errors

**Your infrastructure is correct. The issue is likely database-related.**
