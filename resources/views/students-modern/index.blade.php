@extends('layouts.app')


@section('content')
@section('hide-back')@endsection
<div class="min-h-screen">

    @section('hero')
        <x-hero title="Students" subtitle="Clean, filterable list with responsive table" />
    @endsection

    @if(session('success'))
        <div class="mb-4">
            <x-alert type="success">{{ session('success') }}</x-alert>
        </div>
    @endif


    <div class="container mx-auto px-6 mt-8 relative z-20">
        @if(session('status'))
            <x-alert type="success" class="mb-4">{{ session('status') }}</x-alert>
        @endif


        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-4 mb-4">
            <form method="get" class="grid grid-cols-1 md:grid-cols-5 gap-3">
                <x-input name="q" label="Search" :value="request('q')" placeholder="Name, email, phone..." />
                <x-select name="status" label="Status" :options="['active' => 'Active', 'inactive' => 'Inactive']" :value="request('status')" placeholder="All" />
                <x-select name="branch_id" label="Branch" :options="$branches->pluck('name','id')" :value="request('branch_id')" placeholder="All" />
                <x-select name="group_id" label="Group" :options="$groups->pluck('name','id')" :value="request('group_id')" placeholder="All" />
                <div class="grid grid-cols-2 gap-2">
                    <x-input type="date" name="from" label="From" :value="request('from')" />
                    <x-input type="date" name="to" label="To" :value="request('to')" />
                </div>
                <div class="md:col-span-5 flex items-center justify-between gap-2">
                    <div class="flex gap-2">
                        <x-button :href="request()->fullUrlWithQuery(['view' => 'table'])" variant="secondary" :class="request('view') !== 'cards' ? 'ring-2 ring-indigo-500' : ''">Table</x-button>
                        <x-button :href="request()->fullUrlWithQuery(['view' => 'cards'])" variant="secondary" :class="request('view') === 'cards' ? 'ring-2 ring-indigo-500' : ''">Cards</x-button>
                    </div>
                    <div class="flex gap-2">
                        <x-button type="submit">Filter</x-button>
                        <x-button variant="secondary" type="button" onclick="window.location='{{ route('students-modern.index') }}'">Reset</x-button>
                        <x-button href="{{ route('admin.student-attendance.create') }}" variant="success">Bulk Attendance</x-button>
                        <x-button href="{{ route('students-modern.create') }}">New Student</x-button>
                    </div>
                </div>
            </form>
        </div>


        <!-- Quick Search & Click-to-Record Section -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-400 p-6 mb-6 rounded">
            <h2 class="text-lg font-bold mb-4 text-blue-900 dark:text-blue-300">Quick Attendance Entry</h2>
            <div class="flex gap-4 mb-4">
                <div class="flex-1">
                    <input
                        type="text"
                        id="studentSearch"
                        placeholder="Search student name or ID..."
                        class="w-full border border-blue-300 dark:border-blue-600 bg-white dark:bg-slate-800 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white"
                    />
                </div>
                <select id="attendanceStatus" class="border border-blue-300 dark:border-blue-600 bg-white dark:bg-slate-800 rounded px-4 py-2 dark:text-white">
                    <option value="present">Present</option>
                    <option value="absent">Absent</option>
                    <option value="late">Late</option>
                    <option value="excused">Excused</option>
                </select>
            </div>

            <!-- Search Results -->
            <div id="searchResults" class="max-h-64 overflow-y-auto"></div>

            <!-- Recently Recorded -->
            <div id="recentlyRecorded" class="mt-4"></div>
        </div>

        @if(request('view') === 'cards')
        <!-- Cards View -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($students as $s)
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg transition">
                    <div class="aspect-square bg-slate-100 dark:bg-slate-800 relative">

       @php
    $img = $s->photo_path && !str_starts_with($s->photo_path, 'http')
        ? asset('storage/' . $s->photo_path)
        : $s->photo_url;
@endphp

<img src="https://localhost:8000/storage/app/public/photos/{{ $s->photo_path }}"


     alt="{{ $s->first_name }} {{ $s->second_name }}"
     class="w-full h-full object-cover" />
                        @if($s->photo_path && !str_starts_with($s->photo_path, 'http'))
                            <img src="localhost:8000/storage/app/public/photos/{{ $s->photo_path }}" alt="{{ $s->first_name }} {{ $s->second_name }}" class="w-full h-full object-cover" title="storage/app/public/{{ $s->photo_path }}">
                        @else
                            <img src="localhost:8000/storage/app/public/photos/{{ $s->photo_path }}" alt="{{ $s->first_name }} {{ $s->second_name }}" class="w-full h-full object-cover" title="{{ $s->photo_path ?? 'No photo' }}">
                        @endif
                        @if($s->status === 'active')
                            <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">✓</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-slate-900 dark:text-white truncate">{{ $s->first_name }} {{ $s->second_name }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $s->player_email ?? '—' }}</p>
                        @if($s->jersey_number || $s->jersey_name)
                            <p class="text-xs text-slate-600 dark:text-slate-400 truncate mt-1">
                                🏀 #{{ $s->jersey_number ?? '—' }} {{ $s->jersey_name ? '· ' . $s->jersey_name : '' }}
                            </p>
                        @endif
                        <div class="mt-2 flex flex-wrap gap-1">
                            @if($s->branch)
                                <span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 text-xs rounded">{{ $s->branch->name }}</span>
                            @endif
                            @if($s->group)
                                <span class="px-2 py-0.5 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 text-xs rounded">{{ $s->group->name }}</span>
                            @endif
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <form method="POST" action="{{ route('students-modern.attendance', $s) }}" class="attendance-ajax-form" data-student-id="{{ $s->id }}">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $s->id }}">
                                <input type="hidden" name="status" value="present">
                                <button type="submit" class="w-full text-center px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition text-sm">
                                    ✅ Record Attendance
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-slate-500">No students found</p>
                </div>
            @endforelse
        </div>
        @else
        <!-- Table View -->
        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-300">
                        <tr>
                            <th class="px-4 py-3 text-left">Student</th>
                            <th class="px-4 py-3 text-left">Group</th>
                            <th class="px-4 py-3 text-left">Branch</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Joined</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($students as $s)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                <td class="px-4 py-3 cursor-pointer" onclick="window.location='{{ route('students-modern.show', $s) }}'">
                                    <div class="flex items-center gap-3">
                                        @if($s->photo_path && !str_starts_with($s->photo_path, 'http'))
                                            <img src="localhost:8000/storage/app/public/photos/{{ $s->photo_path }}" alt="" class="w-10 h-10 rounded object-cover ring-1 ring-slate-200 dark:ring-slate-700" title="storage/app/public/{{ $s->photo_path }}" />
                                        @else
                                            <img src="localhost:8000/storage/app/public/photos/{{ $s->photo_path }}" alt="" class="w-10 h-10 rounded object-cover ring-1 ring-slate-200 dark:ring-slate-700" title="{{ $s->photo_path ?? 'No photo' }}" />
                                        @endif
                                        <div>
                                            <div class="font-semibold text-slate-900 dark:text-white">{{ $s->first_name }} {{ $s->second_name }}</div>
                                            <div class="text-xs text-slate-500">{{ $s->player_email ?? '—' }}</div>
                                            @if($s->jersey_number || $s->jersey_name)
                                                <div class="text-xs text-slate-600 dark:text-slate-400">🏀 #{{ $s->jersey_number ?? '—' }} {{ $s->jersey_name ? '· ' . $s->jersey_name : '' }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 cursor-pointer" onclick="window.location='{{ route('students-modern.show', $s) }}'">{{ optional($s->group)->name ?? 'GROUP A' }}</td>
                                <td class="px-4 py-3 cursor-pointer" onclick="window.location='{{ route('students-modern.show', $s) }}'">{{ optional($s->branch)->name ?? 'KICUKIRO' }}</td>
                                <td class="px-4 py-3 cursor-pointer" onclick="window.location='{{ route('students-modern.show', $s) }}'">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $s->status==='active' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-slate-100 text-slate-700 dark:bg-slate-800/50 dark:text-slate-300' }}">{{ ucfirst($s->status) }}</span>
                                </td>
                                <td class="px-4 py-3 cursor-pointer" onclick="window.location='{{ route('students-modern.show', $s) }}'">{{ $s->joined_at?->format('D m, Y') ?? '10-10-2025' }}</td>
                                <td class="px-4 py-3 text-right" onclick="event.stopPropagation()">
                                    <div class="flex gap-2 justify-end items-center">
                                        <div class="relative group">
                                            <button type="button" onclick="toggleDropdown(this); return false;" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition text-sm flex items-center gap-1">
                                                ✅ Record
                                                <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                            </button>
                                            <div class="absolute right-0 top-full mt-1 hidden bg-white dark:bg-slate-800 shadow-lg rounded-lg z-50 min-w-48 dropdown-menu">
                                                <button type="button" onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'present'); closeDropdown(this); return false;" class="w-full text-left px-4 py-2 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 font-semibold border-b border-slate-200 dark:border-slate-700">
                                                    ✅ Present
                                                </button>
                                                <button type="button" onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'absent'); closeDropdown(this); return false;" class="w-full text-left px-4 py-2 hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold border-b border-slate-200 dark:border-slate-700">
                                                    ❌ Absent
                                                </button>
                                                <button type="button" onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'late'); closeDropdown(this); return false;" class="w-full text-left px-4 py-2 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 font-semibold border-b border-slate-200 dark:border-slate-700">
                                                    ⏰ Late
                                                </button>
                                                <button type="button" onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'excused'); closeDropdown(this); return false;" class="w-full text-left px-4 py-2 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-semibold">
                                                    ℹ️ Excused
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">No students found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $students->links() }}</div>
        </div>
        @endif


        <!-- Pagination for Cards View -->
        @if(request('view') === 'cards')
        <div class="mt-6">
            {{ $students->links() }}
        </div>
        @endif
    </div>
</div>
@push('scripts')
<script>
// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Student attendance system loaded');

    // Check if CSRF token exists
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF token meta tag not found!');
    } else {
        console.log('CSRF token found:', csrfMeta.getAttribute('content').substring(0, 10) + '...');
    }
});

const allStudentsData = @json($students);
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let recentlyRecorded = [];

// Function to record attendance from action menu
function recordStudentAttendance(studentId, studentName, status) {
    console.log('=== RECORDING ATTENDANCE ===');
    console.log('Student ID:', studentId);
    console.log('Student Name:', studentName);
    console.log('Status:', status);

    const today = new Date().toISOString().split('T')[0];
    const url = '{{ route("admin.student-attendance.quick-record") }}';

    // Ensure studentId is an integer
    const parsedStudentId = parseInt(studentId);

    console.log('URL:', url);
    console.log('Date:', today);
    console.log('Parsed Student ID:', parsedStudentId);
    console.log('CSRF Token:', csrfToken ? 'Present' : 'MISSING');

    if (!csrfToken) {
        alert('Error: CSRF token not found. Please refresh the page.');
        return;
    }

    console.log('Sending request with data:', {
        student_id: parsedStudentId,
        attendance_date: today,
        status: status
    });

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            student_id: parsedStudentId,
            attendance_date: today,
            status: status
        })
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);

        // Parse JSON regardless of status code
        return response.json().then(data => {
            console.log('Parsed response:', data);

            if (response.ok) {
                if (data.success) {
                    showNotificationModern(`✓ ${studentName} recorded as ${status}`, 'success');
                } else {
                    showNotificationModern('Error: ' + (data.message || 'Unknown error'), 'error');
                }
            } else {
                // Error response
                console.error('Server error response:', data);
                const errorMsg = data.message || data.errors || response.statusText || 'Unknown error';
                showNotificationModern('Error: ' + JSON.stringify(errorMsg), 'error');
            }
        });
    })
    .catch(error => {
        console.error('Fetch error:', error);
        showNotificationModern('Error: ' + error.message, 'error');
    });
}

// Function to record attendance from quick search
function recordAttendanceQuickModern(studentId, studentName) {
    const status = document.getElementById('attendanceStatus').value || 'present';
    const today = new Date().toISOString().split('T')[0];
    const url = '{{ route("admin.student-attendance.quick-record") }}';

    // Ensure studentId is an integer
    const parsedStudentId = parseInt(studentId);

    console.log('Recording attendance from quick search:', { studentId: parsedStudentId, studentName, status, today, url });

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            student_id: parsedStudentId,
            attendance_date: today,
            status: status
        })
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            // Add to recently recorded
            recentlyRecorded.unshift({ id: parsedStudentId, name: studentName, status: status });
            if (recentlyRecorded.length > 10) recentlyRecorded.pop();

            updateRecentlyRecordedModern();

            // Clear search
            document.getElementById('studentSearch').value = '';
            document.getElementById('searchResults').innerHTML = '';

            // Show success message
            showNotificationModern(`✓ ${studentName} recorded as ${status}`, 'success');
        } else {
            showNotificationModern('Error: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        showNotificationModern('Error: ' + error.message, 'error');
    });
}

// Show notification
function showNotificationModern(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = type === 'success'
        ? 'bg-green-50 dark:bg-green-900/20 border-l-4 border-green-400 p-4 mb-6 text-green-800 dark:text-green-300 rounded fixed top-4 right-4 z-50 max-w-sm'
        : 'bg-red-50 dark:bg-red-900/20 border-l-4 border-red-400 p-4 mb-6 text-red-800 dark:text-red-300 rounded fixed top-4 right-4 z-50 max-w-sm';
    alertDiv.textContent = message;

    document.body.appendChild(alertDiv);

    setTimeout(() => alertDiv.remove(), 3000);
}

// Update recently recorded section
function updateRecentlyRecordedModern() {
    const recentDiv = document.getElementById('recentlyRecorded');
    if (!recentDiv) return;

    if (recentlyRecorded.length === 0) {
        recentDiv.innerHTML = '';
        return;
    }

    recentDiv.innerHTML = `
        <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-400 p-3 rounded">
            <p class="font-bold text-green-900 dark:text-green-300 mb-2">Recently Recorded (${recentlyRecorded.length})</p>
            <div class="flex flex-wrap gap-2">
                ${recentlyRecorded.map(r => `
                    <span class="bg-green-200 dark:bg-green-900/50 text-green-900 dark:text-green-300 px-3 py-1 rounded-full text-sm">
                        ${r.name} - ${r.status}
                    </span>
                `).join('')}
            </div>
        </div>
    `;
}

// Search functionality for quick attendance
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('studentSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const resultsDiv = document.getElementById('searchResults');

            if (!searchTerm) {
                resultsDiv.innerHTML = '';
                return;
            }

            const filtered = allStudentsData.filter(student =>
                student.first_name.toLowerCase().includes(searchTerm) ||
                student.second_name.toLowerCase().includes(searchTerm) ||
                student.id.toString().includes(searchTerm)
            );

            if (filtered.length === 0) {
                resultsDiv.innerHTML = '<p class="text-gray-500 p-2">No students found</p>';
                return;
            }

            resultsDiv.innerHTML = filtered.map(student => `
                <button
                    type="button"
                    class="w-full text-left p-3 mb-2 bg-white dark:bg-slate-800 border border-blue-200 dark:border-blue-700 rounded hover:bg-blue-100 dark:hover:bg-blue-900/30 transition"
                    onclick="recordAttendanceQuickModern(${student.id}, '${student.first_name} ${student.second_name}')"
                >
                    <strong>#${student.id}</strong> - ${student.first_name} ${student.second_name}
                </button>
            `).join('');
        });
    }
});

// Original attendance form submission
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.attendance-ajax-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json().catch(() => response))
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.textContent = '✅ Record Attendance';
                if (data.success || data.message || data.status === 'success') {
                    alert('Attendance recorded successfully!');
                } else if (data.errors) {
                    alert('Error: ' + Object.values(data.errors).join(' '));
                } else {
                    alert('Attendance saved (response may not be JSON).');
                }
            })
            .catch(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = '✅ Record Attendance';
                alert('An error occurred while saving attendance.');
            });
        });
    });
});

// Dropdown toggle functions
function toggleDropdown(button) {
    const dropdown = button.nextElementSibling;
    const isHidden = dropdown.classList.contains('hidden');

    // Close all other dropdowns
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.classList.add('hidden');
    });

    // Toggle current dropdown
    if (isHidden) {
        dropdown.classList.remove('hidden');
    } else {
        dropdown.classList.add('hidden');
    }
}

function closeDropdown(button) {
    const dropdown = button.closest('.dropdown-menu');
    if (dropdown) {
        dropdown.classList.add('hidden');
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.relative.group')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    }
});
</script>
@endpush
@endsection



