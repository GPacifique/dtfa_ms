@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        {{-- Hero Section --}}
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 rounded-2xl shadow-2xl mb-6">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-lime-400/30 to-green-500/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-cyan-400/30 to-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

            <div class="relative z-10 px-6 py-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">⚽ Players</h1>
                    <p class="text-white/90 mt-1">Manage team rosters and player profiles</p>
                </div>
                <a href="{{ route('admin.players.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-emerald-700 font-semibold rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Player
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow rounded-lg p-4">
            <table class="w-full text-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Team</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($players as $player)
                    <tr class="border-t">
                        <td>{{ $player->first_name }} {{ $player->last_name }}</td>
                        <td>{{ optional($player->team)->name }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.players.edit', $player) }}" class="text-indigo-600">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $players->links() }}</div>
    </div>
@endsection
