@extends('layouts.app')

@section('content')
@section('hide-back')@endsection
<div class="container mx-auto px-6 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Student</h1>
        <div class="flex gap-2">
            <x-button href="{{ route('students-modern.show', $student) }}" variant="secondary">View</x-button>
            <x-button href="{{ route('students-modern.index') }}" variant="secondary">List</x-button>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6">
        <form action="{{ route('students-modern.update', $student) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @include('students-modern._form', ['buttonText' => 'Update'])
        </form>
    </div>
</div>
@endsection
