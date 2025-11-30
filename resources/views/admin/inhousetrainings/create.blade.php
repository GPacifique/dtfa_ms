@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Add Training</h2>

    <form action="{{ route('trainings.store') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Second Name</label>
                <input type="text" name="second_name" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Country</label>
                <select name="country" class="form-control">
                    <option>Rwanda</option>
                    <option>Tanzania</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>City</label>
                <select name="city" class="form-control">
                    <option>Kigali</option>
                    <option>Mwanza</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Discipline</label>
                <select name="discipline" class="form-control">
                    <option>Football</option>
                    <option>BasketBall</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Branch</label>
                <select name="branch_id" class="form-control">
                    @foreach ($branches as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Role</label>
                <select name="role_id" class="form-control">
                    @foreach ($roles as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Training Name</label>
                <input type="text" name="training_name" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Start</label>
                <input type="datetime-local" name="start" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>End</label>
                <input type="datetime-local" name="end" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Cost</label>
                <select name="cost" class="form-control">
                    <option>Paid</option>
                    <option>Free</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Training Category</label>
                <select name="training_category" class="form-control">
                    <option>In house</option>
                    <option>Outside DTFA</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Venue</label>
                <input type="text" name="venue" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Location</label>
                <input type="text" name="location" class="form-control">
            </div>

        </div>

        <button class="btn btn-success mt-3">Save Training</button>

    </form>
</div>
@endsection
