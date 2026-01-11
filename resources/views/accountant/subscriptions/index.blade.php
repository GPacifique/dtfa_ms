@php($title = __('app.subscriptions'))
@extends('layouts.app')

@section('content')
<div class="container-page space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="page-title">{{ __('app.subscriptions') }}</h1>
        <x-button :href="route('accountant.subscriptions.create')" variant="primary">{{ __('app.assign_subscription') }}</x-button>
    </div>
    <div class="card overflow-hidden">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('app.student') }}</th>
                    <th>{{ __('app.plan') }}</th>
                    <th>{{ __('app.status') }}</th>
                    <th>{{ __('app.start') }}</th>
                    <th>{{ __('app.next_billing') }}</th>
                    <th class="text-right">{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subs as $s)
                    <tr>
                        <td class="px-4 py-3">{{ $s->student->first_name }} {{ $s->student->second_name }}</td>
                        <td class="px-4 py-3">{{ $s->plan->name }}</td>
                        <td class="px-4 py-3">
                            <x-badge color="{{ $s->status === 'active' ? 'green' : 'slate' }}">{{ ucfirst($s->status) }}</x-badge>
                        </td>
                        <td class="px-4 py-3">{{ optional($s->start_date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-3">{{ optional($s->next_billing_date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-3 text-right">
                            <a class="text-indigo-700 hover:underline px-2" href="{{ route('accountant.subscriptions.edit', $s) }}">{{ __('app.edit') }}</a>
                            <form class="inline" method="POST" action="{{ route('accountant.subscriptions.destroy', $s) }}" onsubmit="return confirm('{{ __('app.confirm_delete') }}');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-700 hover:underline px-2" type="submit">{{ __('app.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $subs->links() }}</div>
</div>
@endsection
