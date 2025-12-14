@php($title = 'Edit Office Equipment')
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Edit Office Equipment</h1>
                <p class="text-slate-600 mt-1">{{ $office_equipment->name }}</p>
            </div>
            <a href="{{ route('admin.office-equipment.index') }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                ← Back to List
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
            <form action="{{ route('admin.office-equipment.update', $office_equipment) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    @include('admin.office-equipment._form', ['office_equipment' => $office_equipment])
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        ✅Save
                    </button>
                    <a href="{{ route('admin.office-equipment.show', $office_equipment) }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
