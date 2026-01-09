@extends('layouts.app')

@push('hero')
    <x-hero title="Training Session Records" subtitle="Filter and review training sessions" gradient="emerald">
        <div class="mt-4">
            <a href="{{ route('training_sessions.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-emerald-700 font-semibold rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Record
            </a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="p-4 border-b">
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs text-gray-500">Branch</label>
                    <select name="branch" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm">
                        <option value="">All</option>
                        @if(!empty($branches))
                            @foreach($branches as $b)
                                <option value="{{ $b }}" {{ request('branch') === $b ? 'selected' : '' }}>{{ $b }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">Pitch</label>
                    <select name="training_pitch" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm">
                        <option value="">All</option>
                        @if(!empty($pitches))
                            @foreach($pitches as $p)
                                <option value="{{ $p }}" {{ request('training_pitch') === $p ? 'selected' : '' }}>{{ $p }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">Coach</label>
                    <select name="coach_id" class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm">
                        <option value="">All</option>
                        @if(!empty($coaches))
                            @foreach($coaches as $c)
                                <option value="{{ $c->id }}" {{ request('coach_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">Date</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm" />
                </div>

                <div class="ml-2">
                    <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white rounded-md text-sm">Filter</button>
                    <a href="{{ route('training_sessions.index') }}" class="ml-2 px-3 py-1.5 border rounded-md text-sm">Reset</a>
                </div>
            </form>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Coach</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pitch</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Branch</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($records as $record)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($record->date)->format('Y-m-d') ?? $record->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $record->coach_name ?? ($record->coach->name ?? '—') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $record->training_pitch ?? '—' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $record->branch ?? '—' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('training_sessions.show', $record) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                            <a href="{{ route('training_sessions.edit', $record) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('training_sessions.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            No training session records found.
                            <a href="{{ route('training_sessions.create') }}" class="text-indigo-600 hover:text-indigo-900 ml-1">Create one now</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $records->links() }}
    </div>
</div>
@endsection
