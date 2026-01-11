@extends('layouts.app')

@section('hero')
    <x-hero title="Create New Upcoming Event" subtitle="Add a new upcoming event to the system">
        <a href="{{ route('admin.upcoming-events.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Events</a>
    </x-hero>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">

    @include('admin.upcoming-events._form')
</div>
@endsection
