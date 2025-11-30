@php($title = 'Add Sports Equipment')
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Add New Sports Equipment</h1>
                <p class="text-slate-600 mt-1">Add sports equipment to your inventory</p>
            </div>
            <a href="{{ route('admin.sports-equipment.index') }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                ← Back to List
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
            <form action="{{ route('admin.sports-equipment.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    @include('admin.sports-equipment._form', ['sports_equipment' => null])
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Create Equipment
                    </button>
                    <a href="{{ route('admin.sports-equipment.index') }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
