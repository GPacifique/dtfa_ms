@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Assign Roles To User</h1>

    @if(session('status'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.roles.assign') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold">Select User</label>
            <select name="user_id" required class="w-full border rounded px-3 py-2">
                <option value="">— Select user —</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Roles</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($roles as $r)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="roles[]" value="{{ $r->name }}" />
                        <span class="text-sm">{{ $r->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button class="px-6 py-2 bg-indigo-600 text-white rounded">Save</button>
        </div>
    </form>
</div>
@endsection
