@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Training Details</h2>

    <div class="card p-4">

        <p><strong>Name:</strong> {{ $training->training_name }}</p>
        <p><strong>First Name:</strong> {{ $training->first_name }}</p>
        <p><strong>Discipline:</strong> {{ $training->discipline }}</p>
        <p><strong>Country:</strong> {{ $training->country }}</p>
        <p><strong>Start:</strong> {{ $training->start }}</p>
        <p><strong>End:</strong> {{ $training->end }}</p>
        <p><strong>Branch:</strong> {{ $training->branch->name }}</p>

        <a href="{{ route('trainings.index') }}" class="btn btn-secondary mt-3">Back</a>

    </div>

</div>
@endsection
