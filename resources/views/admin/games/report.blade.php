@extends('layouts.app')

@section('hero')
    <x-hero title="Match Report" subtitle="Record match outcome and statistics">
        <div class="mt-4">
            <a href="{{ route('admin.games.index') }}" class="btn-secondary">← Back to Matches</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <!-- Match Info Card -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-xl p-6 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-90 mb-2">{{ $game->date?->format('l, F j, Y') }} at {{ $game->time }}</p>
                <div class="flex items-center gap-4 text-2xl font-bold">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full shadow-lg" style="background-color: {{ $game->home_color ?? '#fff' }}"></span>
                        <span>{{ $game->home_team }}</span>
                    </div>
                    <span class="opacity-75">vs</span>
                    <div class="flex items-center gap-2">
                        <span>{{ $game->away_team }}</span>
                        <span class="w-6 h-6 rounded-full shadow-lg" style="background-color: {{ $game->away_color ?? '#fff' }}"></span>
                    </div>
                </div>
                <p class="text-sm opacity-90 mt-2">📍 {{ $game->venue }} • {{ $game->discipline }} • {{ $game->category }}</p>
            </div>

        </div>
    </div>

    <form action="{{ route('admin.games.update', $game) }}" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-xl p-8">
        @csrf
        @method('PUT')

        <!-- Match Score Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-emerald-500">
                🏆 Final Score
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Home Team Score -->
                <div class="p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-8 rounded-full shadow-lg" style="background-color: {{ $game->home_color ?? '#1E40AF' }}"></span>
                        <h3 class="font-bold text-xl text-blue-900 dark:text-blue-200">{{ $game->home_team }}</h3>
                    </div>
                    <input type="number" name="home_score" value="{{ $game->home_score ?? '' }}" min="0" class="w-full text-5xl font-bold text-center border-2 border-blue-300 dark:border-blue-700 rounded-lg px-4 py-6 dark:bg-neutral-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="0">
                    @error('home_score')<span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>@enderror
                </div>

                <!-- Away Team Score -->
                <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-8 rounded-full shadow-lg" style="background-color: {{ $game->away_color ?? '#DC2626' }}"></span>
                        <h3 class="font-bold text-xl text-red-900 dark:text-red-200">{{ $game->away_team }}</h3>
                    </div>
                    <input type="number" name="away_score" value="{{ $game->away_score ?? '' }}" min="0" class="w-full text-5xl font-bold text-center border-2 border-red-300 dark:border-red-700 rounded-lg px-4 py-6 dark:bg-neutral-800 focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="0">
                    @error('away_score')<span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Cards & Disciplinary Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-yellow-500">
                🟨🟥 Cards & Disciplinary Actions
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Yellow Cards Players -->
                <div x-data="multiSelect({
                    items: {{ $players->map(fn($p) => ['id' => $p->id, 'name' => $p->first_name . ' ' . ($p->second_name ?? $p->last_name ?? '')])->toJson() }},
                    selected: {{ json_encode($game->yellow_cards_players ?? []) }},
                    inputName: 'yellow_cards_players[]'
                })">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">🟨 Yellow Cards (Players)</label>
                    <div class="relative">
                        <div class="w-full min-h-[128px] border border-yellow-300 dark:border-yellow-700 rounded-lg px-4 py-3 dark:bg-neutral-800 cursor-text flex flex-wrap gap-2 content-start" @click="open = true; $nextTick(() => $refs.search.focus())">
                            <template x-for="id in selectedIds" :key="id">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 text-sm rounded-md">
                                    <span x-text="getItemName(id)"></span>
                                    <button type="button" @click.stop="toggleItem(id)" class="hover:text-yellow-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </span>
                            </template>
                            <input x-ref="search" type="text" x-model="search" @focus="open = true" placeholder="Search players..." class="flex-1 min-w-[120px] outline-none bg-transparent text-sm dark:text-white">
                        </div>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-neutral-800 border dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                            <template x-for="item in filteredItems" :key="item.id">
                                <div @click="toggleItem(item.id)" class="px-3 py-2 cursor-pointer hover:bg-yellow-50 dark:hover:bg-neutral-700 flex items-center justify-between">
                                    <span x-text="item.name" class="text-sm dark:text-white"></span>
                                    <svg x-show="selectedIds.includes(item.id)" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </template>
                            <div x-show="filteredItems.length === 0" class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">No players found</div>
                        </div>
                    </div>
                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="yellow_cards_players[]" :value="id">
                    </template>
                    @error('yellow_cards_players')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Red Cards Players -->
                <div x-data="multiSelect({
                    items: {{ $players->map(fn($p) => ['id' => $p->id, 'name' => $p->first_name . ' ' . ($p->second_name ?? $p->last_name ?? '')])->toJson() }},
                    selected: {{ json_encode($game->red_cards_players ?? []) }},
                    inputName: 'red_cards_players[]'
                })">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">🟥 Red Cards (Players)</label>
                    <div class="relative">
                        <div class="w-full min-h-[128px] border border-red-300 dark:border-red-700 rounded-lg px-4 py-3 dark:bg-neutral-800 cursor-text flex flex-wrap gap-2 content-start" @click="open = true; $nextTick(() => $refs.search.focus())">
                            <template x-for="id in selectedIds" :key="id">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 text-sm rounded-md">
                                    <span x-text="getItemName(id)"></span>
                                    <button type="button" @click.stop="toggleItem(id)" class="hover:text-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </span>
                            </template>
                            <input x-ref="search" type="text" x-model="search" @focus="open = true" placeholder="Search players..." class="flex-1 min-w-[120px] outline-none bg-transparent text-sm dark:text-white">
                        </div>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-neutral-800 border dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                            <template x-for="item in filteredItems" :key="item.id">
                                <div @click="toggleItem(item.id)" class="px-3 py-2 cursor-pointer hover:bg-red-50 dark:hover:bg-neutral-700 flex items-center justify-between">
                                    <span x-text="item.name" class="text-sm dark:text-white"></span>
                                    <svg x-show="selectedIds.includes(item.id)" class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </template>
                            <div x-show="filteredItems.length === 0" class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">No players found</div>
                        </div>
                    </div>
                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="red_cards_players[]" :value="id">
                    </template>
                    @error('red_cards_players')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Yellow Cards Staff -->
                <div x-data="multiSelect({
                    items: {{ $staffs->map(fn($s) => ['id' => $s->id, 'name' => $s->first_name . ' ' . $s->last_name])->toJson() }},
                    selected: {{ json_encode($game->yellow_cards_staff ?? []) }},
                    inputName: 'yellow_cards_staff[]'
                })">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">🟨 Yellow Cards (Staff)</label>
                    <div class="relative">
                        <div class="w-full min-h-[128px] border border-yellow-300 dark:border-yellow-700 rounded-lg px-4 py-3 dark:bg-neutral-800 cursor-text flex flex-wrap gap-2 content-start" @click="open = true; $nextTick(() => $refs.search.focus())">
                            <template x-for="id in selectedIds" :key="id">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 text-sm rounded-md">
                                    <span x-text="getItemName(id)"></span>
                                    <button type="button" @click.stop="toggleItem(id)" class="hover:text-yellow-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </span>
                            </template>
                            <input x-ref="search" type="text" x-model="search" @focus="open = true" placeholder="Search staff..." class="flex-1 min-w-[120px] outline-none bg-transparent text-sm dark:text-white">
                        </div>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-neutral-800 border dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                            <template x-for="item in filteredItems" :key="item.id">
                                <div @click="toggleItem(item.id)" class="px-3 py-2 cursor-pointer hover:bg-yellow-50 dark:hover:bg-neutral-700 flex items-center justify-between">
                                    <span x-text="item.name" class="text-sm dark:text-white"></span>
                                    <svg x-show="selectedIds.includes(item.id)" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </template>
                            <div x-show="filteredItems.length === 0" class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">No staff found</div>
                        </div>
                    </div>
                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="yellow_cards_staff[]" :value="id">
                    </template>
                    @error('yellow_cards_staff')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Red Cards Staff -->
                <div x-data="multiSelect({
                    items: {{ $staffs->map(fn($s) => ['id' => $s->id, 'name' => $s->first_name . ' ' . $s->last_name])->toJson() }},
                    selected: {{ json_encode($game->red_cards_staff ?? []) }},
                    inputName: 'red_cards_staff[]'
                })">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">🟥 Red Cards (Staff)</label>
                    <div class="relative">
                        <div class="w-full min-h-[128px] border border-red-300 dark:border-red-700 rounded-lg px-4 py-3 dark:bg-neutral-800 cursor-text flex flex-wrap gap-2 content-start" @click="open = true; $nextTick(() => $refs.search.focus())">
                            <template x-for="id in selectedIds" :key="id">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 text-sm rounded-md">
                                    <span x-text="getItemName(id)"></span>
                                    <button type="button" @click.stop="toggleItem(id)" class="hover:text-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </span>
                            </template>
                            <input x-ref="search" type="text" x-model="search" @focus="open = true" placeholder="Search staff..." class="flex-1 min-w-[120px] outline-none bg-transparent text-sm dark:text-white">
                        </div>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-neutral-800 border dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                            <template x-for="item in filteredItems" :key="item.id">
                                <div @click="toggleItem(item.id)" class="px-3 py-2 cursor-pointer hover:bg-red-50 dark:hover:bg-neutral-700 flex items-center justify-between">
                                    <span x-text="item.name" class="text-sm dark:text-white"></span>
                                    <svg x-show="selectedIds.includes(item.id)" class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </template>
                            <div x-show="filteredItems.length === 0" class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">No staff found</div>
                        </div>
                    </div>
                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="red_cards_staff[]" :value="id">
                    </template>
                    @error('red_cards_staff')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Match Incidents Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-orange-500">
                ⚠️ Match Incidents
            </h2>
            <textarea name="incidence" rows="5" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Describe any significant incidents during the match (injuries, disputes, unusual events, etc.)...">{{ $game->incidence ?? '' }}</textarea>
            @error('incidence')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
        </div>

        <!-- Technical Feedback Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-teal-500">
                📊 Technical Feedback
            </h2>
            <textarea name="technical_feedback" rows="6" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="Provide technical analysis, team performance notes, areas of improvement, standout players, tactics used, etc...">{{ $game->technical_feedback ?? '' }}</textarea>
            @error('technical_feedback')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="{{ route('admin.games.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold transition">
                Cancel
            </a>
            <div class="flex gap-4">
                <button type="submit" name="action" value="save" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                    💾 Save
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('multiSelect', ({ items, selected, inputName }) => ({
            items: items,
            selectedIds: selected.map(id => parseInt(id)),
            search: '',
            open: false,

            get filteredItems() {
                if (!this.search) return this.items;
                const searchLower = this.search.toLowerCase();
                return this.items.filter(item => item.name.toLowerCase().includes(searchLower));
            },

            toggleItem(id) {
                id = parseInt(id);
                if (this.selectedIds.includes(id)) {
                    this.selectedIds = this.selectedIds.filter(i => i !== id);
                } else {
                    this.selectedIds.push(id);
                }
            },

            getItemName(id) {
                const item = this.items.find(i => i.id === parseInt(id));
                return item ? item.name : '';
            }
        }));
    });
</script>
@endpush
