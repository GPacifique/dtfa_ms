@php $title = 'Create Admin'; @endphp
@extends('layouts.app')

@section('content')
    {{-- Reuse the admin.users.create form for admins --}}
    @include('admin.users.create')
@endsection
