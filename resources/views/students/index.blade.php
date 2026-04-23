<!DOCTYPE html>
<html>
<head>
    <title>Students Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📋 Student Attendance</h3>
        <span class="badge bg-dark">{{ now()->format('d M Y') }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('attendance.mark') }}" method="POST">
        @csrf

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Photo</th>
                        <th>Player</th>
                        <th>Program</th>
                        <th>Group</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($students as $student)
                    <tr>

                        <!-- PHOTO -->
                        <td><img src="{{ asset('storage/'.$student->photo_path) }}" width="70">
                            <img src="{{ $student->photo_path 
                                ? asset('storage/'.$student->photo_path) 
                                : 'https://via.placeholder.com/70' }}"
                                width="60" height="60"
                                class="rounded-circle border">
                        </td>

                        <!-- NAME -->
                        <td class="text-start">
                            <strong>{{ $student->full_name }}</strong><br>
                            <small class="text-muted">{{ $student->jersey_name }}</small>
                        </td>

                        <!-- PROGRAM -->
                        <td>{{ $student->program }}</td>

                        <!-- GROUP -->
                        <td>{{ $student->group_id }}</td>

                        <!-- PRESENT -->
                        <td>
                            <input type="radio"
                                   name="attendance[{{ $student->id }}]"
                                   value="present"
                                   {{ (isset($attendance[$student->id]) && $attendance[$student->id]=='present') ? 'checked' : '' }}>
                        </td>

                        <!-- ABSENT -->
                        <td>
                            <input type="radio"
                                   name="attendance[{{ $student->id }}]"
                                   value="absent"
                                   {{ (isset($attendance[$student->id]) && $attendance[$student->id]=='absent') ? 'checked' : '' }}>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <button class="btn btn-success px-4">
                💾 Save Attendance
            </button>
        </div>

    </form>

</div>

</body>
</html>