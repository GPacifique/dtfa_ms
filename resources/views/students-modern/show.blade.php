@extends('layouts.app')

@section('content')
@section('hide-back')@endsection
<div class="container mx-auto px-6 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Student Profile</h1>
        <div class="flex gap-2">
            <x-button href="{{ route('students-modern.create') }}" variant="primary">+ New Student</x-button>
            <x-button href="{{ route('students-modern.edit', $student) }}" variant="secondary">Edit</x-button>
            <x-button href="{{ route('students-modern.index') }}" variant="secondary">Back to List</x-button>
        </div>
    </div>

    @if(session('status'))
        <x-alert type="success" class="mb-4">{{ session('status') }}</x-alert>
    @endif

    @if(session('attendance_success'))
        <div class="mb-4 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg">
            <p class="text-emerald-800 dark:text-emerald-300 font-semibold">✅ {{ session('attendance_success') }}</p>
        </div>
    @endif
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-slate-100 to-slate-50 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <nav class="text-sm text-slate-600 dark:text-slate-300 flex items-center gap-2">
                <a href="{{ route('admin.students.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Students</a>
                <span aria-hidden="true">/</span>
                <span class="font-medium text-slate-900 dark:text-white">{{ $student->first_name }} {{ $student->second_name }}</span>
            </nav>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.students.edit', $student) }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 text-white px-4 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-6 4h10M7 13h10M9 17h6"/></svg>
                    Edit
                </a>
                <a href="{{ route('admin.students.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 text-slate-800 px-4 py-2 text-sm font-semibold shadow-sm hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2 transition dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 12l6-6m-6 6l6 6"/></svg>
                    Back
                </a>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 mb-8">
            <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-r from-indigo-600 via-cyan-500 to-indigo-500 opacity-20 pointer-events-none"></div>
            <div class="relative p-6 md:p-8">
                <div class="flex items-start gap-6">
                    <img alt="Profile photo" src="{{ $student->photo_url }}" class="w-20 h-20 rounded-xl object-cover ring-4 ring-white dark:ring-slate-800 shadow-md" />
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3">
                            <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-900 dark:text-white">{{ $student->first_name }} {{ $student->second_name }}</h1>
                            <span class="inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200 px-3 py-1 text-xs font-semibold">{{ ucfirst($student->status ?? 'active') }}</span>
                        </div>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ $student->sport_discipline ?? 'Sport Discipline' }} · {{ $student->position ?? 'Position' }} · Jersey: {{ $student->jersey_number ?? '—' }}</p>
                        <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-4 shadow-sm"><p class="text-xs text-slate-500 dark:text-slate-400">Age</p><p class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">{{ $student->age ?? '—' }}</p></div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-4 shadow-sm"><p class="text-xs text-slate-500">Branch</p><p class="mt-1 text-lg font-semibold">{{ optional($student->branch)->name ?? '—' }}</p></div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-4 shadow-sm"><p class="text-xs text-slate-500">Group</p><p class="mt-1 text-lg font-semibold">{{ optional($student->group)->name ?? '—' }}</p></div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-4 shadow-sm"><p class="text-xs text-slate-500">Joined</p><p class="mt-1 text-lg font-semibold">{{ optional($student->joined_at)->format('M d, Y') ?? '—' }}</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 space-y-6">
                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Contacts</h2>
                        <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">Primary and guardian contacts</p>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between"><span class="text-sm text-slate-600 dark:text-slate-300">Player Email</span><a href="mailto:{{ $student->player_email }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">{{ $student->player_email ?? '—' }}</a></div>
                            <div class="flex items-center justify-between"><span class="text-sm text-slate-600 dark:text-slate-300">Parent Email</span><a href="mailto:{{ $student->parent_email }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">{{ $student->parent_email ?? '—' }}</a></div>
                            <div class="flex items-center justify-between"><span class="text-sm text-slate-600 dark:text-slate-300">Player Phone</span><a href="tel:{{ $student->player_phone }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">{{ $student->player_phone ?? '—' }}</a></div>
                            <div class="flex items-center justify-between"><span class="text-sm text-slate-600 dark:text-slate-300">Emergency Phone</span><a href="tel:{{ $student->emergency_phone }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">{{ $student->emergency_phone ?? '—' }}</a></div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700">
                        <div class="flex items-center gap-2">
                            <button type="button" class="inline-flex items-center gap-2 rounded-lg bg-cyan-600 text-white px-3 py-2 text-xs font-semibold shadow-sm hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8a6 6 0 11-12 0"/></svg>Send Message</button>
                            <button type="button" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 text-slate-800 px-3 py-2 text-xs font-semibold shadow-sm hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2 transition dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Add Note</button>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6 space-y-3">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Program & School</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div><p class="text-xs text-slate-500">Program</p><p class="mt-1 text-sm font-medium">{{ $student->program ?? '—' }}</p></div>
                            <div><p class="text-xs text-slate-500">School</p><p class="mt-1 text-sm font-medium">{{ $student->school_name ?? '—' }}</p></div>
                            <div><p class="text-xs text-slate-500">Coach</p><p class="mt-1 text-sm font-medium">{{ $student->coach ?? '—' }}</p></div>
                            <div><p class="text-xs text-slate-500">Training Days</p><p class="mt-1 text-sm font-medium">@if(is_array($student->training_days)){{ implode(', ', $student->training_days) }}@else{{ $student->training_days ?? '—' }}@endif</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between"><h2 class="text-lg font-semibold text-slate-900 dark:text-white">Subscriptions</h2><a href="{{ route('accountant.subscriptions.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a></div>
                        <div class="mt-4 overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-700">
                            <table class="min-w-full text-sm">
                                <thead class="bg-slate-50 dark:bg-slate-900 sticky top-0"><tr class="text-left text-slate-600 dark:text-slate-300"><th class="px-4 py-3">Plan</th><th class="px-4 py-3">Start</th><th class="px-4 py-3">End</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Actions</th></tr></thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @forelse($student->subscriptions as $sub)
                                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-900/40 transition">
                                            <td class="px-4 py-3 text-slate-900 dark:text-white">{{ optional($sub->plan)->name ?? '—' }}</td>
                                            <td class="px-4 py-3">{{ optional($sub->start_date)->format('M d, Y') ?? $sub->start_date }}</td>
                                            <td class="px-4 py-3">{{ optional($sub->end_date)->format('M d, Y') ?? ($sub->end_date ?: '—') }}</td>
                                            <td class="px-4 py-3"><span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold @if($sub->status === 'active') bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200 @elseif($sub->status === 'expired') bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200 @elseif($sub->status === 'paused') bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-200 @else bg-rose-100 text-rose-700 dark:bg-rose-900 dark:text-rose-200 @endif">{{ ucfirst($sub->status) }}</span></td>
                                            <td class="px-4 py-3 text-right"><a href="{{ route('accountant.subscriptions.show', $sub) }}" class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Details</a></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">No subscriptions found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between"><h2 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Payments</h2><a href="{{ route('accountant.payments.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a></div>
                        <div class="mt-4 overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-700">
                            <table class="min-w-full text-sm">
                                <thead class="bg-slate-50 dark:bg-slate-900 sticky top-0"><tr class="text-left text-slate-600 dark:text-slate-300"><th class="px-4 py-3">Amount</th><th class="px-4 py-3">Method</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Paid At</th><th class="px-4 py-3 text-right">Action</th></tr></thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @forelse($student->payments()->latest('paid_at')->limit(5)->get() as $pay)
                                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-900/40 transition">
                                            <td class="px-4 py-3 font-semibold text-slate-900 dark:text-white">{{ number_format((int) $pay->amount_cents) }} RWF</td>
                                            <td class="px-4 py-3">{{ ucfirst(str_replace('_',' ', $pay->method)) }}</td>
                                            <td class="px-4 py-3"><span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold @if($pay->status === 'succeeded') bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200 @elseif($pay->status === 'pending') bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-200 @else bg-rose-100 text-rose-700 dark:bg-rose-900 dark:text-rose-200 @endif">{{ ucfirst($pay->status) }}</span></td>
                                            <td class="px-4 py-3">{{ optional($pay->paid_at)->format('M d, Y H:i') ?? '—' }}</td>
                                            <td class="px-4 py-3 text-right"><a href="{{ route('accountant.payments.show', $pay) }}" class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9"/></svg>Details</a></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">No payments found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between"><h2 class="text-lg font-semibold text-slate-900 dark:text-white">Attendance Timeline</h2><a href="{{ route('admin.student-attendance.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a></div>
                        <div class="mt-4 space-y-4">
                            @forelse($student->attendances()->latest()->limit(8)->get() as $att)
                                <div class="flex items-start gap-3"><span class="mt-1 w-2 h-2 rounded-full @if($att->status === 'present') bg-emerald-500 @elseif($att->status === 'absent') bg-rose-500 @else bg-amber-500 @endif"></span><div class="flex-1"><p class="text-sm text-slate-900 dark:text-white font-medium capitalize">{{ $att->status }}</p><p class="text-xs text-slate-600 dark:text-slate-300">{{ optional($att->created_at)->format('M d, Y H:i') }} · Session #{{ $att->training_session_id }}</p></div></div>
                            @empty
                                <p class="text-sm text-slate-500">No attendance records found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
