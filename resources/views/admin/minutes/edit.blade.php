@extends('layouts.app')

@section('hero')
    <x-hero title="Edit Minutes" subtitle="Update meeting minutes and resolutions">
        <a href="{{ route('admin.minutes.show', $minute) }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg mr-2">View</a>
        <a href="{{ route('admin.minutes.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Minutes</a>
    </x-hero>
@endsection

@section('content')
<div class="max-w-4xl mx-auto p-6">

    @include('admin.minutes._form', compact('minute'))
</div>
@endsection
