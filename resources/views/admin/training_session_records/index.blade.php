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

    <!-- Status Filter Tabs -->
    <div class="flex gap-2 mb-6 border-b border-gray-200 dark:border-neutral-700">
        <a href="{{ route('admin.training_session_records.index') }}" class="px-4 py-2 border-b-2 {{ !request('status') ? 'border-emerald-600 text-emerald-600' : 'border-transparent text-gray-600 dark:text-gray-400' }} font-medium">All</a>
        <a href="{{ route('admin.training_session_records.index', ['status' => 'scheduled']) }}" class="px-4 py-2 border-b-2 {{ request('status') === 'scheduled' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 dark:text-gray-400' }} font-medium hover:border-blue-400">📅 Scheduled</a>
        <a href="{{ route('admin.training_session_records.index', ['status' => 'in_progress']) }}" class="px-4 py-2 border-b-2 {{ request('status') === 'in_progress' ? 'border-yellow-600 text-yellow-600' : 'border-transparent text-gray-600 dark:text-gray-400' }} font-medium hover:border-yellow-400">🏃 In Progress</a>
        <a href="{{ route('admin.training_session_records.index', ['status' => 'completed']) }}" class="px-4 py-2 border-b-2 {{ request('status') === 'completed' ? 'border-green-600 text-green-600' : 'border-transparent text-gray-600 dark:text-gray-400' }} font-medium hover:border-green-400">✅ Completed</a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="p-4 border-b">
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.attendees') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($records as $record)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($record->date)->format('Y-m-d') ?? $record->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->coach_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->training_pitch }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($record->status === 'scheduled')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">📅 Scheduled</span>
                            @elseif($record->status === 'in_progress')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">🏃 In Progress</span>
                            @elseif($record->status === 'completed')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">✅ Completed</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">📅 Scheduled</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->number_of_kids ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                            @if($record->status === 'scheduled' || !$record->status)
                                <!-- Scheduled: Can Edit/Prepare and Start -->
                                <a href="{{ route('admin.training_session_records.prepare', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 mr-1">
                                    📝 Prepare
                                </a>
                                <form action="{{ route('admin.training_session_records.start', $record) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-xs rounded-md hover:bg-yellow-600 mr-1">
                                        ▶️ Start
                                    </button>
                                </form>
                            @elseif($record->status === 'in_progress')
                                <!-- In Progress: Can Report and Complete -->
                                <a href="{{ route('admin.training_session_records.report', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white text-xs rounded-md hover:bg-emerald-700 mr-1">
                                    📊 Report
                                </a>
                                <form action="{{ route('admin.training_session_records.complete', $record) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-xs rounded-md hover:bg-green-700 mr-1">
                                        ✅ Complete
                                    </button>
                                </form>
                            @else
                                <!-- Completed: View Report, Edit Report -->
                                <a href="{{ route('admin.training_session_records.show', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-purple-600 text-white text-xs rounded-md hover:bg-purple-700 mr-1">
                                    👁️ View
                                </a>
                                <a href="{{ route('admin.training_session_records.report', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-600 text-white text-xs rounded-md hover:bg-yellow-700 mr-1">
                                    ✏️ Edit
                                </a>
                            @endif
                            <form action="{{ route('admin.training_session_records.destroy', $record) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 ml-1">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No records found.</td>
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
