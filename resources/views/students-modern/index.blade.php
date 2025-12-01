@extends('layouts.app')

@section('content')
@section('hide-back')@endsection
<div class="min-h-screen">
    <div class="footer-like-hero relative overflow-hidden">
        <div class="hero-blob-layer">
            <div class="hero-blob blob-1"></div>
            <div class="hero-blob blob-2"></div>
            <div class="hero-blob blob-3"></div>
        </div>
        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Students</h1>
            <p class="text-emerald-100">Clean, filterable list with responsive table</p>
        </div>
    </div>

    <div class="container mx-auto px-6 mt-8 relative z-20">
        @if(session('status'))
            <x-alert type="success" class="mb-4">{{ session('status') }}</x-alert>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-4 mb-4">
            <form method="get" class="grid grid-cols-1 md:grid-cols-5 gap-3">
                <x-input name="q" label="Search" :value="request('q')" placeholder="Name, email, phone..." />
                <x-select name="status" label="Status" :options="['active' => 'Active', 'inactive' => 'Inactive']" :value="request('status')" placeholder="All" />
                <x-select name="branch_id" label="Branch" :options="$branches->pluck('name','id')" :value="request('branch_id')" placeholder="All" />
                <x-select name="group_id" label="Group" :options="$groups->pluck('name','id')" :value="request('group_id')" placeholder="All" />
                <div class="grid grid-cols-2 gap-2">
                    <x-input type="date" name="from" label="From" :value="request('from')" />
                    <x-input type="date" name="to" label="To" :value="request('to')" />
                </div>
                <div class="md:col-span-5 flex items-center justify-end gap-2">
                    <x-button type="submit">Filter</x-button>
                    <x-button variant="secondary" type="button" onclick="window.location='{{ route('students-modern.index') }}'">Reset</x-button>
                    <x-button href="{{ route('students-modern.create') }}">New Student</x-button>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-300">
                        <tr>
                            <th class="px-4 py-3 text-left">Student</th>
                            <th class="px-4 py-3 text-left">Group</th>
                            <th class="px-4 py-3 text-left">Branch</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Joined</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($students as $s)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $s->photo_url }}" alt="" class="w-10 h-10 rounded object-cover ring-1 ring-slate-200 dark:ring-slate-700" />
                                        <div>
                                            <div class="font-semibold text-slate-900 dark:text-white">{{ $s->first_name }} {{ $s->second_name }}</div>
                                            <div class="text-xs text-slate-500">{{ $s->email ?? '—' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ optional($s->group)->name ?? '—' }}</td>
                                <td class="px-4 py-3">{{ optional($s->branch)->name ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $s->status==='active' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-slate-100 text-slate-700 dark:bg-slate-800/50 dark:text-slate-300' }}">{{ ucfirst($s->status) }}</span>
                                </td>
                                <td class="px-4 py-3">{{ $s->joined_at?->format('M d, Y') ?? '—' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <x-button variant="secondary" href="{{ route('students-modern.show', $s) }}">View</x-button>
                                        <x-button variant="secondary" href="{{ route('students-modern.edit', $s) }}">Edit</x-button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">No students found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $students->links() }}</div>
        </div>
    </div>
</div>
@endsection
