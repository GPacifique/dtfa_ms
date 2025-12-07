@extends('layouts.app')

@push('hero')
    <x-hero title="Create New Match" subtitle="Schedule a match and assign staff/players">
        <div class="mt-4">
            <a href="{{ route('admin.games.index') }}" class="btn-secondary">← Back to Matches</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-4xl mx-auto p-6">
    @include('admin.games._form')
</div>
@endsection
