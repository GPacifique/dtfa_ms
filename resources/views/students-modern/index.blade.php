@extends('layouts.app')


@section('content')
@section('hide-back')@endsection
<div class="min-h-screen">

    @section('hero')
        <x-hero title="Students" subtitle="Clean, filterable list with responsive table" />
    @endsection

    @if(session('success'))
        <div class="mb-4">
            <x-alert type="success">{{ session('success') }}</x-alert>
        </div>
    @endif


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
                <div class="md:col-span-5 flex items-center justify-between gap-2">
                    <div class="flex gap-2">
                        <x-button :href="request()->fullUrlWithQuery(['view' => 'table'])" variant="secondary" :class="request('view') !== 'cards' ? 'ring-2 ring-indigo-500' : ''">Table</x-button>
                        <x-button :href="request()->fullUrlWithQuery(['view' => 'cards'])" variant="secondary" :class="request('view') === 'cards' ? 'ring-2 ring-indigo-500' : ''">Cards</x-button>
                    </div>
                    <div class="flex gap-2">
                        <x-button type="submit">Filter</x-button>
                        <x-button variant="secondary" type="button" onclick="window.location='{{ route('students-modern.index') }}'">Reset</x-button>
                        <x-button href="{{ route('admin.student-attendance.bulk-create') }}" variant="success">Bulk Attendance</x-button>
                        <x-button href="{{ route('students-modern.create') }}">New Student</x-button>
                    </div>
                </div>
            </form>
        </div>


        @if(request('view') === 'cards')
        <!-- Cards View -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($students as $s)
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg transition">
                    <div class="aspect-square bg-slate-100 dark:bg-slate-800 relative">
                        @if($s->photo_path && !str_starts_with($s->photo_path, 'http'))
                            <img src="{{ asset('storage/' . $s->photo_path) }}" alt="{{ $s->first_name }} {{ $s->second_name }}" class="w-full h-full object-cover" title="storage/app/public/{{ $s->photo_path }}">
                        @else
                            <img src="{{ $s->photo_path }}" alt="{{ $s->first_name }} {{ $s->second_name }}" class="w-full h-full object-cover" title="{{ $s->photo_path ?? 'No photo' }}">
                        @endif
                        @if($s->status === 'active')
                            <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">✓</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-slate-900 dark:text-white truncate">{{ $s->first_name }} {{ $s->second_name }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $s->player_email ?? '—' }}</p>
                        @if($s->jersey_number || $s->jersey_name)
                            <p class="text-xs text-slate-600 dark:text-slate-400 truncate mt-1">
                                🏀 #{{ $s->jersey_number ?? '—' }} {{ $s->jersey_name ? '· ' . $s->jersey_name : '' }}
                            </p>
                        @endif
                        <div class="mt-2 flex flex-wrap gap-1">
                            @if($s->branch)
                                <span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 text-xs rounded">{{ $s->branch->name }}</span>
                            @endif
                            @if($s->group)
                                <span class="px-2 py-0.5 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 text-xs rounded">{{ $s->group->name }}</span>
                            @endif
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            <form method="POST" action="{{ route('students-modern.attendance', $s) }}" class="attendance-ajax-form" data-student-id="{{ $s->id }}">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $s->id }}">
                                <input type="hidden" name="status" value="present">
                                <button type="submit" class="w-full text-center px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition text-sm">
                                    ✅ Record Attendance
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-slate-500">No students found</p>
                </div>
            @endforelse
        </div>
        @else
        <!-- Table View -->
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
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 cursor-pointer transition-colors" onclick="window.location='{{ route('students-modern.show', $s) }}'">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        @if($s->photo_path && !str_starts_with($s->photo_path, 'http'))
                                            <img src="{{ asset('storage/' . $s->photo_path) }}" alt="" class="w-10 h-10 rounded object-cover ring-1 ring-slate-200 dark:ring-slate-700" title="storage/app/public/{{ $s->photo_path }}" />
                                        @else
                                            <img src="{{ $s->photo_path }}" alt="" class="w-10 h-10 rounded object-cover ring-1 ring-slate-200 dark:ring-slate-700" title="{{ $s->photo_path ?? 'No photo' }}" />
                                        @endif
                                        <div>
                                            <div class="font-semibold text-slate-900 dark:text-white">{{ $s->first_name }} {{ $s->second_name }}</div>
                                            <div class="text-xs text-slate-500">{{ $s->player_email ?? '—' }}</div>
                                            @if($s->jersey_number || $s->jersey_name)
                                                <div class="text-xs text-slate-600 dark:text-slate-400">🏀 #{{ $s->jersey_number ?? '—' }} {{ $s->jersey_name ? '· ' . $s->jersey_name : '' }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ optional($s->group)->name ?? 'GROUP A' }}</td>
                                <td class="px-4 py-3">{{ optional($s->branch)->name ?? 'KICUKIRO' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $s->status==='active' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-slate-100 text-slate-700 dark:bg-slate-800/50 dark:text-slate-300' }}">{{ ucfirst($s->status) }}</span>
                                </td>
                                <td class="px-4 py-3">{{ $s->joined_at?->format('D m, Y') ?? '10-10-2025' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <form method="POST" action="{{ route('students-modern.attendance', $s) }}" class="attendance-ajax-form" data-student-id="{{ $s->id }}">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $s->id }}">
                                            <input type="hidden" name="status" value="present">
                                            <button type="submit" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition text-sm">✅ Attendance</button>
                                        </form>
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
        @endif


        <!-- Pagination for Cards View -->
        @if(request('view') === 'cards')
        <div class="mt-6">
            {{ $students->links() }}
        </div>
        @endif
    </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.attendance-ajax-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json().catch(() => response))
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.textContent = '✅ Record Attendance';
                if (data.success || data.message || data.status === 'success') {
                    alert('Attendance recorded successfully!');
                } else if (data.errors) {
                    alert('Error: ' + Object.values(data.errors).join(' '));
                } else {
                    alert('Attendance saved (response may not be JSON).');
                }
            })
            .catch(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = '✅ Record Attendance';
                alert('An error occurred while saving attendance.');
            });
        });
    });
});
</script>
@endpush
@endsection



