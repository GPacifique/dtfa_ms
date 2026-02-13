@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">💬 Communications</h1>
            <a href="{{ route('staff.communications.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Message</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($items as $item)
                <div class="p-4 border rounded-lg bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 hover:shadow-md transition">
                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ $item->title }}</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ $item->created_at->toDayDateTimeString() }} by {{ optional($item->sender)->name ?? 'DTFA' }}</p>
                    <p class="text-sm text-slate-700 dark:text-slate-300 mt-2 line-clamp-2">{{ Str::limit($item->body, 150) }}</p>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('staff.communications.show', $item) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-semibold">View Details</a>
                        <form action="{{ route('staff.communications.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this communication?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm font-semibold">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg text-center">
                    <p class="text-blue-900 dark:text-blue-200">No communications yet.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $items->links() }}
        </div>
    </div>
@endsection
