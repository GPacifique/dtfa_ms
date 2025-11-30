@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Match</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Schedule a match and assign staff/players</p>
    </div>
    @include('admin.games._form')
</div>
@endsection
