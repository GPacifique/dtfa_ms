@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Activity Plan</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Define a new strategic activity plan for your organization</p>
    </div>

    @include('admin.activity-plans._form')
</div>
@endsection
