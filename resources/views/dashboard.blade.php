<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>

            <div class="py-8">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-neutral-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                            <div>
                                <h1 class="text-2xl font-bold text-slate-900 dark:text-gray-100">Welcome back!</h1>
                                <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">Your personalized dashboard</p>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded shadow">Edit Profile</a>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <x-stat-card title="My Attendance" value="0%" icon="✅" color="emerald" />
                            <x-stat-card title="Upcoming Sessions" value="0" icon="📅" color="blue" />
                            <x-stat-card title="Pending Fees" value="$0" icon="💳" color="amber" />
                        </div>

                        <div class="mt-6 bg-white dark:bg-neutral-800 rounded-lg shadow-md border border-slate-200 dark:border-neutral-700 p-6">
                            <h2 class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4">Upcoming Training Sessions</h2>
                            <div class="text-sm text-slate-600 dark:text-slate-300">No upcoming sessions scheduled.</div>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
