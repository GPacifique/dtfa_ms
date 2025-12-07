<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Attendance Report</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #111; }
        h1 { font-size: 20px; margin: 0 0 8px; }
        h2 { font-size: 16px; margin: 16px 0 8px; }
        .muted { color: #555; }
        .grid { display: flex; gap: 12px; }
        .card { border: 1px solid #ddd; border-radius: 6px; padding: 10px; flex: 1; }
        .stats { margin: 10px 0 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background: #f3f4f6; text-align: left; }
        .header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Student Attendance Report</h1>
        <div class="muted">Range: {{ $dateFrom }} to {{ $dateTo }}</div>
    </div>

    <div class="stats grid">
        <div class="card">
            <div>Total</div>
            <div style="font-weight: bold; font-size: 18px;">{{ $stats['total'] ?? 0 }}</div>
        </div>
        <div class="card">
            <div>Present</div>
            <div style="font-weight: bold; font-size: 18px;">{{ $stats['present'] ?? 0 }}</div>
        </div>
        <div class="card">
            <div>Absent</div>
            <div style="font-weight: bold; font-size: 18px;">{{ $stats['absent'] ?? 0 }}</div>
        </div>
        <div class="card">
            <div>Late</div>
            <div style="font-weight: bold; font-size: 18px;">{{ $stats['late'] ?? 0 }}</div>
        </div>
        <div class="card">
            <div>Excused</div>
            <div style="font-weight: bold; font-size: 18px;">{{ $stats['excused'] ?? 0 }}</div>
        </div>
    </div>

    <h2>Top Students (Present Count)</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Present Sessions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topStudents as $i => $s)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $s->first_name }} {{ $s->second_name }}</td>
                    <td>{{ $s->present_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="muted">No data for selected period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="muted" style="margin-top: 16px;">Generated on {{ now()->format('Y-m-d H:i') }}</div>
</body>
</html>
