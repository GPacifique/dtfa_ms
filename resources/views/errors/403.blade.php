@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-slate-50 dark:bg-slate-900">
        <div class="max-w-3xl w-full px-6 py-12 bg-white dark:bg-slate-800 shadow-md rounded-lg text-slate-700 dark:text-slate-200">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="rounded-full bg-rose-100 text-rose-600 p-4">
                        <!-- Shield/lock icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.656 0 3-1.344 3-3V6a3 3 0 00-6 0v2c0 1.656 1.344 3 3 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                    </div>
                </div>

                <div class="flex-1">
                    <h1 class="text-4xl font-extrabold text-slate-900 dark:text-slate-100">403 — Forbidden</h1>
                    <p class="mt-2 text-base text-slate-600 dark:text-slate-300">You don't have permission to access this resource.</p>

                    <div class="mt-6 grid gap-3 sm:flex sm:items-center">
                        <button onclick="history.back()" class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-slate-800 text-white hover:bg-slate-900 transition">
                            <!-- Back arrow -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0L3.586 10l4.707-4.707a1 1 0 011.414 1.414L6.414 10l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
                            Go back
                        </button>

                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-md border border-slate-200 bg-white text-slate-800 hover:bg-slate-50 transition">
                            Go to dashboard
                        </a>

                        <a href="mailto:{{ config('mail.from.address') }}" class="ml-auto text-sm text-slate-500 hover:underline">Contact support</a>
                    </div>

                    <div class="mt-6 text-sm text-slate-500 dark:text-slate-400">
                        <p>If you believe this is an error, contact an administrator or try the following:</p>
                        <ul class="mt-2 list-inside list-disc space-y-1">
                            <li>Ensure you're signed in with the correct account.</li>
                            <li>Request access from the resource owner.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
