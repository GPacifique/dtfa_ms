@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $game->home_team }} vs {{ $game->away_team }}</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            @if($game->status === 'scheduled')
                📅 Update match details
            @elseif($game->status === 'in_progress')
                🏃 Record match events and report
            @else
                ✅ View completed match report
            @endif
        </p>
    </div>
    @include('admin.games._form')
</div>
@endsection
