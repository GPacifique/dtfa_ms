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
                    <a href="{{ route('students-modern.show', $s) }}" class="block aspect-square bg-slate-100 dark:bg-slate-800 relative cursor-pointer">
                        <img src="{{ $s->photo_url }}" alt="{{ $s->first_name }} {{ $s->second_name }}" class="w-full h-full object-cover hover:opacity-90 transition">
                        @if($s->status === 'active')
                            <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">✓</div>
                        @endif
                    </a>
                    <div class="p-4">
                        <a href="{{ route('students-modern.show', $s) }}" class="block">
                            <h3 class="font-bold text-slate-900 dark:text-white truncate hover:text-blue-600 dark:hover:text-blue-400">{{ $s->first_name }} {{ $s->second_name }}</h3>
                        </a>
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
                        <div class="mt-4">
                            <div class="text-xs text-slate-500 dark:text-slate-400 mb-2 text-center">Record Attendance</div>
                            <div class="flex items-center justify-center gap-1">
                                <button type="button"
                                        onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'present')"
                                        class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-green-100 text-green-700 hover:bg-green-600 hover:text-white dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-600 dark:hover:text-white"
                                        title="Mark Present">
                                    ✓
                                </button>
                                <button type="button"
                                        onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'absent')"
                                        class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-red-100 text-red-700 hover:bg-red-600 hover:text-white dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white"
                                        title="Mark Absent">
                                    ✗
                                </button>
                                <button type="button"
                                        onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'late')"
                                        class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-yellow-100 text-yellow-700 hover:bg-yellow-600 hover:text-white dark:bg-yellow-900/30 dark:text-yellow-400 dark:hover:bg-yellow-600 dark:hover:text-white"
                                        title="Mark Late">
                                    ⏰
                                </button>
                                <button type="button"
                                        onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'excused')"
                                        class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-purple-100 text-purple-700 hover:bg-purple-600 hover:text-white dark:bg-purple-900/30 dark:text-purple-400 dark:hover:bg-purple-600 dark:hover:text-white"
                                        title="Mark Excused">
                                    📝
                                </button>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                            <button type="button"
                                    onclick="deleteStudent({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}')"
                                    class="px-3 py-2 rounded-lg text-xs font-medium transition bg-red-100 text-red-700 hover:bg-red-600 hover:text-white dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white"
                                    title="Delete Student">
                                🗑️ Delete
                            </button>
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
                                        <img src="{{ $s->photo_url }}" alt="" class="w-10 h-10 rounded object-cover ring-1 ring-slate-200 dark:ring-slate-700">
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
                                    <div class="flex gap-1 justify-end items-center">
                                        <button type="button"
                                                onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'present')"
                                                class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-green-100 text-green-700 hover:bg-green-600 hover:text-white dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-600 dark:hover:text-white"
                                                title="Mark Present">
                                            ✓
                                        </button>
                                        <button type="button"
                                                onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'absent')"
                                                class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-red-100 text-red-700 hover:bg-red-600 hover:text-white dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white"
                                                title="Mark Absent">
                                            ✗
                                        </button>
                                        <button type="button"
                                                onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'late')"
                                                class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-yellow-100 text-yellow-700 hover:bg-yellow-600 hover:text-white dark:bg-yellow-900/30 dark:text-yellow-400 dark:hover:bg-yellow-600 dark:hover:text-white"
                                                title="Mark Late">
                                            ⏰
                                        </button>
                                        <button type="button"
                                                onclick="recordStudentAttendance({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}', 'excused')"
                                                class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-purple-100 text-purple-700 hover:bg-purple-600 hover:text-white dark:bg-purple-900/30 dark:text-purple-400 dark:hover:bg-purple-600 dark:hover:text-white"
                                                title="Mark Excused">
                                            📝
                                        </button>
                                        <button type="button"
                                                onclick="deleteStudent({{ $s->id }}, '{{ addslashes($s->first_name . ' ' . $s->second_name) }}')"
                                                class="status-btn px-3 py-2 rounded-lg text-xs font-medium transition bg-red-100 text-red-700 hover:bg-red-600 hover:text-white dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white"
                                                title="Delete Student">
                                            🗑️
                                        </button>
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

// Function to delete a student
function deleteStudent(studentId, studentName) {
    if (!confirm(`Are you sure you want to delete ${studentName}? This action cannot be undone.`)) {
        return;
    }

    const url = `{{ url('students-modern') }}/${studentId}`;

    console.log('Deleting student:', studentId, studentName);
    console.log('URL:', url);

    // Create form data with method spoofing for Laravel
    const formData = new FormData();
    formData.append('_method', 'DELETE');
    formData.append('_token', csrfToken);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'text/html,application/json'
        },
        body: formData
    })
    .then(response => {
        console.log('Delete response status:', response.status);
        if (response.ok || response.redirected) {
            showNotificationModern(`✓ ${studentName} has been deleted`, 'success');
            // Reload the page after successful deletion
            setTimeout(() => window.location.reload(), 1000);
        } else {
            throw new Error('Failed to delete student');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
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



