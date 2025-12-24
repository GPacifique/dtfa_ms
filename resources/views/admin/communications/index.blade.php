@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">💬 Communications</h1>
            <a href="{{ route('admin.communications.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Message</a>
        </div>

        <div class="space-y-4">
            @foreach($items as $item)
                <div class="p-4 border rounded bg-white dark:bg-neutral-800">
                    <h3 class="font-semibold">{{ $item->title }}</h3>
                    <p class="text-sm text-slate-600">{{ $item->created_at->toDayDateTimeString() }} by {{ optional($item->sender)->name ?? 'DTFA' }}</p>
                    <div class="mt-2">
                        <a href="{{ route('admin.communications.show', $item) }}" class="text-blue-600">View</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </div>
@endsection
