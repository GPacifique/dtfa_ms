@php($title = 'Welcome to Our Academy')
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-white to-emerald-50">
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-xl shadow p-8">
            <h1 class="text-3xl font-bold mb-2">Welcome</h1>
            <p class="text-slate-600 mb-6">Discover our branches and upcoming training sessions. Contact us to enroll.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-emerald-50 rounded-lg">
                    <p class="text-sm text-slate-500">Branches</p>
                    <div class="text-2xl font-bold mt-1">{{ $branchesCount ?? 0 }}</div>
                </div>

                <div class="md:col-span-2 p-4 bg-white rounded-lg">
                    <p class="text-sm text-slate-500">Upcoming Sessions</p>
                    @if(($upcomingSessions ?? collect())->isEmpty())
                        <div class="text-slate-500 mt-2">No upcoming sessions scheduled. Check back later.</div>
                    @else
                        <ul class="mt-3 space-y-3">
                            @foreach($upcomingSessions as $s)
                                <li class="border rounded p-3">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-semibold">{{ $s->date->format('M d, Y') }} • {{ $s->start_time }}–{{ $s->end_time }}</div>
                                            <div class="text-sm text-slate-600">{{ $s->branch->name ?? 'N/A' }} — {{ $s->group->name ?? 'General' }} — Coach: {{ $s->coach->name ?? 'TBD' }}</div>
                                        </div>
                                        <a href="{{ route('students.index') }}" class="text-sm text-indigo-600">Learn more</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
