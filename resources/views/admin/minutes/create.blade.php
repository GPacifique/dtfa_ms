@extends('layouts.app')

@section('hero')
    <x-hero title="Create New Minutes" subtitle="Record meeting minutes with agenda, attendance, and resolutions">
        <a href="{{ route('admin.minutes.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Minutes</a>
    </x-hero>
@endsection

@section('content')
<div class="max-w-4xl mx-auto p-6">

    @include('admin.minutes._form')
</div>
@endsection
