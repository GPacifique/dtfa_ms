@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Create Task</h2>

    <form action="{{ route('admin.tasks.store') }}" method="POST">
        @csrf

        <!-- Staff -->
        <div class="mb-4">
            <label class="font-semibold">Name of Staff</label>
            <select name="staff_id" class="form-select w-full" required>
                <option value="">Select Staff</option>
                @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->first_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Goal -->
        <div class="mb-4">
            <label class="font-semibold">Goal</label>
            <input type="text" name="goal" class="form-input w-full">
        </div>

        <!-- Objective -->
        <div class="mb-4">
            <label class="font-semibold">Objective</label>
            <input type="text" name="objective" class="form-input w-full">
        </div>

        <!-- Activities -->
        <div class="mb-4">
            <label class="font-semibold">Activities</label>
            <textarea name="activities" rows="3" class="form-textarea w-full"></textarea>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Starting Date</label>
                <input type="date" name="start_date" class="form-input w-full">
            </div>

            <div>
                <label class="font-semibold">Ending Date</label>
                <input type="date" name="end_date" class="form-input w-full">
            </div>
        </div>

        <!-- Reporting -->
        <div class="mt-4">
            <label class="font-semibold">Reporting</label>
            <textarea name="reporting" rows="2" class="form-textarea w-full"></textarea>
        </div>

        <!-- Message -->
        <div class="mt-4">
            <label class="font-semibold">Message</label>
            <textarea name="message" rows="2" class="form-textarea w-full"></textarea>
        </div>

        <div class="mt-6">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Save Task</button>
        </div>

    </form>
</div>
@endsection
