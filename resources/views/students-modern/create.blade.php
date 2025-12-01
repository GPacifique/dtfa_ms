@extends('layouts.app')

@section('content')
@section('hide-back')@endsection
<div class="container mx-auto px-6 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">New Student</h1>
        <x-button href="{{ route('students-modern.index') }}" variant="secondary">Back to List</x-button>
    </div>
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6">
        <form action="{{ route('students-modern.store') }}" method="post" enctype="multipart/form-data">
            @include('students-modern._form', ['buttonText' => 'Create'])
        </form>
    </div>
</div>
@endsection
