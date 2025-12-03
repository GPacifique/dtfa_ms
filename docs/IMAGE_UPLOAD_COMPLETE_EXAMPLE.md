# 📸 Complete Laravel Image Upload Implementation

## Step 1: Database Migration

Create migration to add `photo_url` column:

```bash
php artisan make:migration add_photo_url_to_students_table
```

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('photo_url')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('photo_url');
        });
    }
};
```

**Run migration:**
```bash
php artisan migrate
```

---

## Step 2: Model

Update `app/Models/Student.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'second_name',
        'email',
        'phone',
        'photo_url', // Add this
        // ... other fields
    ];

    // Optional: Accessor for photo URL with fallback
    public function getPhotoAttribute(): string
    {
        if ($this->photo_url) {
            return asset('storage/' . $this->photo_url);
        }
        
        // Fallback to default avatar
        return asset('images/default-avatar.png');
    }
}
```

---

## Step 3: Controller

Create or update controller `app/Http/Controllers/StudentController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Create student record
        $student = new Student();
        $student->first_name = $validated['first_name'];
        $student->second_name = $validated['second_name'];
        $student->email = $validated['email'];
        $student->phone = $validated['phone'] ?? null;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Store image and get the path
            $path = $request->file('photo')->store('photos/students', 'public');
            
            // Save only the relative path to database
            $student->photo_url = $path;
        }

        $student->save();

        return redirect()->route('students.show', $student)
            ->with('success', 'Student created successfully!');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in the database.
     */
    public function update(Request $request, Student $student)
    {
        // Validate incoming request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update student fields
        $student->first_name = $validated['first_name'];
        $student->second_name = $validated['second_name'];
        $student->email = $validated['email'];
        $student->phone = $validated['phone'] ?? null;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($student->photo_url) {
                Storage::disk('public')->delete($student->photo_url);
            }

            // Store new photo
            $path = $request->file('photo')->store('photos/students', 'public');
            $student->photo_url = $path;
        }

        $student->save();

        return redirect()->route('students.show', $student)
            ->with('success', 'Student updated successfully!');
    }

    /**
     * Delete student photo.
     */
    public function deletePhoto(Student $student)
    {
        if ($student->photo_url) {
            // Delete photo from storage
            Storage::disk('public')->delete($student->photo_url);
            
            // Remove photo path from database
            $student->photo_url = null;
            $student->save();
        }

        return redirect()->back()
            ->with('success', 'Photo deleted successfully!');
    }
}
```

---

## Step 4: Routes

Add to `routes/web.php`:

```php
<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::resource('students', StudentController::class);

// Additional route for deleting photo
Route::delete('students/{student}/photo', [StudentController::class, 'deletePhoto'])
    ->name('students.photo.delete');
```

---

## Step 5: Create Form View

Create `resources/views/students/create.blade.php`:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Create New Student</h1>

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Create Form --}}
            <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- First Name --}}
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 font-bold mb-2">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="first_name" 
                        id="first_name" 
                        value="{{ old('first_name') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                {{-- Second Name --}}
                <div class="mb-4">
                    <label for="second_name" class="block text-gray-700 font-bold mb-2">
                        Second Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="second_name" 
                        id="second_name" 
                        value="{{ old('second_name') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                {{-- Phone --}}
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-bold mb-2">
                        Phone
                    </label>
                    <input 
                        type="text" 
                        name="phone" 
                        id="phone" 
                        value="{{ old('phone') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                {{-- Photo Upload --}}
                <div class="mb-6">
                    <label for="photo" class="block text-gray-700 font-bold mb-2">
                        Photo
                    </label>
                    <input 
                        type="file" 
                        name="photo" 
                        id="photo" 
                        accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="previewImage(event)"
                    >
                    <p class="text-sm text-gray-600 mt-1">
                        Allowed: JPG, JPEG, PNG, GIF. Max size: 2MB
                    </p>

                    {{-- Image Preview --}}
                    <div id="preview-container" class="mt-4 hidden">
                        <img id="preview-image" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300">
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4">
                    <button 
                        type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded"
                    >
                        Create Student
                    </button>
                    <a 
                        href="{{ route('students.index') }}" 
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- JavaScript for Image Preview --}}
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');
            const container = document.getElementById('preview-container');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                container.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
```

---

## Step 6: Show View (Display Image)

Create `resources/views/students/show.blade.php`:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            
            {{-- Success Message --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-2xl font-bold mb-6">Student Details</h1>

            {{-- Student Photo --}}
            <div class="mb-6 text-center">
                @if($student->photo_url)
                    <img 
                        src="{{ asset('storage/' . $student->photo_url) }}" 
                        alt="{{ $student->first_name }} {{ $student->second_name }}"
                        height="150"
                        class="mx-auto rounded-lg shadow-md"
                    >
                    
                    {{-- Delete Photo Button --}}
                    <form method="POST" action="{{ route('students.photo.delete', $student) }}" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="text-red-600 hover:text-red-800 text-sm"
                            onclick="return confirm('Are you sure you want to delete this photo?')"
                        >
                            Delete Photo
                        </button>
                    </form>
                @else
                    <div class="w-32 h-32 mx-auto bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500 text-sm">No Photo</span>
                    </div>
                @endif
            </div>

            {{-- Student Information --}}
            <div class="space-y-4">
                <div>
                    <label class="font-bold text-gray-700">First Name:</label>
                    <p class="text-gray-900">{{ $student->first_name }}</p>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Second Name:</label>
                    <p class="text-gray-900">{{ $student->second_name }}</p>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Email:</label>
                    <p class="text-gray-900">{{ $student->email }}</p>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Phone:</label>
                    <p class="text-gray-900">{{ $student->phone ?? 'N/A' }}</p>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Photo Path:</label>
                    <p class="text-gray-600 text-sm">{{ $student->photo_url ?? 'No photo uploaded' }}</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-6 flex gap-4">
                <a 
                    href="{{ route('students.edit', $student) }}" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded"
                >
                    Edit Student
                </a>
                <a 
                    href="{{ route('students.index') }}" 
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded"
                >
                    Back to List
                </a>
            </div>
        </div>
    </div>
</body>
</html>
```

---

## Step 7: Edit Form View

Create `resources/views/students/edit.blade.php`:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Student</h1>

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Current Photo --}}
            @if($student->photo_url)
                <div class="mb-6 text-center">
                    <label class="block text-gray-700 font-bold mb-2">Current Photo:</label>
                    <img 
                        src="{{ asset('storage/' . $student->photo_url) }}" 
                        alt="Current photo"
                        height="150"
                        class="mx-auto rounded-lg shadow-md"
                    >
                </div>
            @endif

            {{-- Edit Form --}}
            <form method="POST" action="{{ route('students.update', $student) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- First Name --}}
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 font-bold mb-2">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="first_name" 
                        id="first_name" 
                        value="{{ old('first_name', $student->first_name) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                {{-- Second Name --}}
                <div class="mb-4">
                    <label for="second_name" class="block text-gray-700 font-bold mb-2">
                        Second Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="second_name" 
                        id="second_name" 
                        value="{{ old('second_name', $student->second_name) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $student->email) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                {{-- Phone --}}
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-bold mb-2">
                        Phone
                    </label>
                    <input 
                        type="text" 
                        name="phone" 
                        id="phone" 
                        value="{{ old('phone', $student->phone) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                {{-- Photo Upload --}}
                <div class="mb-6">
                    <label for="photo" class="block text-gray-700 font-bold mb-2">
                        Change Photo
                    </label>
                    <input 
                        type="file" 
                        name="photo" 
                        id="photo" 
                        accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="previewImage(event)"
                    >
                    <p class="text-sm text-gray-600 mt-1">
                        Leave empty to keep current photo. Max size: 2MB
                    </p>

                    {{-- New Image Preview --}}
                    <div id="preview-container" class="mt-4 hidden">
                        <label class="block text-gray-700 font-bold mb-2">New Photo Preview:</label>
                        <img id="preview-image" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300">
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4">
                    <button 
                        type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded"
                    >
                        Update Student
                    </button>
                    <a 
                        href="{{ route('students.show', $student) }}" 
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- JavaScript for Image Preview --}}
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');
            const container = document.getElementById('preview-container');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                container.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
```

---

## Step 8: Setup Commands

Run these commands in order:

```bash
# 1. Create the storage symlink
php artisan storage:link

# 2. Create the photos directory (if not exists)
mkdir -p storage/app/public/photos/students

# 3. Set proper permissions (Linux/Mac)
chmod -R 755 storage/app/public/photos

# 4. Clear caches
php artisan config:clear
php artisan cache:clear
```

---

## Testing the Implementation

### 1. Create a Student with Photo
```
Visit: http://yourapp.com/students/create
- Fill in the form
- Select an image file
- Submit
```

### 2. Verify Database
```sql
SELECT id, first_name, second_name, photo_url FROM students;
```

You should see:
```
id | first_name | second_name | photo_url
1  | John       | Doe         | photos/students/abc123xyz.jpg
```

### 3. Verify Storage
```bash
ls -la storage/app/public/photos/students/
```

You should see the uploaded image files.

### 4. View Student Profile
```
Visit: http://yourapp.com/students/1
```

The image should display correctly using:
```blade
<img src="{{ asset('storage/' . $student->photo_url) }}" height="150">
```

---

## Key Points Summary

✅ **Form:** Uses `enctype="multipart/form-data"` and `<input type="file" name="photo">`  
✅ **Storage:** Images saved to `storage/app/public/photos/students/`  
✅ **Database:** Only relative path stored (e.g., `photos/students/abc.jpg`)  
✅ **Symlink:** `php artisan storage:link` makes images accessible via `/storage/`  
✅ **Display:** `asset('storage/' . $student->photo_url)` generates correct URL  
✅ **Validation:** Images validated for type and size  
✅ **Update:** Old photos deleted when uploading new ones  

---

**Complete! 🎉**
