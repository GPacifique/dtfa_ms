@extends('layouts.app')

@section('title', 'Attendance Calendar')

@section('content')
<div class="container mx-auto py-8 px-4">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Attendance Calendar</h1>
            <p class="text-gray-600 mt-1">Click on any date to view students who attended</p>
        </div>
        <a href="{{ route('admin.student-attendance.index') }}" class="bg-slate-600 text-white px-4 py-2 rounded hover:bg-slate-700 transition">
            ← Back to Attendance List
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Month Navigation -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.attendance-calendar', ['month' => $prevMonth->format('Y-m')]) }}"
               class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ $prevMonth->format('M Y') }}
            </a>
            <h2 class="text-xl font-bold text-gray-800">{{ $currentMonth->format('F Y') }}</h2>
            <a href="{{ route('admin.attendance-calendar', ['month' => $nextMonth->format('Y-m')]) }}"
               class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition flex items-center gap-2">
                {{ $nextMonth->format('M Y') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-1">
            <!-- Day Headers -->
            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                <div class="text-center font-semibold text-gray-600 py-2 bg-gray-50">{{ $day }}</div>
            @endforeach

            <!-- Empty cells for days before month starts -->
            @for($i = 0; $i < $startOfMonth->dayOfWeek; $i++)
                <div class="min-h-[80px] bg-gray-50"></div>
            @endfor

            <!-- Calendar Days -->
            @foreach($calendarDays as $day)
                @php
                    $dateStr = $day['date']->format('Y-m-d');
                    $isToday = $day['date']->isToday();
                    $isPast = $day['date']->isPast() && !$isToday;
                    $isFuture = $day['date']->isFuture();
                    $hasAttendance = $day['present_count'] > 0 || $day['absent_count'] > 0 || $day['late_count'] > 0;
                @endphp
                <div class="min-h-[80px] border rounded-lg p-2 {{ $isToday ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }} {{ $isFuture ? 'bg-gray-50 opacity-60' : '' }} hover:shadow-md transition cursor-pointer"
                     onclick="showDayAttendance('{{ $dateStr }}')"
                     data-date="{{ $dateStr }}">
                    <div class="flex justify-between items-start">
                        <span class="font-semibold {{ $isToday ? 'text-blue-600' : 'text-gray-700' }}">
                            {{ $day['date']->format('j') }}
                        </span>
                        @if($isToday)
                            <span class="text-xs bg-blue-500 text-white px-1 rounded">Today</span>
                        @endif
                    </div>
                    @if($hasAttendance)
                        <div class="mt-1 flex flex-wrap gap-1">
                            @if($day['present_count'] > 0)
                                <span class="text-xs flex items-center gap-1 bg-green-100 text-green-700 px-1.5 py-0.5 rounded">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    {{ $day['present_count'] }}
                                </span>
                            @endif
                            @if($day['late_count'] > 0)
                                <span class="text-xs flex items-center gap-1 bg-yellow-100 text-yellow-700 px-1.5 py-0.5 rounded">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                    {{ $day['late_count'] }}
                                </span>
                            @endif
                            @if($day['absent_count'] > 0)
                                <span class="text-xs flex items-center gap-1 bg-red-100 text-red-700 px-1.5 py-0.5 rounded">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    {{ $day['absent_count'] }}
                                </span>
                            @endif
                        </div>
                    @elseif($isPast)
                        <div class="text-xs text-gray-400 mt-1">No records</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Legend -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <h3 class="font-semibold text-gray-700 mb-2">Legend</h3>
        <div class="flex flex-wrap gap-4">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                <span class="text-sm text-gray-600">Present</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                <span class="text-sm text-gray-600">Late</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                <span class="text-sm text-gray-600">Absent</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                <span class="text-sm text-gray-600">Excused</span>
            </div>
        </div>
    </div>

    <!-- Daily Attendance Modal -->
    <div id="attendanceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="bg-gradient-to-r from-slate-700 to-slate-800 text-white px-6 py-4 flex flex-wrap justify-between items-center gap-2">
                <h3 id="modalTitle" class="text-lg md:text-xl font-bold">Attendance for Date</h3>
                <button onclick="closeModal()" class="text-white hover:text-gray-300 text-2xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <!-- Loading State -->
                <div id="modalLoading" class="text-center py-8">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-slate-300 border-t-slate-600"></div>
                    <p class="mt-2 text-gray-600">Loading attendance...</p>
                </div>

                <!-- Content -->
                <div id="modalContent" class="hidden">
                    <!-- Summary Cards -->
                    <div id="summaryCards" class="flex flex-wrap gap-3 mb-6"></div>

                    <!-- Filter Tabs -->
                    <div class="flex flex-wrap gap-2 mb-4 border-b pb-4">
                        <button onclick="filterStudents('all')" class="filter-btn px-4 py-2 rounded-lg bg-slate-600 text-white transition" data-filter="all">
                            All Students
                        </button>
                        <button onclick="filterStudents('present')" class="filter-btn px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition" data-filter="present">
                            Present
                        </button>
                        <button onclick="filterStudents('late')" class="filter-btn px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition" data-filter="late">
                            Late
                        </button>
                        <button onclick="filterStudents('absent')" class="filter-btn px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition" data-filter="absent">
                            Absent
                        </button>
                        <button onclick="filterStudents('excused')" class="filter-btn px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition" data-filter="excused">
                            Excused
                        </button>
                    </div>

                    <!-- Students Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Photo</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Student Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jersey Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jersey #</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Group</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Coach</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody id="studentsTableBody" class="divide-y divide-gray-200">
                                <!-- Dynamically populated -->
                            </tbody>
                        </table>
                    </div>

                    <!-- No Records Message -->
                    <div id="noRecordsMessage" class="hidden text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-gray-500">No attendance records for this date</p>
                        <a id="recordAttendanceLink" href="#" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Record Attendance
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t">
                <a id="viewFullListLink" href="#" class="text-blue-600 hover:text-blue-800 transition">
                    View Full List →
                </a>
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentStudents = [];
let currentFilter = 'all';

function showDayAttendance(date) {
    const modal = document.getElementById('attendanceModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalLoading = document.getElementById('modalLoading');
    const modalContent = document.getElementById('modalContent');

    // Format date for display
    const displayDate = new Date(date).toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    modalTitle.textContent = `Attendance for ${displayDate}`;
    modal.classList.remove('hidden');
    modalLoading.classList.remove('hidden');
    modalContent.classList.add('hidden');

    // Update links
    document.getElementById('viewFullListLink').href = `{{ route('admin.student-attendance.index') }}?date=${date}`;
    document.getElementById('recordAttendanceLink').href = `{{ route('admin.student-attendance.index') }}?date=${date}`;

    // Fetch attendance data
    fetch(`{{ route('admin.attendance-calendar.day-data') }}?date=${date}`)
        .then(response => response.json())
        .then(data => {
            modalLoading.classList.add('hidden');
            modalContent.classList.remove('hidden');

            if (data.students && data.students.length > 0) {
                currentStudents = data.students;

                // Update summary cards
                updateSummaryCards(data.summary);

                // Show students table
                document.getElementById('noRecordsMessage').classList.add('hidden');
                filterStudents('all');
            } else {
                currentStudents = [];
                document.getElementById('summaryCards').innerHTML = '';
                document.getElementById('studentsTableBody').innerHTML = '';
                document.getElementById('noRecordsMessage').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalLoading.classList.add('hidden');
            modalContent.classList.remove('hidden');
            document.getElementById('noRecordsMessage').classList.remove('hidden');
        });
}

function updateSummaryCards(summary) {
    const summaryCards = document.getElementById('summaryCards');
    summaryCards.innerHTML = `
        <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-2 flex items-center gap-2">
            <span class="text-2xl font-bold text-green-600">${summary.present || 0}</span>
            <span class="text-sm text-green-700">Present</span>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg px-4 py-2 flex items-center gap-2">
            <span class="text-2xl font-bold text-yellow-600">${summary.late || 0}</span>
            <span class="text-sm text-yellow-700">Late</span>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-2 flex items-center gap-2">
            <span class="text-2xl font-bold text-red-600">${summary.absent || 0}</span>
            <span class="text-sm text-red-700">Absent</span>
        </div>
        <div class="bg-purple-50 border border-purple-200 rounded-lg px-4 py-2 flex items-center gap-2">
            <span class="text-2xl font-bold text-purple-600">${summary.excused || 0}</span>
            <span class="text-sm text-purple-700">Excused</span>
        </div>
    `;
}

function filterStudents(filter) {
    currentFilter = filter;

    // Update button styles
    document.querySelectorAll('.filter-btn').forEach(btn => {
        if (btn.dataset.filter === filter) {
            btn.classList.remove('bg-gray-100', 'hover:bg-gray-200');
            btn.classList.add('bg-slate-600', 'text-white');
        } else {
            btn.classList.add('bg-gray-100', 'hover:bg-gray-200');
            btn.classList.remove('bg-slate-600', 'text-white');
        }
    });

    // Filter and display students
    const filtered = filter === 'all'
        ? currentStudents
        : currentStudents.filter(s => s.status === filter);

    renderStudentsTable(filtered);
}

function renderStudentsTable(students) {
    const tbody = document.getElementById('studentsTableBody');

    if (students.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                    No students found with this status
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = students.map(student => `
        <tr class="hover:bg-gray-50 student-row" data-status="${student.status}">
            <td class="px-4 py-3">
                <img src="${student.photo_url}" alt="${student.name}"
                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-200"
                     onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(student.name)}&background=3b82f6&color=fff'">
            </td>
            <td class="px-4 py-3">
                <div class="font-medium text-gray-800">${student.name}</div>
                <div class="text-xs text-gray-500">ID: ${student.id}</div>
            </td>
            <td class="px-4 py-3 text-gray-700 font-medium">${student.jersey_name || '-'}</td>
            <td class="px-4 py-3">
                ${student.jersey_number ? `<span class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white text-sm font-bold rounded-full">${student.jersey_number}</span>` : '<span class="text-gray-400">-</span>'}
            </td>
            <td class="px-4 py-3">
                ${student.group ? `<span class="px-2 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">${student.group}</span>` : '<span class="text-gray-400">-</span>'}
            </td>
            <td class="px-4 py-3 text-gray-600">${student.coach || '-'}</td>
            <td class="px-4 py-3">
                <span class="px-3 py-1 rounded-full text-xs font-medium ${getStatusClass(student.status)}">
                    ${capitalizeFirst(student.status)}
                </span>
            </td>
        </tr>
    `).join('');
}

function getStatusClass(status) {
    const classes = {
        'present': 'bg-green-100 text-green-800',
        'late': 'bg-yellow-100 text-yellow-800',
        'absent': 'bg-red-100 text-red-800',
        'excused': 'bg-purple-100 text-purple-800'
    };
    return classes[status] || 'bg-gray-100 text-gray-800';
}

function capitalizeFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function closeModal() {
    document.getElementById('attendanceModal').classList.add('hidden');
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Close modal on backdrop click
document.getElementById('attendanceModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection
