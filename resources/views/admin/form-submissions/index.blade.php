@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">📋 Form Submissions</h1>
            <div class="flex gap-2">
                <select id="filterStatus" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <option value="">All Status</option>
                    <option value="received">Received</option>
                    <option value="read">Read</option>
                    <option value="acknowledged">Acknowledged</option>
                    <option value="resolved">Resolved</option>
                </select>
                <select id="filterType" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <option value="">All Types</option>
                    <option value="contact">Contact</option>
                    <option value="complaint">Complaint</option>
                    <option value="feedback">Feedback</option>
                    <option value="incident">Incident</option>
                    <option value="suggestion">Suggestion</option>
                </select>
            </div>
        </div>

        @if ($submissions->isEmpty())
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6 text-center">
                <p class="text-blue-900 dark:text-blue-200">No form submissions yet.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($submissions as $submission)
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                        {{ $submission->subject ?? 'No Subject' }}
                                    </h3>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-900 dark:text-indigo-100">
                                        {{ $submission->getFormTypeLabel() }}
                                    </span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if ($submission->status === 'received')
                                            bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100
                                        @elseif ($submission->status === 'read')
                                            bg-yellow-100 dark:bg-yellow-900 text-yellow-900 dark:text-yellow-100
                                        @elseif ($submission->status === 'acknowledged')
                                            bg-purple-100 dark:bg-purple-900 text-purple-900 dark:text-purple-100
                                        @else
                                            bg-green-100 dark:bg-green-900 text-green-900 dark:text-green-100
                                        @endif
                                    ">
                                        {{ $submission->getStatusLabel() }}
                                    </span>
                                </div>

                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">
                                    @if ($submission->submitter)
                                        <strong>From:</strong> {{ $submission->submitter->name }} ({{ $submission->submitter->email }})
                                    @else
                                        <strong>From:</strong> Anonymous User
                                    @endif
                                    • {{ $submission->created_at->format('M d, Y \a\t h:i A') }}
                                </p>

                                <p class="text-sm text-slate-700 dark:text-slate-300 line-clamp-2">
                                    {{ Str::limit($submission->message, 150) }}
                                </p>

                                @if ($submission->assignedStaff)
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                        👤 Assigned to: <strong>{{ $submission->assignedStaff->name }}</strong>
                                    </p>
                                @endif
                            </div>

                            <div class="flex gap-2 ml-4">
                                <a href="{{ route('admin.form-submissions.show', $submission) }}" class="inline-flex items-center gap-2 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                                    👁️ View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $submissions->links() }}
            </div>
        @endif
    </div>

    <script>
        document.getElementById('filterStatus').addEventListener('change', function() {
            const status = this.value;
            const type = document.getElementById('filterType').value;
            filterSubmissions(status, type);
        });

        document.getElementById('filterType').addEventListener('change', function() {
            const type = this.value;
            const status = document.getElementById('filterStatus').value;
            filterSubmissions(status, type);
        });

        function filterSubmissions(status, type) {
            const url = new URL(window.location);
            if (status) url.searchParams.set('status', status);
            else url.searchParams.delete('status');

            if (type) url.searchParams.set('form_type', type);
            else url.searchParams.delete('form_type');

            window.location = url.toString();
        }
    </script>
@endsection
