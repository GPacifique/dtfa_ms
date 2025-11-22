@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold">{{ $communication->title }}</h1>
        <p class="text-sm text-slate-600">{{ $communication->created_at->toDayDateTimeString() }} by {{ optional($communication->sender)->name ?? 'DTFA' }}</p>

        <div class="mt-4 bg-white dark:bg-neutral-800 p-4 rounded border">
            {!! nl2br(e($communication->body)) !!}
        </div>

        @if($communication->minutes)
            <div class="mt-4 bg-white dark:bg-neutral-800 p-4 rounded border">
                <h3 class="font-semibold">Minutes</h3>
                {!! nl2br(e($communication->minutes)) !!}
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('admin.communications.index') }}" class="text-sm">Back</a>
        </div>
    </div>
@endsection
