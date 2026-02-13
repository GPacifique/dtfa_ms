@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $communication->title }}</h1>
                <p class="text-slate-600 dark:text-slate-400 mt-2">Sent by {{ optional($communication->sender)->name ?? 'DTFA' }} on {{ $communication->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            <a href="{{ route('staff.communications.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                ← Back
            </a>
        </div>

        <div class="space-y-6">
            <!-- Message Body -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">📝 Message</h2>
                <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg border border-slate-200 dark:border-slate-700 whitespace-pre-wrap text-slate-800 dark:text-slate-200 leading-relaxed">
                    {{ $communication->body }}
                </div>
            </div>

            <!-- Minutes -->
            @if ($communication->minutes)
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">📋 Meeting Minutes</h2>
                    <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg border border-slate-200 dark:border-slate-700 whitespace-pre-wrap text-slate-800 dark:text-slate-200 leading-relaxed">
                        {{ $communication->minutes }}
                    </div>
                </div>
            @endif

            <!-- Details -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">📊 Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if ($communication->activity_type)
                        <div>
                            <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Activity Type</h3>
                            <p class="text-slate-900 dark:text-white">{{ ucfirst($communication->activity_type) }}</p>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Audience</h3>
                        <p class="text-slate-900 dark:text-white">{{ $communication->audience === 'all' ? 'All Users & Staff' : 'Staff Only' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Sent By</h3>
                        <p class="text-slate-900 dark:text-white">{{ optional($communication->sender)->name ?? 'DTFA' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">Sent At</h3>
                        <p class="text-slate-900 dark:text-white">{{ $communication->sent_at ? $communication->sent_at->format('M d, Y \a\t h:i A') : $communication->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-2">
                <form action="{{ route('staff.communications.destroy', $communication) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this communication?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                        🗑️ Delete
                    </button>
                </form>
                <a href="{{ route('staff.communications.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition font-semibold">
                    ← Back to Communications
                </a>
            </div>
        </div>
    </div>
@endsection
