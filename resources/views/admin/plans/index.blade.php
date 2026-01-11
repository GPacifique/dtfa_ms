@php($title = 'Subscription Plans')
@extends('layouts.app')

@section('content')
<div class="container-page space-y-6">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 rounded-2xl shadow-2xl">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-orange-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-cyan-400/30 to-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

        <div class="relative z-10 px-6 py-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">💳 Subscription Plans</h1>
                <p class="text-white/90 mt-1">Manage membership plans and pricing</p>
            </div>
            <x-button :href="route('admin.plans.create')" variant="primary" class="bg-white hover:bg-slate-50 text-fuchsia-700 shadow-lg">New Plan</x-button>
        </div>
    </div>

    <div class="card overflow-hidden">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Interval</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                    <tr>
                        <td class="px-4 py-3">{{ $plan->name }}</td>
                        <td class="px-4 py-3">{{ number_format($plan->price_cents) }} {{ $plan->currency }}</td>
                        <td class="px-4 py-3">{{ ucfirst($plan->interval) }}</td>
                        <td class="px-4 py-3">
                            @if($plan->active)
                                <x-badge color="green">Active</x-badge>
                            @else
                                <x-badge color="slate">Inactive</x-badge>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a class="text-indigo-700 hover:underline px-2" href="{{ route('admin.plans.edit', $plan) }}">Edit</a>
                            <form class="inline" method="POST" action="{{ route('admin.plans.destroy', $plan) }}" onsubmit="return confirm('Delete this plan?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-700 hover:underline px-2" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $plans->links() }}
    </div>
</div>
@endsection
