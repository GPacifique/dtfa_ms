@extends('layouts.app')

@section('hero')
    <x-hero :title="'Edit: ' . ($student->first_name . ' ' . $student->second_name)" subtitle="Update student profile and details">
        <div class="mt-4">
            <a href="{{ route('coach.students.index') }}" class="btn-secondary">← Back to Students</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <form method="POST" action="{{ route('coach.students.update', $student) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('students._form', ['student' => $student, 'buttonText' => 'Update Student', 'cancelRoute' => route('coach.students.index')])
    </form>
</div>
@endsection
