@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white dark:bg-neutral-900 p-8 rounded shadow space-y-6">
    <h1 class="text-3xl font-bold mb-4 text-indigo-700 dark:text-indigo-300 flex items-center gap-2">
        <span>🏠</span> User Dashboard
    </h1>
    <div class="text-slate-700 dark:text-slate-200 text-lg mb-4">
        Welcome, <span class="font-semibold">{{ Auth::user()->name ?? 'User' }}</span>!<br>
        This is your personalized dashboard. Here you can manage your profile, view students, and access other features.
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('students.index') }}" class="block p-6 bg-indigo-50 dark:bg-neutral-800 rounded-lg shadow hover:shadow-lg transition border border-indigo-100 dark:border-neutral-700">
            <div class="text-2xl mb-2">👥</div>
            <div class="font-bold text-lg mb-1">View Students</div>
            <div class="text-slate-600 dark:text-slate-400 text-sm">Browse, add, or edit student records.</div>
        </a>
        <a href="{{ route('profile.edit') }}" class="block p-6 bg-blue-50 dark:bg-neutral-800 rounded-lg shadow hover:shadow-lg transition border border-blue-100 dark:border-neutral-700">
            <div class="text-2xl mb-2">📝</div>
            <div class="font-bold text-lg mb-1">Edit Profile</div>
            <div class="text-slate-600 dark:text-slate-400 text-sm">Update your account information and password.</div>
        </a>
    </div>
</div>
@endsection@php($title = 'User Dashboard')
@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Welcome back!</h1>
            <p class="text-slate-600 mt-1">Your personalized dashboard</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-stat-card title="My Attendance" value="0%" icon="✅" color="emerald" />
            <x-stat-card title="Upcoming Sessions" value="0" icon="📅" color="blue" />
            <x-stat-card title="Pending Fees" value="$0" icon="💳" color="amber" />
        </div>

        <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Upcoming Training Sessions</h2>
            <div class="text-sm text-slate-600">No upcoming sessions scheduled.</div>
        </div>
    </div>
@endsection