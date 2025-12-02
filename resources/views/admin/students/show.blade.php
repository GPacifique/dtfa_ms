@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">👤 Student Profile</h1>
            <p class="text-slate-600 mt-1">
                <span class="font-semibold">{{ $student->first_name }} {{ $student->second_name }}</span>
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('student.profile.show', $student) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">👤 My Profile</a>
            <a href="{{ route('admin.students.edit', $student) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition">✏️ Edit</a>
            <a href="{{ route('admin.students.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 font-semibold transition">← Back</a>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
        <!-- Card Header with Photo -->
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-8 flex items-start gap-6">
            <div>
                @if($student->photo_path || $student->image_path)
                    @php $legacy = $student->photo_path ?? $student->image_path; @endphp
                    <a id="student-photo-link" href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url(ltrim($legacy, '/')) }}" target="_blank">
                        <img id="student-photo-preview" src="{{ $student->photo_url }}" alt="{{ $student->first_name }} {{ $student->second_name }}" class="w-24 h-24 rounded-lg object-cover ring-2 ring-white shadow-md">
                    </a>
                @else
                    <div id="student-photo-preview" class="w-24 h-24 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm6 4a3 3 0 110 6 3 3 0 010-6z" />
                        </svg>
                    </div>
                @endif

                <!-- Inline photo upload form -->
                <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    @method('PUT')
                    <label class="text-xs text-slate-600">Change photo</label>
                    <div class="flex items-center gap-2 mt-1">
                        <input id="photo-input-admin" type="file" name="photo" accept="image/*" class="block text-sm text-slate-600 file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700" />
                        <button type="submit" class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">Upload</button>
                    </div>
                    <div id="photo-upload-status" class="mt-2 text-sm text-amber-700"></div>
                </form>
            </div>
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-slate-900">{{ $student->first_name }} {{ $student->second_name }}</h2>

                <!-- Jersey Info -->
                @if($student->jersey_number || $student->jersey_name)
                    <div class="flex items-center gap-2 mt-3">
                        @if($student->jersey_number)
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-sm font-bold rounded">Jersey #{{ $student->jersey_number }}</span>
                        @endif
                        @if($student->jersey_name)
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 text-sm font-semibold rounded">{{ $student->jersey_name }}</span>
                        @endif
                    </div>
                @endif

                <!-- Status Badge -->
                <div class="mt-3">
                    @if($student->status === 'active')
                        <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-full">✓ Active</span>
                    @else
                        <span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 text-xs font-bold rounded-full">○ {{ ucfirst($student->status) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div>
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-200">Personal Information</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Date of Birth</p>
                            <p class="text-slate-900 font-medium">{{ optional($student->dob)->format('M d, Y') ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Gender</p>
                            <p class="text-slate-900 font-medium">{{ ucfirst($student->gender ?? '—') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Email</p>
                            <p class="text-slate-900 font-medium">{{ $student->email ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Phone</p>
                            <p class="text-slate-900 font-medium">{{ $student->phone ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Family Information -->
                <div>
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-200">Family Information</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Father's Name</p>
                            <p class="text-slate-900 font-medium">{{ $student->father_name ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Mother's Name</p>
                            <p class="text-slate-900 font-medium">{{ $student->mother_name ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Emergency Phone</p>
                            <p class="text-slate-900 font-medium">{{ $student->emergency_phone ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Parent Account</p>
                            <p class="text-slate-900 font-medium">
                                @if($student->parent)
                                    {{ $student->parent->name }}<br>
                                    <span class="text-sm text-slate-600">{{ $student->parent->email }}</span>
                                @else
                                    —
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Academy Information -->
                <div>
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-200">Academy Information</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Branch</p>
                            <p class="text-slate-900 font-medium">{{ $student->branch?->name ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Group</p>
                            <p class="text-slate-900 font-medium">{{ $student->group?->name ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Sport Discipline</p>
                            <p class="text-slate-900 font-medium">{{ $student->sport_discipline ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Position</p>
                            <p class="text-slate-900 font-medium">{{ $student->position ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Details -->
                <div>
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-200">Additional Details</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Coach</p>
                            <p class="text-slate-900 font-medium">{{ $student->coach ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">School</p>
                            <p class="text-slate-900 font-medium">{{ $student->school_name ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Membership Type</p>
                            <p class="text-slate-900 font-medium">{{ $student->membership_type ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase">Joined</p>
                            <p class="text-slate-900 font-medium">{{ optional($student->joined_at)->format('M d, Y') ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-wrap gap-3">
            <a href="{{ route('admin.students.edit', $student) }}" class="px-4 py-2 bg-indigo-100 text-indigo-700 hover:bg-indigo-200 rounded-lg font-semibold transition">✏️ Edit Profile</a>
            <a href="{{ route('students-modern.show', $student) }}" class="px-4 py-2 bg-emerald-100 text-emerald-700 hover:bg-emerald-200 rounded-lg font-semibold transition">✅ Record Attendance</a>
            <a href="{{ route('admin.students.attendance', $student) }}" class="px-4 py-2 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg font-semibold transition">📅 View History</a>
            <a href="{{ route('admin.students.attendance.export', $student) }}" class="px-4 py-2 bg-amber-100 text-amber-700 hover:bg-amber-200 rounded-lg font-semibold transition">⬇️ Export CSV</a>
            <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg font-semibold transition">🗑️ Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('photo-input-admin');
    const preview = document.getElementById('student-photo-preview');
    const link = document.getElementById('student-photo-link');
    const status = document.getElementById('photo-upload-status');

    if (!input || !preview) return;

    input.addEventListener('change', function (e) {
        status.textContent = '';
        const file = input.files && input.files[0];
        if (!file) return;

        // Validate size (2MB)
        const maxBytes = 2 * 1024 * 1024;
        if (file.size > maxBytes) {
            status.textContent = 'Selected file is larger than 2MB. Please choose a smaller image.';
            input.value = '';
            return;
        }

        const url = URL.createObjectURL(file);
        // If preview is an <img>, update src; else replace innerHTML
        if (preview.tagName && preview.tagName.toLowerCase() === 'img') {
            preview.src = url;
        } else {
            preview.innerHTML = '';
            const img = document.createElement('img');
            img.src = url;
            img.className = 'w-24 h-24 rounded-lg object-cover ring-2 ring-white shadow-md';
            preview.appendChild(img);
        }

        // Update link href if present
        if (link) {
            // link should point to the blob until upload; remove href to avoid broken links
            link.removeAttribute('href');
        }
    });
});
</script>
@endpush
