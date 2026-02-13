@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $formSubmission->subject ?? 'Form Submission' }}</h1>
                <p class="text-slate-600 dark:text-slate-400 mt-2">{{ $formSubmission->getFormTypeLabel() }}</p>
            </div>
            <a href="{{ route('admin.form-submissions.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                ← Back
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="md:col-span-2 space-y-6">
                <!-- Submission Details -->
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">📝 Submission Details</h2>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Submitted By</h3>
                            @if ($formSubmission->submitter)
                                <p class="text-slate-900 dark:text-white">
                                    <strong>{{ $formSubmission->submitter->name }}</strong> (ID: {{ $formSubmission->submitter->id }})
                                </p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $formSubmission->submitter->email }}</p>
                            @else
                                <p class="text-slate-600 dark:text-slate-400 italic">Anonymous User</p>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Form Type</h3>
                                <p class="text-slate-900 dark:text-white">{{ $formSubmission->getFormTypeLabel() }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Status</h3>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full
                                    @if ($formSubmission->status === 'received')
                                        bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100
                                    @elseif ($formSubmission->status === 'read')
                                        bg-yellow-100 dark:bg-yellow-900 text-yellow-900 dark:text-yellow-100
                                    @elseif ($formSubmission->status === 'acknowledged')
                                        bg-purple-100 dark:bg-purple-900 text-purple-900 dark:text-purple-100
                                    @else
                                        bg-green-100 dark:bg-green-900 text-green-900 dark:text-green-100
                                    @endif
                                ">
                                    {{ $formSubmission->getStatusLabel() }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Submitted</h3>
                                <p class="text-slate-900 dark:text-white">{{ $formSubmission->created_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                            @if ($formSubmission->read_at)
                                <div>
                                    <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Read</h3>
                                    <p class="text-slate-900 dark:text-white">{{ $formSubmission->read_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Message Content -->
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">💬 Message</h2>
                    <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg border border-slate-200 dark:border-slate-700 whitespace-pre-wrap text-slate-800 dark:text-slate-200">
                        {{ $formSubmission->message }}
                    </div>
                </div>

                <!-- Additional Form Data -->
                @if ($formSubmission->form_data && is_array($formSubmission->form_data) && count($formSubmission->form_data) > 0)
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">📋 Additional Information</h2>
                        <div class="space-y-3">
                            @foreach ($formSubmission->form_data as $key => $value)
                                <div class="border-b border-slate-200 dark:border-slate-700 pb-3 last:border-b-0">
                                    <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">{{ ucwords(str_replace('_', ' ', $key)) }}</h3>
                                    <p class="text-slate-900 dark:text-white">
                                        @if (is_array($value))
                                            {{ implode(', ', $value) }}
                                        @else
                                            {{ $value }}
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Notes -->
                @if ($formSubmission->notes || auth()->check())
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">📝 Staff Notes</h2>
                        <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg border border-slate-200 dark:border-slate-700 min-h-20 text-slate-800 dark:text-slate-200 whitespace-pre-wrap">
                            {{ $formSubmission->notes ?? 'No notes yet' }}
                        </div>

                        @if (auth()->check())
                            <form action="{{ route('admin.form-submissions.status', $formSubmission) }}" method="POST" class="mt-4">
                                @csrf
                                <textarea name="notes" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" rows="3" placeholder="Add notes...">{{ $formSubmission->notes }}</textarea>
                                <div class="flex gap-2 mt-2">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Save Notes</button>
                                </div>
                            </form>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar Actions -->
            <div class="md:col-span-1 space-y-4">
                <!-- Status Update -->
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-4">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-3">Change Status</h3>
                    <form action="{{ route('admin.form-submissions.status', $formSubmission) }}" method="POST" class="space-y-2">
                        @csrf
                        <select name="status" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                            <option value="received" {{ $formSubmission->status === 'received' ? 'selected' : '' }}>Received</option>
                            <option value="read" {{ $formSubmission->status === 'read' ? 'selected' : '' }}>Read</option>
                            <option value="acknowledged" {{ $formSubmission->status === 'acknowledged' ? 'selected' : '' }}>Acknowledged</option>
                            <option value="resolved" {{ $formSubmission->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                        <button type="submit" class="w-full px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">Update Status</button>
                    </form>
                </div>

                <!-- Recipients -->
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-4">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-3">📧 Recipients</h3>
                    <div class="space-y-2">
                        @forelse ($formSubmission->recipients as $recipient)
                            <div class="text-sm p-2 bg-slate-50 dark:bg-slate-900 rounded">
                                <p class="text-slate-700 dark:text-slate-300">{{ $recipient->recipient_email }}</p>
                                @if ($recipient->sent_at)
                                    <p class="text-xs text-green-600 dark:text-green-400">✓ Sent</p>
                                @elseif ($recipient->error_message)
                                    <p class="text-xs text-red-600 dark:text-red-400">✗ Failed</p>
                                @else
                                    <p class="text-xs text-yellow-600 dark:text-yellow-400">⏳ Pending</p>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-slate-600 dark:text-slate-400">No recipients tracked</p>
                        @endforelse
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-4">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-3">Actions</h3>
                    <div class="space-y-2">
                        @if (!$formSubmission->read_at)
                            <form action="{{ route('admin.form-submissions.mark-read', $formSubmission) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold text-sm">Mark as Read</button>
                            </form>
                        @endif

                        <form action="{{ route('admin.form-submissions.destroy', $formSubmission) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold text-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
