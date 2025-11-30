@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Upcoming Event</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $event->event_name }}</p>
    </div>

    @include('admin.upcoming-events._form', ['event' => $event])
</div>
@endsection
