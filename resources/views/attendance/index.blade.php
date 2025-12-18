@extends('layouts.app')

@section('title', 'Student Attendance')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Student Attendance for {{ $date }}</h1>
        <div class="flex gap-4">
            <form method="GET" action="{{ route('admin.student-attendance.index') }}" class="flex gap-2">
                <input type="date" name="date" value="{{ $date }}" class="border rounded px-3 py-2">
                <button type="submit" class="bg-slate-600 text-white px-4 py-2 rounded hover:bg-slate-700">Change Date</button>
            </form>
            <form method="POST" action="{{ route('admin.student-attendance.auto-record') }}">
                @csrf
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="status" value="present">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" onclick="return confirm('Auto-record all active students as PRESENT for {{ $date }}?')">
                    ⚡ Auto-Record All
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
            <p class="text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Quick Search & Click-to-Record Section -->
    <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-6 rounded">
        <h2 class="text-lg font-bold mb-4 text-blue-900">Quick Attendance Entry</h2>
        <div class="flex gap-4 mb-4">
            <div class="flex-1">
                <input
                    type="text"
                    id="studentSearch"
                    placeholder="Search student name or ID..."
                    class="w-full border border-blue-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
            <select id="attendanceStatus" class="border border-blue-300 rounded px-4 py-2">
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

    <form method="POST" action="{{ route('admin.student-attendance.store') }}">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <table class="min-w-full bg-white border border-slate-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Student</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td class="px-4 py-2 border">{{ $student->first_name }} {{ $student->second_name }}</td>
                    <td class="px-4 py-2 border">
                        <select name="attendance[{{ $student->id }}]" class="border rounded px-2 py-1">
                            <option value="present" @if(optional($student->attendance->first())->status == 'present') selected @endif>Present</option>
                            <option value="absent" @if(optional($student->attendance->first())->status == 'absent') selected @endif>Absent</option>
                            <option value="late" @if(optional($student->attendance->first())->status == 'late') selected @endif>Late</option>
                            <option value="excused" @if(optional($student->attendance->first())->status == 'excused') selected @endif>Excused</option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Save Attendance</button>
        </div>
    </form>
</div>

<script>
    const allStudents = @json($students);
    const date = '{{ $date }}';
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let recentlyRecorded = [];

    // Search functionality
    document.getElementById('studentSearch').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        const resultsDiv = document.getElementById('searchResults');

        if (!searchTerm) {
            resultsDiv.innerHTML = '';
            return;
        }

        const filtered = allStudents.filter(student =>
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
                class="w-full text-left p-3 mb-2 bg-white border border-blue-200 rounded hover:bg-blue-100 transition"
                onclick="recordAttendanceQuick(${student.id}, '${student.first_name} ${student.second_name}')"
            >
                <strong>#${student.id}</strong> - ${student.first_name} ${student.second_name}
            </button>
        `).join('');
    });

    // Record attendance via AJAX
    function recordAttendanceQuick(studentId, studentName) {
        const status = document.getElementById('attendanceStatus').value;

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
                // Add to recently recorded
                recentlyRecorded.unshift({ id: studentId, name: studentName, status: status });
                if (recentlyRecorded.length > 10) recentlyRecorded.pop();

                updateRecentlyRecorded();

                // Clear search
                document.getElementById('studentSearch').value = '';
                document.getElementById('searchResults').innerHTML = '';

                // Show success message
                showNotification(`✓ ${studentName} recorded as ${status}`, 'success');
            } else {
                showNotification('Error: ' + data.message, 'error');
            }
        })
        .catch(error => {
            showNotification('Error recording attendance', 'error');
            console.error(error);
        });
    }

    // Update recently recorded section
    function updateRecentlyRecorded() {
        const recentDiv = document.getElementById('recentlyRecorded');
        if (recentlyRecorded.length === 0) {
            recentDiv.innerHTML = '';
            return;
        }

        recentDiv.innerHTML = `
            <div class="bg-green-50 border-l-4 border-green-400 p-3 rounded">
                <p class="font-bold text-green-900 mb-2">Recently Recorded (${recentlyRecorded.length})</p>
                <div class="flex flex-wrap gap-2">
                    ${recentlyRecorded.map(r => `
                        <span class="bg-green-200 text-green-900 px-3 py-1 rounded-full text-sm">
                            ${r.name} - ${r.status}
                        </span>
                    `).join('')}
                </div>
            </div>
        `;
    }

    // Show notification
    function showNotification(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = type === 'success'
            ? 'bg-green-50 border-l-4 border-green-400 p-4 mb-6 text-green-800'
            : 'bg-red-50 border-l-4 border-red-400 p-4 mb-6 text-red-800';
        alertDiv.textContent = message;

        const container = document.querySelector('.container');
        container.insertBefore(alertDiv, container.firstChild);

        setTimeout(() => alertDiv.remove(), 3000);
    }
</script>@endsection
