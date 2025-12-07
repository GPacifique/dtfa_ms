@extends('layouts.app')

@push('hero')
    <x-hero :title="$game->home_team . ' vs ' . $game->away_team" subtitle="{{ $game->status === 'scheduled' ? '📅 Update match details' : ($game->status === 'in_progress' ? '🏃 Record match events and report' : '✅ View completed match report') }}">
        <div class="mt-4">
            <a href="{{ route('admin.games.index') }}" class="btn-secondary">← Back to Matches</a>
            <a href="{{ route('admin.games.show', $game) }}" class="btn-outline">View</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-4xl mx-auto p-6">
    @include('admin.games._form')
</div>
@endsection
