@extends('layouts.app')

@section('hero')
    <x-hero title="{{ __('app.training_records') }}" subtitle="{{ __('app.filter_and_review') }}" gradient="emerald">
        <div class="mt-4">
            <a href="{{ route('admin.training_session_records.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-emerald-700 font-semibold rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('app.new_record') }}
            </a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="p-4 border-b">
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs text-gray-500">{{ __('app.branch') }}</label>
                    <select name="branch" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm">
                        <option value="">{{ __('app.all') }}</option>
                        @if(!empty($branches))
                            @foreach($branches as $b)
                                <option value="{{ $b }}" {{ request('branch') === $b ? 'selected' : '' }}>{{ $b }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">{{ __('app.pitch') }}</label>
                    <select name="training_pitch" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm">
                        <option value="">{{ __('app.all') }}</option>
                        @if(!empty($pitches))
                            @foreach($pitches as $p)
                                <option value="{{ $p }}" {{ request('training_pitch') === $p ? 'selected' : '' }}>{{ $p }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">{{ __('app.coach') }}</label>
                    <select name="coach_id" class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm">
                        <option value="">{{ __('app.all') }}</option>
                        @if(!empty($coaches))
                            @foreach($coaches as $c)
                                <option value="{{ $c->id }}" {{ request('coach_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">{{ __('app.date') }}</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm" />
                </div>

                <div class="ml-2">
                    <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white rounded-md text-sm">{{ __('app.filter') }}</button>
                    <a href="{{ route('admin.training_session_records.index') }}" class="ml-2 px-3 py-1.5 border rounded-md text-sm">{{ __('app.reset') }}</a>
                </div>
            </form>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.date') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.coach') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.pitch') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.attendees') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($records as $record)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($record->date)->format('Y-m-d') ?? $record->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->coach_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->training_pitch }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->number_of_kids }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                            @if(!$record->number_of_kids && !$record->incident_report && !$record->comments)
                                <!-- Not yet reported: show Prepare and Report buttons -->
                                <a href="{{ route('admin.training_session_records.prepare', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 mr-2">
                                    📝 {{ __('app.prepare') }}
                                </a>
                                <a href="{{ route('admin.training_session_records.report', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white text-xs rounded-md hover:bg-emerald-700 mr-2">
                                    📊 {{ __('app.report') }}
                                </a>
                            @else
                                <!-- Already reported: show View Report and Edit buttons -->
                                <a href="{{ route('admin.training_session_records.show', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-purple-600 text-white text-xs rounded-md hover:bg-purple-700 mr-2">
                                    👁️ {{ __('app.view_report') }}
                                </a>
                                <a href="{{ route('admin.training_session_records.edit', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-600 text-white text-xs rounded-md hover:bg-yellow-700 mr-2">
                                    ✏️ {{ __('app.edit') }}
                                </a>
                            @endif
                            <form action="{{ route('admin.training_session_records.destroy', $record) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 ml-2">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $records->links() }}
    </div>
</div>
@endsection
