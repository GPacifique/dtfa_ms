@extends('layouts.app')

@section('content')
<div class="container-page">
    <div class="card">
        <div class="card-header">
            <h1 class="page-title">My Profile</h1>
        </div>

        <div class="card-body">
            <!-- Status Messages -->
            @if ($message = Session::get('status'))
                <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-green-800 dark:text-green-300">{{ $message }}</span>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-red-800 dark:text-red-300">{{ $message }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('student.profile.update', $student) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Profile Photo Section -->
                <div class="space-y-4 p-4 bg-slate-50 dark:bg-slate-900/30 rounded-lg border border-slate-200 dark:border-slate-800">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Profile Photo</h2>

                    <div class="flex items-start gap-6">
                        <!-- Current Photo -->
                        <div class="flex-shrink-0">
                            <div class="relative">
                                <img
                                    src="{{ $student->photo_url }}"
                                    alt="{{ $student->first_name }} {{ $student->second_name }}"
                                    class="w-24 h-24 rounded-full object-cover ring-4 ring-white dark:ring-slate-800 shadow-md"
                                    id="photo-preview"
                                >
                                @if($student->photo_path)
                                    <button
                                        type="button"
                                        onclick="deletePhoto(event)"
                                        class="absolute bottom-0 right-0 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 shadow-lg transition-colors"
                                        title="Delete photo"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Upload Section -->
                        <div class="flex-1">
                            <label class="label mb-2">Upload Photo</label>
                            <div class="space-y-3">
                                <input
                                    type="file"
                                    name="photo"
                                    accept="image/*"
                                    id="photo-input"
                                    class="block w-full text-sm text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900/30 file:text-blue-700 dark:file:text-blue-400 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/50 transition-colors cursor-pointer"
                                >
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    Supported formats: JPEG, PNG, GIF • Max size: 2MB
                                </p>
                                @error('photo')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Information Section -->
                <div class="space-y-4 p-4 bg-slate-50 dark:bg-slate-900/30 rounded-lg border border-slate-200 dark:border-slate-800">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Basic Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">First Name</label>
                            <input
                                type="text"
                                name="first_name"
                                value="{{ old('first_name', $student->first_name) }}"
                                class="input"
                                placeholder="Leave blank to keep current"
                            >
                            @error('first_name')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="label">Second Name</label>
                            <input
                                type="text"
                                name="second_name"
                                value="{{ old('second_name', $student->second_name) }}"
                                class="input"
                                placeholder="Leave blank to keep current"
                            >
                            @error('second_name')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="label">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $student->email) }}"
                                class="input"
                                placeholder="Leave blank to keep current"
                            >
                            @error('email')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="label">Phone</label>
                            <input
                                type="tel"
                                name="phone"
                                value="{{ old('phone', $student->phone) }}"
                                class="input"
                                placeholder="Leave blank to keep current"
                            >
                            @error('phone')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Read-Only Information -->
                <div class="space-y-4 p-4 bg-slate-50 dark:bg-slate-900/30 rounded-lg border border-slate-200 dark:border-slate-800">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Account Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($student->branch)
                            <div>
                                <label class="label text-slate-500 dark:text-slate-400">Branch</label>
                                <p class="text-slate-900 dark:text-white font-medium">{{ $student->branch->name }}</p>
                            </div>
                        @endif

                        @if($student->group)
                            <div>
                                <label class="label text-slate-500 dark:text-slate-400">Group</label>
                                <p class="text-slate-900 dark:text-white font-medium">{{ $student->group->name }}</p>
                            </div>
                        @endif

                        <div>
                            <label class="label text-slate-500 dark:text-slate-400">Status</label>
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium {{ $student->status === 'active' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' }}">
                                <span class="w-2 h-2 rounded-full {{ $student->status === 'active' ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                {{ ucfirst($student->status ?? 'active') }}
                            </span>
                        </div>

                        @if($student->joined_at)
                            <div>
                                <label class="label text-slate-500 dark:text-slate-400">Joined</label>
                                <p class="text-slate-900 dark:text-white font-medium">{{ $student->joined_at->format('M d, Y') }}</p>
                            </div>
                        @endif

                        @if($student->sport_discipline)
                            <div>
                                <label class="label text-slate-500 dark:text-slate-400">Sport Discipline</label>
                                <p class="text-slate-900 dark:text-white font-medium">{{ $student->sport_discipline }}</p>
                            </div>
                        @endif

                        @if($student->position)
                            <div>
                                <label class="label text-slate-500 dark:text-slate-400">Position</label>
                                <p class="text-slate-900 dark:text-white font-medium">{{ $student->position }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-4 border-t border-slate-200 dark:border-slate-800">
                    <a href="{{ route('students.show', $student) }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Photo Modal -->
<form
    id="delete-photo-form"
    method="POST"
    action="{{ route('student.profile.deletePhoto', $student) }}"
    style="display: none;"
>
    @csrf
    @method('DELETE')
</form>

<script>
    // Photo preview on file selection
    document.getElementById('photo-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('photo-preview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Delete photo handler
    function deletePhoto(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete your profile photo?')) {
            document.getElementById('delete-photo-form').submit();
        }
    }
</script>
@endsection
