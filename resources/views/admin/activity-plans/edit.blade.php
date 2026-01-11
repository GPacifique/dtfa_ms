@extends('layouts.app')

@section('hero')
    <x-hero title="Edit Activity Plan" subtitle="{{ $activityPlan->challenge }}">
        <a href="{{ route('admin.activity-plans.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Plans</a>
    </x-hero>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">


    @include('admin.activity-plans._form', ['activityPlan' => $activityPlan])
</div>
@endsection
