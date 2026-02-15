<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEO Dashboard Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #10b981;
        }
        .header h1 {
            color: #1e293b;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .header p {
            color: #64748b;
            font-size: 14px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background-color: #f1f5f9;
            color: #1e293b;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #e2e8f0;
        }
        table td {
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
        }
        table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .metric-box {
            display: inline-block;
            width: 48%;
            padding: 15px;
            margin-right: 2%;
            margin-bottom: 10px;
            background-color: #f8fafc;
            border-left: 4px solid #10b981;
            vertical-align: top;
        }
        .metric-box:nth-child(even) {
            margin-right: 0;
        }
        .metric-label {
            color: #64748b;
            font-size: 11px;
            margin-bottom: 5px;
        }
        .metric-value {
            color: #1e293b;
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            color: #64748b;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CEO Dashboard Report</h1>
        <p>Period: {{ $startDate ?? 'N/A' }} - {{ $endDate ?? 'N/A' }}</p>
        <p>Generated: {{ $generatedAt ?? now()->format('M d, Y H:i:s') }}</p>
    </div>

    <div class="section">
        <div class="section-title">Financial Overview</div>
        <div class="metric-box">
            <div class="metric-label">Total Revenue</div>
            <div class="metric-value">{{ number_format($totalRevenue ?? 0) }} RWF</div>
        </div>
        <div class="metric-box">
            <div class="metric-label">Total Expenses</div>
            <div class="metric-value">{{ number_format($totalExpenses ?? 0) }} RWF</div>
        </div>
        <div class="metric-box">
            <div class="metric-label">Net Profit</div>
            <div class="metric-value">{{ number_format($netProfit ?? 0) }} RWF</div>
        </div>
        <div class="metric-box">
            <div class="metric-label">Active Students</div>
            <div class="metric-value">{{ $activeStudents ?? 0 }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Organization Statistics</div>
        <table>
            <tr>
                <th>Metric</th>
                <th>Count</th>
            </tr>
            <tr>
                <td>Total Students</td>
                <td>{{ $totalStudents ?? 0 }}</td>
            </tr>
            <tr>
                <td>Active Students</td>
                <td>{{ $activeStudents ?? 0 }}</td>
            </tr>
            <tr>
                <td>Total Branches</td>
                <td>{{ $totalBranches ?? 0 }}</td>
            </tr>
            <tr>
                <td>Total Groups</td>
                <td>{{ $totalGroups ?? 0 }}</td>
            </tr>
            <tr>
                <td>Total Coaches</td>
                <td>{{ $totalCoaches ?? 0 }}</td>
            </tr>
            <tr>
                <td>Sessions This Week</td>
                <td>{{ $sessionsThisWeek ?? 0 }}</td>
            </tr>
        </table>
    </div>

    @if(isset($topBranches) && count($topBranches) > 0)
    <div class="section">
        <div class="section-title">Top Performing Branches</div>
        <table>
            <tr>
                <th>Rank</th>
                <th>Branch Name</th>
                <th>Revenue (RWF)</th>
            </tr>
            @foreach($topBranches as $index => $branch)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $branch['name'] ?? 'N/A' }}</td>
                <td>{{ number_format($branch['revenue'] ?? 0) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif

    <div class="footer">
        <p>This report was automatically generated by the DTFA Management System</p>
        <p>© {{ date('Y') }} Don de la Foi Tennis Academy. All rights reserved.</p>
    </div>
</body>
</html>
