@extends('layouts.app')

@section('content')
<h1>{{ isset($game) ? 'Edit Match' : 'Create Match' }}</h1>
@include('admin.games._form')
@endsection
