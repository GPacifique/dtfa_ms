<?php $__env->startSection('title', 'Player Attendance Records'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-violet-50 via-pink-50 to-cyan-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    
    <div class="relative overflow-hidden bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 rounded-2xl shadow-2xl mx-4 sm:mx-6 mt-4">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-orange-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-cyan-400/30 to-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow-lg">📋 Player Attendance Records</h1>
            <p class="text-white/90 text-lg">Comprehensive player attendance tracking and management</p>
        </div>
    </div>

    <div class="container mx-auto px-6 mt-6 pb-12">

        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
            <a href="<?php echo e(route('admin.student-attendance.index')); ?>" class="card group hover:shadow-lg transition">
                <div class="card-body p-4 text-center">
                    <div class="text-xs text-slate-500">Total</div>
                    <div class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($totalCount ?? 0); ?></div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.student-attendance.index', array_merge(request()->except('page'), ['status' => 'present']))); ?>" class="card group hover:shadow-lg transition">
                <div class="card-body p-4 text-center">
                    <div class="text-xs text-slate-500">Present</div>
                    <div class="text-2xl font-bold text-emerald-600"><?php echo e($presentCount ?? 0); ?></div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.student-attendance.index', array_merge(request()->except('page'), ['status' => 'absent']))); ?>" class="card group hover:shadow-lg transition">
                <div class="card-body p-4 text-center">
                    <div class="text-xs text-slate-500">Absent</div>
                    <div class="text-2xl font-bold text-rose-600"><?php echo e($absentCount ?? 0); ?></div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.student-attendance.index', array_merge(request()->except('page'), ['status' => 'late']))); ?>" class="card group hover:shadow-lg transition">
                <div class="card-body p-4 text-center">
                    <div class="text-xs text-slate-500">Late</div>
                    <div class="text-2xl font-bold text-amber-600"><?php echo e($lateCount ?? 0); ?></div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.student-attendance.index', array_merge(request()->except('page'), ['status' => 'excused']))); ?>" class="card group hover:shadow-lg transition">
                <div class="card-body p-4 text-center">
                    <div class="text-xs text-slate-500">Excused</div>
                    <div class="text-2xl font-bold text-indigo-600"><?php echo e($excusedCount ?? 0); ?></div>
                </div>
            </a>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <a href="<?php echo e(route('admin.student-attendance.create')); ?>" class="card hover:shadow-xl transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <div class="text-3xl mb-2">➕</div>
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Add Record</div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.student-attendance.bulk.create')); ?>" class="card hover:shadow-xl transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <div class="text-3xl mb-2">📝</div>
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Bulk Entry</div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.student-attendance.report')); ?>" class="card hover:shadow-xl transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <div class="text-3xl mb-2">📊</div>
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Reports</div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="card hover:shadow-xl transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <div class="text-3xl mb-2">🏠</div>
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Dashboard</div>
                </div>
            </a>
        </div>

        
        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('admin.student-attendance.index')); ?>" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Player</label>
                            <select name="student_id" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                                <option value="">All Players</option>
                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($student->id); ?>" <?php if(request('student_id') == $student->id): echo 'selected'; endif; ?>>
                                        <?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?> <?php echo e($student->last_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                            <select name="status" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                                <option value="">All Statuses</option>
                                <option value="present" <?php if(request('status') == 'present'): echo 'selected'; endif; ?>>Present</option>
                                <option value="absent" <?php if(request('status') == 'absent'): echo 'selected'; endif; ?>>Absent</option>
                                <option value="late" <?php if(request('status') == 'late'): echo 'selected'; endif; ?>>Late</option>
                                <option value="excused" <?php if(request('status') == 'excused'): echo 'selected'; endif; ?>>Excused</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Branch</label>
                            <select name="branch" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                                <option value="">All Branches</option>
                                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($branch); ?>" <?php if(request('branch') == $branch): echo 'selected'; endif; ?>><?php echo e($branch); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Discipline</label>
                            <select name="discipline" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                                <option value="">All Disciplines</option>
                                <?php $__currentLoopData = $disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discipline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($discipline); ?>" <?php if(request('discipline') == $discipline): echo 'selected'; endif; ?>><?php echo e($discipline); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Date From</label>
                            <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Date To</label>
                            <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                            🔍 Filter
                        </button>
                        <a href="<?php echo e(route('admin.student-attendance.index')); ?>" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition font-semibold">
                            Clear
                        </a>
                        <a href="<?php echo e(request()->fullUrlWithQuery(['export' => 'csv'])); ?>" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
                            ⬇️ Export CSV
                        </a>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="card">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-700 dark:text-slate-300 uppercase bg-slate-50 dark:bg-neutral-800">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Player</th>
                                <th class="px-4 py-3">Session Date</th>
                                <th class="px-4 py-3">Session Time</th>
                                <th class="px-4 py-3">Branch/Group</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Notes</th>
                                <th class="px-4 py-3">Recorded By</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-b dark:border-neutral-700 hover:bg-slate-50 dark:hover:bg-neutral-800">
                                    <td class="px-4 py-3"><?php echo e($attendance->id); ?></td>
                                    <td class="px-4 py-3">
                                        <a href="<?php echo e(route('students-modern.show', $attendance->student)); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                            <?php echo e($attendance->student->first_name); ?> <?php echo e($attendance->student->second_name); ?>

                                        </a>
                                    </td>
                                    <td class="px-4 py-3"><?php echo e(optional($attendance->session)->date?->format('M d, Y') ?? 'N/A'); ?></td>
                                    <td class="px-4 py-3">
                                        <?php echo e(optional($attendance->session)->start_time); ?> - <?php echo e(optional($attendance->session)->end_time); ?>

                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-xs">
                                            <div>🏢 <?php echo e(optional($attendance->session->branch)->name ?? 'N/A'); ?></div>
                                            <div>👥 <?php echo e(optional($attendance->session->group)->name ?? 'N/A'); ?></div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <?php if($attendance->status == 'present'): ?>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded">✓ Present</span>
                                        <?php elseif($attendance->status == 'absent'): ?>
                                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded">✗ Absent</span>
                                        <?php elseif($attendance->status == 'late'): ?>
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded">⏰ Late</span>
                                        <?php elseif($attendance->status == 'excused'): ?>
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded">📝 Excused</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3"><?php echo e(Str::limit($attendance->notes ?? '', 30)); ?></td>
                                    <td class="px-4 py-3 text-xs"><?php echo e(optional($attendance->recordedBy)->name ?? 'N/A'); ?></td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="<?php echo e(route('admin.student-attendance.show', $attendance)); ?>" class="text-blue-600 hover:text-blue-800" title="View">
                                                👁️
                                            </a>
                                            <a href="<?php echo e(route('admin.student-attendance.edit', $attendance)); ?>" class="text-indigo-600 hover:text-indigo-800" title="Edit">
                                                ✏️
                                            </a>
                                            <form method="POST" action="<?php echo e(route('admin.student-attendance.destroy', $attendance)); ?>" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="px-4 py-8 text-center text-slate-500">
                                        No attendance records found. <a href="<?php echo e(route('admin.student-attendance.create')); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold">Add one now</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($attendances->hasPages()): ?>
                    <div class="mt-6">
                        <?php echo e($attendances->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\student-attendance\index.blade.php ENDPATH**/ ?>