@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">New Communication</h1>

        <form action="{{ route('admin.communications.store') }}" method="POST">
            @csrf
            @include('admin.communications._form')

            <div class="mt-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Send</button>
                <a href="{{ route('admin.communications.index') }}" class="ml-2 text-sm">Back</a>
            </div>
        </form>
    </div>
@endsection
