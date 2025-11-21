@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Add Student</h1>
    <form method="POST" action="{{ route('coach.students.store') }}" enctype="multipart/form-data">
        @include('students._form', ['student' => null, 'buttonText' => 'Save Student', 'cancelRoute' => route('coach.students.index')])
    </form>
</div>
@endsection
