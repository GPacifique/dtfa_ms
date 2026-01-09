@extends('layouts.app')

@push('hero')
    <x-hero title="Edit Training Session Record" subtitle="Update session details" gradient="emerald">
        <a href="{{ route('training_sessions.index') }}" class="inline-flex items-center px-3 py-1.5 border border-white/30 rounded-md text-sm text-white hover:bg-white/10">← Back</a>
    </x-hero>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('training_sessions.update', $record) }}" method="POST" class="space-y-6 bg-white dark:bg-slate-800 rounded-lg shadow p-6">
        @csrf
        @method('PUT')
        @include('staff.training_sessions._form')

        <div class="pt-4 flex gap-3">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md font-medium transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Update Record
            </button>
            <a href="{{ route('training_sessions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 font-medium transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
