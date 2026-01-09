@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 rounded-2xl shadow-2xl mb-6">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-pink-400/30 to-rose-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-blue-400/30 to-cyan-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

        <div class="relative z-10 px-6 py-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">🏫 In-House Trainings</h1>
                <p class="text-white/90 mt-1">Manage capacity building and training programs</p>
            </div>
            <a href="{{ route('trainings.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-violet-700 font-semibold rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Training
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300">
                <tr class="border-b border-slate-200 dark:border-slate-700">
                <th>ID</th>
                <th>Training Name</th>
                <th>Discipline</th>
                <th>Country</th>
                <th>Start</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($trainings as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->training_name }}</td>
                <td>{{ $t->discipline }}</td>
                <td>{{ $t->country }}</td>
                <td>{{ $t->start }}</td>
                <td>{{ $t->branch->name ?? '' }}</td>

                <td>
                    <a href="{{ route('trainings.show', $t->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('trainings.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('trainings.destroy', $t->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $trainings->links() }}
</div>
@endsection
