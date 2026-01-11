@php($title = __('app.assign_subscription'))
@extends('layouts.app')

@section('content')
<div class="container-page">
    <div class="card">
        <div class="card-header"><h1 class="page-title">{{ __('app.assign_subscription') }}</h1></div>
        <div class="card-body">
            <form method="POST" action="{{ route('accountant.subscriptions.store') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-form.select :label="__('app.student')" name="student_id">
                        <option value="">—</option>
                        @foreach($students as $st)
                            <option value="{{ $st->id }}" @selected(old('student_id')==$st->id)>{{ $st->first_name }} {{ $st->second_name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.select :label="__('app.plan')" name="subscription_plan_id">
                        <option value="">—</option>
                        @foreach($plans as $p)
                            <option value="{{ $p->id }}" @selected(old('subscription_plan_id')==$p->id)>{{ $p->name }} — {{ number_format($p->price_cents) }} {{ $p->currency }} / {{ $p->interval }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.input :label="__('app.start_date')" name="start_date" type="date" />
                    <x-form.select :label="__('app.status')" name="status">
                        <option value="active" @selected(old('status','active')==='active')>{{ __('app.active') }}</option>
                        <option value="paused" @selected(old('status')==='paused')>{{ __('app.paused') }}</option>
                        <option value="cancelled" @selected(old('status')==='cancelled')>{{ __('app.cancelled') }}</option>
                        <option value="expired" @selected(old('status')==='expired')>{{ __('app.expired') }}</option>
                    </x-form.select>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <x-button :href="route('accountant.subscriptions.index')" variant="secondary">{{ __('app.cancel') }}</x-button>
                    <x-button type="submit" variant="primary">{{ __('app.create') }}</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
