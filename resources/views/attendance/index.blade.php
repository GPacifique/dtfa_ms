@extends('layouts.app')

@section('title', 'Student Attendance')

@section('content')
<div class="container mx-auto py-8 px-4">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600 rounded-2xl shadow-2xl mb-6">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-orange-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-purple-400/30 to-pink-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

        <div class="relative z-10 px-6 py-8 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">📋 Student Attendance</h1>
                <p class="text-white/90 mt-1">{{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.attendance-calendar') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Calendar
                </a>
                <form method="GET" action="{{ route('admin.student-attendance.index') }}" class="flex gap-2">
                    <input type="date" name="date" value="{{ $date }}" class="px-3 py-2 bg-white/20 backdrop-blur-sm border border-white/30 text-white rounded-xl focus:ring-2 focus:ring-white/50 focus:border-transparent placeholder-white/70">
                    @if($showAll ?? false)
                        <input type="hidden" name="show_all" value="1">
                    @endif
                    <button type="submit" class="px-4 py-2 bg-white hover:bg-slate-50 text-blue-700 font-semibold rounded-xl shadow-lg transition">Go</button>
                </form>
            </div>
        </div>
    </div>

    <!-- View Toggle -->
    <div class="flex items-center justify-between bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
        <div class="flex items-center gap-4">
            <span class="text-gray-700 font-medium">View:</span>
            <a href="{{ route('admin.student-attendance.index', ['date' => $date]) }}"
               class="px-4 py-2 rounded-lg transition {{ !($showAll ?? false) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Recorded Only
            </a>
            <a href="{{ route('admin.student-attendance.index', ['date' => $date, 'show_all' => 1]) }}"
               class="px-4 py-2 rounded-lg transition {{ ($showAll ?? false) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                All Students
            </a>
        </div>
        <div class="text-sm text-gray-500">
            @if($showAll ?? false)
                Showing all active students - Click status buttons to record
            @else
                Showing students with attendance records for this date
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
            <p class="text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Summary Cards -->
    @php
        $presentCount = $students->filter(fn($s) => optional($s->attendance->first())->status === 'present')->count();
        $absentCount = $students->filter(fn($s) => optional($s->attendance->first())->status === 'absent')->count();
        $lateCount = $students->filter(fn($s) => optional($s->attendance->first())->status === 'late')->count();
        $excusedCount = $students->filter(fn($s) => optional($s->attendance->first())->status === 'excused')->count();
        $notRecorded = $students->filter(fn($s) => !$s->attendance->first())->count();
    @endphp
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center cursor-pointer hover:shadow-md transition" onclick="filterByStatus('present')">
            <div class="text-3xl font-bold text-green-600" id="count-present">{{ $presentCount }}</div>
            <div class="text-sm text-green-700">Present</div>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center cursor-pointer hover:shadow-md transition" onclick="filterByStatus('absent')">
            <div class="text-3xl font-bold text-red-600" id="count-absent">{{ $absentCount }}</div>
            <div class="text-sm text-red-700">Absent</div>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-center cursor-pointer hover:shadow-md transition" onclick="filterByStatus('late')">
            <div class="text-3xl font-bold text-yellow-600" id="count-late">{{ $lateCount }}</div>
            <div class="text-sm text-yellow-700">Late</div>
        </div>
        <div class="bg-purple-50 border border-purple-200 rounded-xl p-4 text-center cursor-pointer hover:shadow-md transition" onclick="filterByStatus('excused')">
            <div class="text-3xl font-bold text-purple-600" id="count-excused">{{ $excusedCount }}</div>
            <div class="text-sm text-purple-700">Excused</div>
        </div>
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:shadow-md transition" onclick="filterByStatus('none')">
            <div class="text-3xl font-bold text-gray-600" id="count-none">{{ $notRecorded }}</div>
            <div class="text-sm text-gray-700">Not Recorded</div>
        </div>
    </div>

    <!-- Quick Search Section -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 p-6 mb-6 rounded-xl shadow-sm">
        <h2 class="text-lg font-bold mb-4 text-blue-900 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Search Students
        </h2>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input
                    type="text"
                    id="studentSearch"
                    placeholder="Search by name, jersey name, or jersey number..."
                    class="w-full border border-blue-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white"
                />
            </div>
            <button type="button" onclick="clearSearch()" class="px-4 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Clear
            </button>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-slate-700 to-slate-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Photo</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Student Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Jersey Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Jersey #</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Group</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Coach</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody id="studentsTableBody" class="bg-white divide-y divide-gray-200">
                    @forelse($students as $index => $student)
                    @php
                        $currentStatus = optional($student->attendance->first())->status;
                        $statusColors = [
                            'present' => 'bg-green-50',
                            'absent' => 'bg-red-50',
                            'late' => 'bg-yellow-50',
                            'excused' => 'bg-purple-50',
                        ];
                        $rowClass = $currentStatus ? ($statusColors[$currentStatus] ?? '') : '';
                    @endphp
                    <tr class="hover:bg-gray-100 transition {{ $rowClass }} student-row"
                        data-student-id="{{ $student->id }}"
                        data-status="{{ $currentStatus ?? 'none' }}"
                        data-name="{{ strtolower($student->first_name . ' ' . $student->second_name) }}"
                        data-jersey-name="{{ strtolower($student->jersey_name ?? '') }}"
                        data-jersey-number="{{ $student->jersey_number ?? '' }}">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <a href="{{ route('students-modern.show', $student) }}" class="block">
                                <img src="{{ $student->photo_url }}" alt="{{ $student->first_name }}"
                                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-200 hover:border-blue-500 hover:scale-110 transition"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($student->first_name . ' ' . $student->second_name) }}&background=3b82f6&color=fff'">
                            </a>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $student->first_name }} {{ $student->second_name }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $student->id }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="text-gray-700 font-medium">{{ $student->jersey_name ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($student->jersey_number)
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white text-sm font-bold rounded-full">
                                    {{ $student->jersey_number }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($student->group)
                                <span class="px-2 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">
                                    {{ $student->group->name }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $student->coach ?? '-' }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $date }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @if($showAll ?? false)
                                No active students found
                            @else
                                No attendance records for this date.
                                <a href="{{ route('admin.student-attendance.index', ['date' => $date, 'show_all' => 1]) }}" class="text-blue-600 hover:underline">
                                    Click here to record attendance
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="text-sm text-gray-600">
            Total: <strong>{{ $students->count() }}</strong> students
            <span id="filteredCount" class="ml-2 text-blue-600"></span>
        </div>
        <div class="text-sm text-gray-500">
            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Click on status buttons to record attendance one by one
        </div>
    </div>
</div>

<script>
    const date = '{{ $date }}';
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let currentFilter = 'all';

    // Record attendance via AJAX
    function recordAttendance(studentId, status, studentName) {
        const row = document.querySelector(`tr[data-student-id="${studentId}"]`);
        const buttons = row.querySelectorAll('.status-btn');

        // Disable buttons during request
        buttons.forEach(btn => btn.disabled = true);

        fetch('{{ route("admin.student-attendance.quick-record") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                student_id: studentId,
                attendance_date: date,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Get previous status
                const prevStatus = row.dataset.status;

                // Update row styling
                row.classList.remove('bg-green-50', 'bg-red-50', 'bg-yellow-50', 'bg-purple-50');
                const statusColors = {
                    'present': 'bg-green-50',
                    'absent': 'bg-red-50',
                    'late': 'bg-yellow-50',
                    'excused': 'bg-purple-50'
                };
                if (statusColors[status]) {
                    row.classList.add(statusColors[status]);
                }

                // Update button styling
                buttons.forEach(btn => {
                    const btnStatus = btn.dataset.status;
                    btn.classList.remove('bg-green-600', 'bg-red-600', 'bg-yellow-600', 'bg-purple-600',
                                        'text-white', 'ring-2', 'ring-green-400', 'ring-red-400',
                                        'ring-yellow-400', 'ring-purple-400');

                    if (btnStatus === status) {
                        // Active button
                        const activeClasses = {
                            'present': ['bg-green-600', 'text-white', 'ring-2', 'ring-green-400'],
                            'absent': ['bg-red-600', 'text-white', 'ring-2', 'ring-red-400'],
                            'late': ['bg-yellow-600', 'text-white', 'ring-2', 'ring-yellow-400'],
                            'excused': ['bg-purple-600', 'text-white', 'ring-2', 'ring-purple-400']
                        };
                        btn.classList.add(...activeClasses[status]);
                        btn.classList.remove('bg-green-100', 'bg-red-100', 'bg-yellow-100', 'bg-purple-100',
                                            'text-green-700', 'text-red-700', 'text-yellow-700', 'text-purple-700');
                    } else {
                        // Inactive buttons
                        const inactiveClasses = {
                            'present': ['bg-green-100', 'text-green-700'],
                            'absent': ['bg-red-100', 'text-red-700'],
                            'late': ['bg-yellow-100', 'text-yellow-700'],
                            'excused': ['bg-purple-100', 'text-purple-700']
                        };
                        btn.classList.add(...inactiveClasses[btnStatus]);
                    }
                });

                // Update status label
                const label = row.querySelector('.status-label');
                label.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                label.classList.remove('text-gray-400');

                // Update row data attribute
                row.dataset.status = status;

                // Update counts
                updateCounts(prevStatus, status);

                // Show success message
                showNotification(`✓ ${studentName} marked as ${status}`, 'success');
            } else {
                showNotification('Error: ' + data.message, 'error');
            }
        })
        .catch(error => {
            showNotification('Error recording attendance', 'error');
            console.error(error);
        })
        .finally(() => {
            // Re-enable buttons
            buttons.forEach(btn => btn.disabled = false);
        });
    }

    // Update summary counts
    function updateCounts(prevStatus, newStatus) {
        // Decrease previous count
        if (prevStatus && prevStatus !== 'none') {
            const prevEl = document.getElementById(`count-${prevStatus}`);
            if (prevEl) {
                prevEl.textContent = parseInt(prevEl.textContent) - 1;
            }
        } else {
            // Was not recorded
            const noneEl = document.getElementById('count-none');
            if (noneEl) {
                noneEl.textContent = parseInt(noneEl.textContent) - 1;
            }
        }

        // Increase new count
        const newEl = document.getElementById(`count-${newStatus}`);
        if (newEl) {
            newEl.textContent = parseInt(newEl.textContent) + 1;
        }
    }

    // Search functionality
    document.getElementById('studentSearch').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.student-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.dataset.name || '';
            const jerseyName = row.dataset.jerseyName || '';
            const jerseyNumber = row.dataset.jerseyNumber || '';

            const matches = !searchTerm ||
                name.includes(searchTerm) ||
                jerseyName.includes(searchTerm) ||
                jerseyNumber.includes(searchTerm);

            if (matches && (currentFilter === 'all' || row.dataset.status === currentFilter)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        updateFilteredCount(visibleCount);
    });

    // Filter by status
    function filterByStatus(status) {
        currentFilter = status === currentFilter ? 'all' : status;
        const searchTerm = document.getElementById('studentSearch').value.toLowerCase().trim();
        const rows = document.querySelectorAll('.student-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowStatus = row.dataset.status || 'none';
            const name = row.dataset.name || '';
            const jerseyName = row.dataset.jerseyName || '';
            const jerseyNumber = row.dataset.jerseyNumber || '';

            const matchesSearch = !searchTerm ||
                name.includes(searchTerm) ||
                jerseyName.includes(searchTerm) ||
                jerseyNumber.includes(searchTerm);

            const matchesFilter = currentFilter === 'all' || rowStatus === currentFilter;

            if (matchesSearch && matchesFilter) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        updateFilteredCount(visibleCount);
    }

    function updateFilteredCount(count) {
        const el = document.getElementById('filteredCount');
        const total = document.querySelectorAll('.student-row').length;
        if (count < total) {
            el.textContent = `(showing ${count})`;
        } else {
            el.textContent = '';
        }
    }

    function clearSearch() {
        document.getElementById('studentSearch').value = '';
        currentFilter = 'all';
        document.querySelectorAll('.student-row').forEach(row => {
            row.style.display = '';
        });
        document.getElementById('filteredCount').textContent = '';
    }

    // Show notification
    function showNotification(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = type === 'success'
            ? 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2'
            : 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2';
        alertDiv.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success'
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>'}
            </svg>
            ${message}
        `;

        document.body.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => alertDiv.remove(), 300);
        }, 2000);
    }
</script>
@endsection
