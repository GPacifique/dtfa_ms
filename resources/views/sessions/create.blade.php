@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Training Session</h1>
    <form action="{{ route('sessions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Session Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="group_id">Group</label>
            <select name="group_id" id="group_id" class="form-control" required>
                <option value="">Select Group</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Create Session</button>
        <a href="{{ route('sessions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
