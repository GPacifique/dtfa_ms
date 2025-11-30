@php($title = 'Edit Sports Equipment')
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Edit Sports Equipment</h1>
                <p class="text-slate-600 mt-1">{{ $sports_equipment->name }}</p>
            </div>
            <a href="{{ route('admin.sports-equipment.index') }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                ← Back to List
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
            <form action="{{ route('admin.sports-equipment.update', $sports_equipment) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    @include('admin.sports-equipment._form', ['sports_equipment' => $sports_equipment])
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Update Equipment
                    </button>
                    <a href="{{ route('admin.sports-equipment.show', $sports_equipment) }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
