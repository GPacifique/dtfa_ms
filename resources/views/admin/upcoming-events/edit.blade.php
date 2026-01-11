@extends('layouts.app')

@section('hero')
    <x-hero title="Edit Upcoming Event" subtitle="{{ $event->event_name }}">
        <a href="{{ route('admin.upcoming-events.show', $event) }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg mr-2">View</a>
        <a href="{{ route('admin.upcoming-events.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Events</a>
    </x-hero>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">

    @include('admin.upcoming-events._form', ['event' => $event])
</div>
@endsection
