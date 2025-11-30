@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Minutes</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Update meeting minutes and resolutions</p>
    </div>
    @include('admin.minutes._form', compact('minute'))
</div>
@endsection
