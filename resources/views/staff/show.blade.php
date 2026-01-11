@extends('layouts.app')

@section('hero')
    <x-hero gradient="cyan" :title="$staff->first_name . ' ' . $staff->last_name" subtitle="Staff Profile Details">
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <a href="{{ route('staff.edit', $staff) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-cyan-700 rounded-xl hover:bg-cyan-50 transition font-semibold shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Profile
            </a>
            <a href="{{ route('staff.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur text-white rounded-xl hover:bg-white/30 transition font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Staff
            </a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column - Profile Card -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden border border-slate-200 dark:border-slate-700">
            <!-- Profile Header -->
            <div class="relative h-32 bg-gradient-to-br from-cyan-500 via-blue-500 to-indigo-600">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                    <img
                        src="{{ $staff->photo_url }}"
                        alt="{{ $staff->first_name }} {{ $staff->last_name }}"
                        class="w-32 h-32 rounded-full object-cover ring-4 ring-white dark:ring-slate-800 shadow-2xl"
                        onerror="this.onerror=null; this.src='data:image/svg+xml;base64,{{ base64_encode('<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 128 128\'><rect width=\'128\' height=\'128\' fill=\'#6366f1\'/><text x=\'50%\' y=\'50%\' font-family=\'system-ui\' font-size=\'52\' font-weight=\'600\' fill=\'#fff\' text-anchor=\'middle\' dy=\'.35em\'>' . strtoupper(mb_substr($staff->first_name ?? 'S', 0, 1) . mb_substr($staff->last_name ?? 'T', 0, 1)) . '</text></svg>') }}';"
                    >
                </div>
            </div>

            <!-- Profile Info -->
            <div class="pt-20 pb-6 px-6 text-center">
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                    {{ $staff->first_name }} {{ $staff->last_name }}
                </h2>
                <p class="text-cyan-600 dark:text-cyan-400 font-semibold mt-1">{{ $staff->role_function ?? 'Staff Member' }}</p>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ $staff->discipline ?? 'General' }}</p>

                <!-- Status Badge -->
                <div class="mt-4">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-semibold {{ ($staff->status ?? 'active') === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                        <span class="w-2 h-2 rounded-full {{ ($staff->status ?? 'active') === 'active' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        {{ ucfirst($staff->status ?? 'Active') }}
                    </span>
                </div>

                <!-- Quick Contact -->
                <div class="mt-6 space-y-3">
                    @if($staff->email)
                    <a href="mailto:{{ $staff->email }}" class="flex items-center gap-3 px-4 py-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition group">
                        <span class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition">📧</span>
                        <span class="text-sm text-slate-700 dark:text-slate-300 truncate">{{ $staff->email }}</span>
                    </a>
                    @endif
                    @if($staff->phone_number)
                    <a href="tel:{{ $staff->phone_number }}" class="flex items-center gap-3 px-4 py-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl hover:bg-green-50 dark:hover:bg-green-900/20 transition group">
                        <span class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400 group-hover:scale-110 transition">📱</span>
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ $staff->phone_number }}</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-6 pb-6 space-y-2">
                <a href="{{ route('attendances.create', ['staff_id' => $staff->id]) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:from-green-600 hover:to-emerald-700 transition font-semibold shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Record Attendance
                </a>
                <form action="{{ route('staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff member?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-xl hover:bg-red-200 dark:hover:bg-red-900/50 transition font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete Staff
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column - Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Personal Information -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white shadow-lg">👤</span>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Personal Information</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">First Name</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->first_name ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Last Name</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->last_name ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Gender</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->gender ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date of Birth</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ optional($staff->dob)->format('M d, Y') ?? '-' }}</dd>
                </div>
            </div>
        </div>

        <!-- Work Information -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white shadow-lg">💼</span>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Work Information</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Branch</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->branch ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Discipline</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->discipline ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Role / Function</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->role_function ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Other Organizations</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->other_organizations ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                    <dt class="text-xs font-semibold text-green-600 dark:text-green-400 uppercase tracking-wider">Entry Date</dt>
                    <dd class="mt-1 text-lg font-medium text-green-700 dark:text-green-300">{{ optional($staff->date_entry)->format('M d, Y') ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-200 dark:border-amber-800">
                    <dt class="text-xs font-semibold text-amber-600 dark:text-amber-400 uppercase tracking-wider">Exit Date</dt>
                    <dd class="mt-1 text-lg font-medium text-amber-700 dark:text-amber-300">{{ optional($staff->date_exit)->format('M d, Y') ?? 'Still Active' }}</dd>
                </div>
            </div>
        </div>

        <!-- Qualifications -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white shadow-lg">🎓</span>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Qualifications & Certificates</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Academic Qualification</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->academic_qualification ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Major</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->major ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Professional Certificates</dt>
                    <dd class="mt-1 text-lg font-medium text-slate-900 dark:text-white">{{ $staff->professional_certificates ?? '-' }}</dd>
                </div>
            </div>
        </div>

        <!-- Uniform Sizes -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-red-600 flex items-center justify-center text-white shadow-lg">👕</span>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Uniform Sizes</h3>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl text-center">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">T-Shirt</dt>
                    <dd class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $staff->tshirt_size ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl text-center">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Short</dt>
                    <dd class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $staff->short_size ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl text-center">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Top Tracksuit</dt>
                    <dd class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $staff->top_tracksuit_size ?? '-' }}</dd>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl text-center">
                    <dt class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pant Tracksuit</dt>
                    <dd class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">{{ $staff->pant_tracksuit_size ?? '-' }}</dd>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
