@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Student</h1>
    <form method="POST" action="{{ route('coach.students.update', $student) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('students._form', ['student' => $student, 'buttonText' => 'Update Student', 'cancelRoute' => route('coach.students.index')])
    </form>
</div>
@endsection
