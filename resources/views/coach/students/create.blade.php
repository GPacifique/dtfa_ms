@extends('layouts.app')

@section('hero')
    <x-hero title="Add Student" subtitle="Create a new student profile">
        <div class="mt-4">
            <a href="{{ route('coach.students.index') }}" class="btn-secondary">← Back to Students</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <form method="POST" action="{{ route('coach.students.store') }}" enctype="multipart/form-data">
        @include('students._form', ['student' => null, 'buttonText' => 'Save Student', 'cancelRoute' => route('coach.students.index')])
    </form>
</div>
@endsection
