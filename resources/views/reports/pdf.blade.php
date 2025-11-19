<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reports PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <div style="display:flex;justify-content:space-between;align-items:center">
        <h2>Reports</h2>
        <div style="text-align:right;font-size:12px;color:#555">
            Generated: {{ now()->format('F j, Y') }}<br>
            Year: {{ now()->year }}
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Workstream</th>
                <th>Activity</th>
                <th>Status</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->no }}</td>
                <td>{{ $report->workstream }}</td>
                <td>{{ $report->activity }}</td>
                <td>{{ $report->status }}</td>
                <td>{{ $report->comments }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
