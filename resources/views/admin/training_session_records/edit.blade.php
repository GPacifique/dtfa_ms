@extends('layouts.app')

@push('hero')
    <x-hero title="Edit Training Session Record" subtitle="Modify session details and attendance">
        <a href="{{ route('admin.training_session_records.index') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm">Back</a>
    </x-hero>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">


    <form action="{{ route('admin.training_session_records.update', $trainingSessionRecord) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.training_session_records._form')

        <div class="pt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Save Changes</button>
        </div>
    </form>
</div>
@endsection
