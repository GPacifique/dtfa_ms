# URL Encryption Guide - Security Enhancement Against Hackers

## Overview

This system provides URL parameter encryption to protect sensitive IDs and data from manipulation by hackers. All route parameters are automatically encrypted and decrypted using Laravel's built-in encryption.

## Features

✅ **Automatic Encryption/Decryption** - Transparent URL parameter encryption  
✅ **URL-Safe Encoding** - Works seamlessly in URLs without encoding issues  
✅ **Global Middleware** - Applied automatically to all requests  
✅ **Helper Functions** - Easy-to-use encryption functions  
✅ **Logging** - Failed decryption attempts are logged  

## How It Works

### Encryption Flow
1. When generating URLs, IDs are encrypted using Laravel's Crypt facade
2. Encrypted values are base64-encoded with URL-safe characters
3. URLs contain encrypted IDs instead of plain numbers
4. Middleware automatically detects and decrypts parameters on request

### Decryption Flow
1. Request arrives with encrypted URL parameter
2. DecryptUrlParameters middleware detects encrypted pattern
3. Middleware automatically decrypts the parameter
4. Controller receives the decrypted ID

## Usage Examples

### In Controllers - Generate Encrypted URLs

```php
use App\Services\UrlEncryptor;

// Encrypt a single ID
$encrypted = encrypt_id($student->id);
// Result: "Mzk1NWQ4YTdjOTg1..." (encrypted)

// Use in routes
$url = route_encrypted('students-modern.show', $student->id);
// Result: /students/Mzk1NWQ4YTdjOTg1.../show

// Or with route helper
$url = route('students-modern.show', ['id' => encrypt_id($student->id)]);
```

### In Blade Templates

```blade
{{-- Simple encrypted link --}}
<a href="{{ route_encrypted('students-modern.show', $student->id) }}">
    View Student
</a>

{{-- Using encrypt_id helper --}}
<a href="{{ route('students-modern.show', ['id' => encrypt_id($student->id)]) }}">
    View Student
</a>

{{-- Encrypted URL with additional parameters --}}
<a href="{{ route('admin.users.edit', ['id' => encrypt_id($user->id), 'tab' => 'profile']) }}">
    Edit User
</a>
```

### In Controllers - Receiving Encrypted IDs

```php
namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    public function show($id)
    {
        // $id is automatically decrypted by middleware!
        $student = Student::findOrFail($id);
        return view('students.show', ['student' => $student]);
    }

    public function edit($id)
    {
        // Works with model binding too - Laravel handles decryption
        $student = Student::findOrFail($id);
        return view('students.edit', ['student' => $student]);
    }
}
```

### In Routes

```php
// Route definition - use {id} as normal
Route::get('/students/{id}/show', [StudentController::class, 'show'])->name('students.show');

// Route model binding works automatically
Route::resource('students', StudentController::class);
// URLs will have encrypted IDs, but controller receives decrypted values
```

## API Reference

### Service Class: `App\Services\UrlEncryptor`

```php
// Encrypt/Decrypt single values
UrlEncryptor::encrypt($value)           // Returns encrypted string
UrlEncryptor::decrypt($encrypted)       // Returns original value or null

// Encrypt/Decrypt IDs
UrlEncryptor::encryptId($id)            // Encrypt an ID
UrlEncryptor::decryptId($encrypted)     // Decrypt an ID

// Encrypt/Decrypt query strings
UrlEncryptor::encryptQueryString(array) // Encrypt array of params
UrlEncryptor::decryptQueryString(str)   // Decrypt back to array
```

### Helper Functions

```php
encrypt_url($value)                  // Encrypt any value
decrypt_url($encrypted)              // Decrypt a value
encrypt_id($id)                      // Encrypt an ID
decrypt_id($encrypted)               // Decrypt an ID
route_encrypted($name, $id, [...])   // Generate encrypted route URL
url_encrypted($path, $id)            // Generate encrypted URL
```

## Security Benefits

### Against URL Tampering
- Hackers can't guess next ID by incrementing
- Sequential ID patterns are hidden
- URLs contain encrypted gibberish instead of meaningful numbers

### Against Information Disclosure
- User IDs don't leak business intelligence
- Database structure remains hidden
- Relationship patterns obscured

### Against Brute Force
- Encrypted IDs are practically impossible to brute force
- Each request uses Laravel's encryption key
- Failed decryption attempts are logged

## Security Notes

⚠️ **Important**: This encryption is only as secure as your `APP_KEY`

1. **Never commit `.env` file** - Ensure `APP_KEY` is never in version control
2. **Use strong key** - Laravel's default key generation is cryptographically secure
3. **Rotate keys securely** - If key is compromised, regenerate with `php artisan key:generate`
4. **HTTPS only** - Always use HTTPS in production (encrypt in transit + at rest)
5. **Log monitoring** - Monitor logs for failed decryption attempts

## Configuration

### Custom Encrypted Parameters

To encrypt other parameter names, edit `DecryptUrlParameters` middleware:

```php
// In app/Http/Middleware/DecryptUrlParameters.php
$encryptedParams = ['id', 'encrypted_id', 'token', 'code', 'user_id'];
```

### Disabling for Specific Routes

```php
// In routes/web.php
Route::middleware(['web'])->group(function () {
    // These routes won't have URL encryption
    Route::get('/public/resource/{id}', function($id) {
        // $id will NOT be encrypted
    });
});
```

## Testing

### Test Encryption/Decryption

```php
use App\Services\UrlEncryptor;

// Test basic encryption
$original = '123';
$encrypted = UrlEncryptor::encrypt($original);
$decrypted = UrlEncryptor::decrypt($encrypted);

$this->assertEquals($original, $decrypted);
```

### Test Routes with Encrypted IDs

```php
$student = Student::factory()->create();
$encryptedId = encrypt_id($student->id);

$response = $this->get(route('students.show', ['id' => $encryptedId]));
$response->assertOk();
$response->assertViewHas('student', $student);
```

## Troubleshooting

### URLs showing raw encrypted values instead of links

**Problem**: Helper function not recognized
**Solution**: Run `composer dump-autoload` to reload helpers

```bash
composer dump-autoload
```

### Decryption always returns null

**Problem**: Wrong encryption key or corrupted encrypted value
**Solution**: 
1. Check `APP_KEY` in `.env` matches your encryption
2. Don't modify encrypted URLs manually
3. Check logs for decryption errors

### Performance impact

The encryption/decryption is extremely fast (microseconds per operation). No noticeable performance impact on typical applications.

## Examples by Feature

### Students Module

```blade
{{-- In students list --}}
@foreach($students as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>
            <a href="{{ route_encrypted('students-modern.show', $student->id) }}">View</a>
            <a href="{{ route_encrypted('students-modern.edit', $student->id) }}">Edit</a>
        </td>
    </tr>
@endforeach
```

### Admin Users Module

```blade
{{-- In users management --}}
<a href="{{ route('admin.users.edit', ['id' => encrypt_id($user->id)]) }}" 
   class="btn btn-blue">Edit User</a>

<form action="{{ route('admin.users.destroy', ['id' => encrypt_id($user->id)]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
```

### Training Sessions

```php
// Controller
public function show($id)
{
    // $id is auto-decrypted by middleware
    $session = TrainingSession::findOrFail($id);
    return view('sessions.show', ['session' => $session]);
}

// Blade template
<a href="{{ route_encrypted('training.show', $session->id) }}">
    View Session
</a>
```

## Maintenance

### Monitor Decryption Failures

Check logs for decryption errors:
```bash
grep "URL decryption failed" storage/logs/laravel.log
```

### Update All URLs (if changing encryption strategy)

1. Keep old APP_KEY in secure location
2. Generate new APP_KEY: `php artisan key:generate`
3. Re-encrypt all URLs in database if stored
4. Update all Blade templates to use helpers

## Deployment

### Environment Setup

```bash
# Generate secure encryption key
php artisan key:generate

# Set in production .env
APP_KEY=base64:xxxxx...

# Verify middleware is registered
php artisan tinker
>>> config('app.key')
```

### Database Refresh Safety

If you decrypt URLs stored in database:
```php
// Safe migration approach
DB::statement('UPDATE users SET profile_url = ? WHERE id = ?', [
    route_encrypted('profile.show', $user->id),
    $user->id
]);
```
