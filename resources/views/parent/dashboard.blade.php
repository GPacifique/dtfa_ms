@php $title = __('app.parent_dashboard'); @endphp
@extends('layouts.app')

@section('content')
<div class="container-page">
    <h1 class="page-title mb-6">{{ __('app.my_children') }}</h1>

    @if($children->isEmpty())
        <div class="card">
            <div class="card-body text-center py-8 text-slate-500">
                {{ __('app.no_children_associated') }}
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($children as $child)
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-xl font-semibold text-slate-900 mb-4">
                            {{ $child->first_name }} {{ $child->second_name }}
                        </h2>

                        @if($child->subscriptions->isEmpty())
                            <div class="text-sm text-slate-500 mb-4">{{ __('app.no_active_subscription') }}</div>
                        @else
                            @php $subscription = $child->subscriptions->first(); @endphp
                            <div class="space-y-3 mb-4">
                                <div>
                                    <div class="text-sm text-slate-600">{{ __('app.plan') }}</div>
                                    <div class="font-medium text-slate-900">{{ $subscription->plan->name }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-600">{{ __('app.status') }}</div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($subscription->status === 'active') bg-green-100 text-green-800
                                        @elseif($subscription->status === 'paused') bg-yellow-100 text-yellow-800
                                        @elseif($subscription->status === 'expired') bg-red-100 text-red-800
                                        @else bg-slate-100 text-slate-800
                                        @endif">
                                        {{ ucfirst($subscription->status) }}
                                    </span>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-600">{{ __('app.outstanding_balance') }}</div>
                                    <div class="font-semibold
                                        @if($subscription->outstanding_balance > 0) text-red-600
                                        @else text-green-600
                                        @endif">
                                        {{ number_format($subscription->outstanding_balance, 0) }} RWF
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-600">{{ __('app.total_invoiced') }}</div>
                                    <div class="text-slate-900">{{ number_format($subscription->total_invoiced, 0) }} RWF</div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-600">{{ __('app.total_paid') }}</div>
                                    <div class="text-slate-900">{{ number_format($subscription->total_paid, 0) }} RWF</div>
                                </div>
                            </div>
                        @endif

                        <x-button :href="route('parent.child-payments', $child)" variant="primary" class="w-full">
                            {{ __('app.view_payment_history') }}
                        </x-button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- 1. TOP ROW --}}
    <div class="row g-3">

        <!-- Child Overview -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Child Overview
                </div>
                <div class="card-body">
                    <h5>{{ $student->name }}</h5>
                    <p class="mb-1">Age: {{ $student->age ?? 'N/A' }}</p>
                    <p class="mb-1">Category: {{ $student->category ?? 'Junior' }}</p>
                    <span class="badge bg-success">Active</span>
                </div>
            </div>
        </div>

        <!-- Attendance -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Attendance
                </div>
                <div class="card-body">
                    <p>Total Sessions: {{ $attendance['total'] ?? 0 }}</p>
                    <p>Present: {{ $attendance['present'] ?? 0 }}</p>
                    <p>Absent: {{ $attendance['absent'] ?? 0 }}</p>

                    <strong>
                        Rate: {{ $attendance['rate'] ?? 0 }}%
                    </strong>
                </div>
            </div>
        </div>

        <!-- Payments -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    Payments
                </div>
                <div class="card-body">
                    <p>Total Paid: {{ $payments['total'] ?? 0 }}</p>
                    <p>Pending: {{ $payments['pending'] ?? 0 }}</p>
                    <p>Last Payment: {{ $payments['last_date'] ?? 'N/A' }}</p>

                    <a href="{{ route('parent.child-payments', $student->id) }}"
                       class="btn btn-sm btn-outline-success mt-2">
                        View Details
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- 2. SECOND ROW --}}
    <div class="row g-3 mt-2">

        <!-- Performance -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning">
                    Performance Progress
                </div>
                <div class="card-body">
                    <p>Coach Rating: {{ $performance['rating'] ?? 'N/A' }}/10</p>
                    <p>Notes: {{ $performance['notes'] ?? 'No feedback yet' }}</p>

                    <div class="progress">
                        <div class="progress-bar bg-warning"
                             style="width: {{ ($performance['rating'] ?? 0) * 10 }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coach Feedback -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    Coach Feedback
                </div>
                <div class="card-body">
                    <p>{{ $feedback ?? 'No feedback available yet.' }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- 3. THIRD ROW --}}
    <div class="row g-3 mt-2">

        <!-- Schedule -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Schedule
                </div>
                <div class="card-body">
                    <p>Next Training: {{ $schedule['next'] ?? 'Not set' }}</p>
                    <p>Days/Week: {{ $schedule['days'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    Notifications
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @forelse($notifications ?? [] as $note)
                            <li>• {{ $note }}</li>
                        @empty
                            <li>No notifications</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Achievements -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Achievements
                </div>
                <div class="card-body">
                    @forelse($achievements ?? [] as $ach)
                        <span class="badge bg-success mb-1">
                            {{ $ach }}
                        </span>
                    @empty
                        <p>No achievements yet</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    {{-- 4. FULL WIDTH MEDIA --}}
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Media Gallery
                </div>
                <div class="card-body">

                    <div class="row g-2">
                        @forelse($media ?? [] as $file)
                            <div class="col-md-3">
                                <img src="{{ $file }}" class="img-fluid rounded" />
                            </div>
                        @empty
                            <p>No media uploaded yet.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection