@extends('layouts.app')

@section('hero')
    <x-hero :title="$game->home_team . ' vs ' . $game->away_team" :subtitle="$game->date?->format('l, F d, Y') . ' at ' . ($game->time ?? '')">
        <div class="mt-4">
            <a href="{{ route('admin.games.index') }}" class="btn-secondary">← Back to Matches</a>
            <a href="{{ route('admin.games.edit', $game) }}" class="btn-outline">📝 Update Report</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <!-- Top Match Card -->
    <div class="bg-white dark:bg-neutral-900 shadow-lg rounded-2xl overflow-hidden">
        <!-- Header/Status Strip -->
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 p-4 flex justify-between items-center text-white">
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                    {{ $game->isCompleted() ? 'bg-green-500 text-white' : ($game->date && $game->date->isPast() ? 'bg-yellow-500 text-black' : 'bg-blue-500 text-white') }}">
                    {{ $game->isCompleted() ? 'Completed' : ($game->date && $game->date->isPast() ? 'Pending Report' : 'Scheduled') }}
                </span>
                <span class="text-slate-300 text-sm font-medium">{{ $game->date?->format('F d, Y') }} • {{ $game->time }}</span>
            </div>
            <div class="text-slate-400 text-sm">
                 {{ $game->discipline }} Match
            </div>
        </div>

        <!-- Scoreboard Area -->
        <div class="p-8 md:p-12 relative">
             <div class="absolute inset-0 opacity-10 pointer-events-none" style="background: linear-gradient(to right, {{ $game->home_color ?? '#3B82F6' }}, {{ $game->away_color ?? '#EF4444' }});"></div>

             <div class="relative z-10 flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16">
                <!-- Home Team -->
                <div class="flex flex-col items-center text-center w-1/3">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full shadow-2xl border-4 border-white dark:border-neutral-800 flex items-center justify-center mb-4 transform hover:scale-105 transition-transform"
                         style="background-color: {{ $game->home_color ?? '#3B82F6' }};">
                        <span class="text-4xl">🏠</span> <!-- Placeholder for logo -->
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $game->home_team }}</h2>
                </div>

                <!-- VS / Score -->
                <div class="flex flex-col items-center justify-center">
                    @if($game->home_score !== null && $game->away_score !== null)
                        <div class="text-6xl md:text-8xl font-black text-slate-800 dark:text-white tracking-tighter flex items-center gap-4">
                            <span>{{ $game->home_score }}</span>
                            <span class="text-slate-300 text-4xl">:</span>
                            <span>{{ $game->away_score }}</span>
                        </div>
                    @else
                        <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-neutral-800 flex items-center justify-center text-xl font-bold text-slate-400">
                            VS
                        </div>
                    @endif
                </div>

                <!-- Away Team -->
                <div class="flex flex-col items-center text-center w-1/3">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full shadow-2xl border-4 border-white dark:border-neutral-800 flex items-center justify-center mb-4 transform hover:scale-105 transition-transform"
                         style="background-color: {{ $game->away_color ?? '#EF4444' }};">
                        <span class="text-4xl">✈️</span> <!-- Placeholder for logo -->
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $game->away_team }}</h2>
                </div>
             </div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Info Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Key Info Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800">
                    <div class="text-indigo-500 mb-1 text-lg">🏆</div>
                    <p class="text-xs text-indigo-400 uppercase font-bold tracking-wider">Category</p>
                    <p class="font-bold text-indigo-900 dark:text-white">{{ $game->category }}</p>
                </div>
                <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-xl border border-purple-100 dark:border-purple-800">
                    <div class="text-purple-500 mb-1 text-lg">👥</div>
                    <p class="text-xs text-purple-400 uppercase font-bold tracking-wider">Age Group</p>
                    <p class="font-bold text-purple-900 dark:text-white">{{ is_array($game->age_group) ? implode(', ', $game->age_group) : $game->age_group }}</p>
                </div>
                <div class="bg-pink-50 dark:bg-pink-900/20 p-4 rounded-xl border border-pink-100 dark:border-pink-800">
                    <div class="text-pink-500 mb-1 text-lg">🚻</div>
                    <p class="text-xs text-pink-400 uppercase font-bold tracking-wider">Gender</p>
                    <p class="font-bold text-pink-900 dark:text-white">{{ $game->gender }}</p>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800">
                    <div class="text-blue-500 mb-1 text-lg">🏟️</div>
                    <p class="text-xs text-blue-400 uppercase font-bold tracking-wider">Venue</p>
                    <p class="font-bold text-blue-900 dark:text-white truncate" title="{{ $game->venue }}">{{ $game->venue ?? '—' }}</p>
                </div>
            </div>

            <!-- Detailed Stats/Logistics -->
            <div class="bg-white dark:bg-neutral-900 shadow-sm rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
                <div class="bg-gray-50 dark:bg-neutral-800 px-6 py-4 border-b border-gray-100 dark:border-neutral-700">
                     <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <span>📋</span> Logistics & Locations
                     </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="mt-1 bg-green-100 text-green-600 rounded-lg p-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Location</p>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $game->city }}, {{ $game->country }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 bg-orange-100 text-orange-600 rounded-lg p-2">🏢</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Base</p>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $game->base ?? 'Not specified' }}</p>
                            </div>
                        </div>
                         <div class="flex items-start gap-3">
                            <div class="mt-1 bg-teal-100 text-teal-600 rounded-lg p-2">🚌</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Transport</p>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $game->transport }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                         <div class="flex items-start gap-3">
                            <div class="mt-1 bg-yellow-100 text-yellow-600 rounded-lg p-2">🕒</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Kickoff</p>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $game->time }}</p>
                            </div>
                        </div>
                         <div class="flex items-start gap-3">
                            <div class="mt-1 bg-red-100 text-red-600 rounded-lg p-2">🛫</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Departure</p>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $game->departure_time ?? '—' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 bg-blue-100 text-blue-600 rounded-lg p-2">🏁</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Expected End</p>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $game->expected_finish_time ?? '—' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                 @if($game->objective)
                    <div class="px-6 py-4 bg-yellow-50 dark:bg-yellow-900/10 border-t border-yellow-100 dark:border-yellow-900/20">
                        <p class="text-xs text-yellow-600 dark:text-yellow-400 uppercase font-bold mb-1">🎯 Objective</p>
                        <p class="text-gray-800 dark:text-gray-200 text-sm italic">"{{ $game->objective }}"</p>
                    </div>
                @endif
            </div>

            <!-- Match Report Section (if exists) -->
             @if(($game->isCompleted() || $game->yellow_cards_players) && ($game->yellow_cards_players || $game->red_cards_players || $game->incidence || $game->technical_feedback))
            <div class="bg-white dark:bg-neutral-900 shadow-sm rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-100 to-slate-200 dark:from-neutral-800 dark:to-neutral-700 px-6 py-4 border-b border-gray-200 dark:border-neutral-600 flex justify-between items-center">
                     <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <span>📝</span> Post-Match Report
                     </h3>
                </div>
                <div class="p-6">
                    <!-- Cards Grid -->
                    @if($game->yellow_cards_players || $game->red_cards_players || $game->yellow_cards_staff || $game->red_cards_staff)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @if($game->yellow_cards_players || $game->yellow_cards_staff)
                        <div class="bg-yellow-50 dark:bg-yellow-900/10 rounded-xl p-4 border border-yellow-100 dark:border-yellow-800">
                             <h4 class="font-bold text-yellow-700 dark:text-yellow-400 mb-3 flex items-center gap-2">
                                <span class="w-3 h-4 bg-yellow-400 rounded-sm inline-block shadow-sm"></span> Yellow Cards
                             </h4>
                             @if($game->yellow_cards_players)
                                <p class="text-xs font-bold text-yellow-600 uppercase mb-1">Players</p>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach($game->yellow_cards_players as $playerId)
                                        @php $player = \App\Models\Player::find($playerId); @endphp
                                        @if($player)
                                        <span class="px-2 py-1 bg-white dark:bg-neutral-800 text-yellow-700 dark:text-yellow-300 text-xs rounded shadow-sm border border-yellow-200 dark:border-yellow-800">{{ $player->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                             @endif
                              @if($game->yellow_cards_staff)
                                <p class="text-xs font-bold text-yellow-600 uppercase mb-1">Staff</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($game->yellow_cards_staff as $staffId)
                                        @php $staff = \App\Models\Staff::find($staffId); @endphp
                                        @if($staff)
                                        <span class="px-2 py-1 bg-white dark:bg-neutral-800 text-yellow-700 dark:text-yellow-300 text-xs rounded shadow-sm border border-yellow-200 dark:border-yellow-800">{{ $staff->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                             @endif
                        </div>
                        @endif

                        @if($game->red_cards_players || $game->red_cards_staff)
                         <div class="bg-red-50 dark:bg-red-900/10 rounded-xl p-4 border border-red-100 dark:border-red-800">
                             <h4 class="font-bold text-red-700 dark:text-red-400 mb-3 flex items-center gap-2">
                                <span class="w-3 h-4 bg-red-500 rounded-sm inline-block shadow-sm"></span> Red Cards
                             </h4>
                             @if($game->red_cards_players)
                                <p class="text-xs font-bold text-red-600 uppercase mb-1">Players</p>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach($game->red_cards_players as $playerId)
                                        @php $player = \App\Models\Player::find($playerId); @endphp
                                        @if($player)
                                        <span class="px-2 py-1 bg-white dark:bg-neutral-800 text-red-700 dark:text-red-300 text-xs rounded shadow-sm border border-red-200 dark:border-red-800">{{ $player->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                             @endif
                              @if($game->red_cards_staff)
                                <p class="text-xs font-bold text-red-600 uppercase mb-1">Staff</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($game->red_cards_staff as $staffId)
                                        @php $staff = \App\Models\Staff::find($staffId); @endphp
                                        @if($staff)
                                        <span class="px-2 py-1 bg-white dark:bg-neutral-800 text-red-700 dark:text-red-300 text-xs rounded shadow-sm border border-red-200 dark:border-red-800">{{ $staff->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                             @endif
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="space-y-6">
                        @if($game->incidence)
                        <div class="p-4 bg-gray-50 dark:bg-neutral-800 rounded-lg border border-gray-100 dark:border-neutral-700">
                             <h4 class="font-bold text-gray-700 dark:text-gray-200 mb-2">📢 Incidents & Events</h4>
                             <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">{{ $game->incidence }}</p>
                        </div>
                        @endif

                        @if($game->technical_feedback)
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-100 dark:border-blue-800">
                             <h4 class="font-bold text-blue-700 dark:text-blue-200 mb-2">💡 Technical Feedback</h4>
                             <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">{{ $game->technical_feedback }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Staff Widget -->
            <div class="bg-white dark:bg-neutral-900 shadow-sm rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
                <div class="bg-slate-50 dark:bg-neutral-800 px-4 py-3 border-b border-gray-100 dark:border-neutral-700 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 dark:text-white">👔 Coaching Staff</h3>
                    @if($game->notify_staff)
                        <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold uppercase tracking-wide">Notified</span>
                    @endif
                </div>
                <div class="p-4">
                     @if($game->staff_ids && count($game->staff_ids) > 0)
                    <ul class="space-y-3">
                        @foreach($game->staff_ids as $staffId)
                            @php $staff = \App\Models\Staff::find($staffId); @endphp
                            @if($staff)
                            <li class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                    {{ substr($staff->name, 0, 2) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $staff->name }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    @else
                    <div class="text-center py-4">
                        <p class="text-sm text-gray-500 italic block">No staff assigned</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Players Widget -->
            <div class="bg-white dark:bg-neutral-900 shadow-sm rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
                 <div class="bg-slate-50 dark:bg-neutral-800 px-4 py-3 border-b border-gray-100 dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">🏃 Squad List</h3>
                </div>
                <div class="p-4">
                    @if($game->player_ids && count($game->player_ids) > 0)
                    <div class="space-y-2">
                        @foreach($game->player_ids as $playerId)
                            @php $player = \App\Models\Player::find($playerId); @endphp
                            @if($player)
                             <div class="flex items-center gap-3 p-2 hover:bg-gray-50 dark:hover:bg-neutral-800 rounded-lg transition">
                                <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-neutral-700 flex items-center justify-center text-xs font-bold text-slate-500">
                                    {{ substr($player->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $player->name }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <p class="text-sm text-gray-500 italic">No players assigned</p>
                    </div>
                    @endif
                </div>
            </div>
             <!-- Actions Widget -->
            <div class="bg-slate-50 dark:bg-neutral-900 p-4 rounded-xl border border-slate-200 dark:border-neutral-800">
                <h3 class="text-xs font-bold text-slate-400 uppercase mb-3">Quick Actions</h3>
                 <div class="grid grid-cols-2 gap-2">
                     <a href="{{ route('admin.games.edit', $game) }}" class="flex flex-col items-center justify-center p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg hover:border-indigo-400 transition group">
                         <span class="text-xl mb-1 group-hover:scale-110 transition-transform">✏️</span>
                         <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Edit</span>
                     </a>
                     <a href="{{ route('admin.games.report', $game) }}" class="flex flex-col items-center justify-center p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg hover:border-indigo-400 transition group">
                         <span class="text-xl mb-1 group-hover:scale-110 transition-transform">📝</span>
                         <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Report</span>
                     </a>
                      <a href="{{ route('admin.games.index') }}" class="flex flex-col items-center justify-center p-3 bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg hover:border-indigo-400 transition group col-span-2">
                         <span class="text-xl mb-1 group-hover:scale-110 transition-transform">🔙</span>
                         <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Back to List</span>
                     </a>
                 </div>
            </div>
        </div>

    </div>
</div>
@endsection
