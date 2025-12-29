<?php $__env->startSection('content'); ?>
<?php $__env->startSection('hide-back'); ?><?php $__env->stopSection(); ?>
<div class="container mx-auto px-6 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Student Profile</h1>
        <div class="flex gap-2">
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('students-modern.create')).'','variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('students-modern.create')).'','variant' => 'primary']); ?>+ New Student <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('students-modern.edit', $student)).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('students-modern.edit', $student)).'','variant' => 'secondary']); ?>Edit <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('students-modern.index')).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('students-modern.index')).'','variant' => 'secondary']); ?>Back to List <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
        </div>
    </div>

    <?php if(session('status')): ?>
        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'success','class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success','class' => 'mb-4']); ?><?php echo e(session('status')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
    <?php endif; ?>

    <?php if(session('attendance_success')): ?>
        <div class="mb-4 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg">
            <p class="text-emerald-800 dark:text-emerald-300 font-semibold">✅ <?php echo e(session('attendance_success')); ?></p>
        </div>
    <?php endif; ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-slate-100 to-slate-50 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <nav class="text-sm text-slate-600 dark:text-slate-300 flex items-center gap-2">
                <a href="<?php echo e(route('admin.students.index')); ?>" class="hover:text-indigo-600 dark:hover:text-indigo-400">Students</a>
                <span aria-hidden="true">/</span>
                <span class="font-medium text-slate-900 dark:text-white"><?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?></span>
            </nav>
            <div class="flex items-center gap-2">
                <a href="<?php echo e(route('admin.students.edit', $student)); ?>" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 text-white px-4 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-6 4h10M7 13h10M9 17h6"/></svg>
                    Edit
                </a>
                <a href="<?php echo e(route('admin.students.index')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 text-slate-800 px-4 py-2 text-sm font-semibold shadow-sm hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2 transition dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 12l6-6m-6 6l6 6"/></svg>
                    Back
                </a>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 mb-8">
            <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-r from-indigo-600 via-cyan-500 to-indigo-500 opacity-20 pointer-events-none"></div>
            <div class="relative p-6 md:p-8">
                <div class="flex items-start gap-6">
                    <img alt="Profile photo" src="<?php echo e($student->photo_url); ?>" class="w-20 h-20 rounded-xl object-cover ring-4 ring-white dark:ring-slate-800 shadow-md" />
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3">
                            <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-900 dark:text-white"><?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?></h1>
                            <span class="inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200 px-3 py-1 text-xs font-semibold"><?php echo e(ucfirst($student->status ?? 'active')); ?></span>
                        </div>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300"><?php echo e($student->sport_discipline ?? 'Sport Discipline'); ?> · <?php echo e($student->position ?? 'Position'); ?> · Jersey: <?php echo e($student->jersey_number ?? '—'); ?></p>
                        <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-4 shadow-sm"><p class="text-xs text-slate-500 dark:text-slate-400">Age</p><p class="mt-1 text-lg font-semibold text-slate-900 dark:text-white"><?php echo e($student->age ?? '—'); ?></p></div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-4 shadow-sm"><p class="text-xs text-slate-500">Branch</p><p class="mt-1 text-lg font-semibold"><?php echo e(optional($student->branch)->name ?? '—'); ?></p></div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-4 shadow-sm"><p class="text-xs text-slate-500">Group</p><p class="mt-1 text-lg font-semibold"><?php echo e(optional($student->group)->name ?? '—'); ?></p></div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-4 shadow-sm"><p class="text-xs text-slate-500">Joined</p><p class="mt-1 text-lg font-semibold"><?php echo e(optional($student->joined_at)->format('M d, Y') ?? '—'); ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 space-y-6">
                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Contacts</h2>
                        <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">Primary and guardian contacts</p>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between"><span class="text-sm text-slate-600 dark:text-slate-300">Player Email</span><a href="mailto:<?php echo e($student->player_email); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-500"><?php echo e($student->player_email ?? '—'); ?></a></div>
                            <div class="flex items-center justify-between"><span class="text-sm text-slate-600 dark:text-slate-300">Parent Email</span><a href="mailto:<?php echo e($student->parent_email); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-500"><?php echo e($student->parent_email ?? '—'); ?></a></div>
                            <div class="flex items-center justify-between"><span class="text-sm text-slate-600 dark:text-slate-300">Player Phone</span><a href="tel:<?php echo e($student->player_phone); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-500"><?php echo e($student->player_phone ?? '—'); ?></a></div>
                            <div class="flex items-center justify-between"><span class="text-sm text-slate-600 dark:text-slate-300">Emergency Phone</span><a href="tel:<?php echo e($student->emergency_phone); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-500"><?php echo e($student->emergency_phone ?? '—'); ?></a></div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700">
                        <div class="flex items-center gap-2">
                            <button type="button" class="inline-flex items-center gap-2 rounded-lg bg-cyan-600 text-white px-3 py-2 text-xs font-semibold shadow-sm hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8a6 6 0 11-12 0"/></svg>Send Message</button>
                            <button type="button" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 text-slate-800 px-3 py-2 text-xs font-semibold shadow-sm hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2 transition dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Add Note</button>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6 space-y-3">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Program & School</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div><p class="text-xs text-slate-500">Program</p><p class="mt-1 text-sm font-medium"><?php echo e($student->program ?? '—'); ?></p></div>
                            <div><p class="text-xs text-slate-500">School</p><p class="mt-1 text-sm font-medium"><?php echo e($student->school_name ?? '—'); ?></p></div>
                            <div><p class="text-xs text-slate-500">Coach</p><p class="mt-1 text-sm font-medium"><?php echo e($student->coach ?? '—'); ?></p></div>
                            <div><p class="text-xs text-slate-500">Training Days</p><p class="mt-1 text-sm font-medium"><?php if(is_array($student->training_days)): ?><?php echo e(implode(', ', $student->training_days)); ?><?php else: ?><?php echo e($student->training_days ?? '—'); ?><?php endif; ?></p></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between"><h2 class="text-lg font-semibold text-slate-900 dark:text-white">Subscriptions</h2><a href="<?php echo e(route('accountant.subscriptions.index')); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a></div>
                        <div class="mt-4 overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-700">
                            <table class="min-w-full text-sm">
                                <thead class="bg-slate-50 dark:bg-slate-900 sticky top-0"><tr class="text-left text-slate-600 dark:text-slate-300"><th class="px-4 py-3">Plan</th><th class="px-4 py-3">Start</th><th class="px-4 py-3">End</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Actions</th></tr></thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    <?php $__empty_1 = true; $__currentLoopData = $student->subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-900/40 transition">
                                            <td class="px-4 py-3 text-slate-900 dark:text-white"><?php echo e(optional($sub->plan)->name ?? '—'); ?></td>
                                            <td class="px-4 py-3"><?php echo e(optional($sub->start_date)->format('M d, Y') ?? $sub->start_date); ?></td>
                                            <td class="px-4 py-3"><?php echo e(optional($sub->end_date)->format('M d, Y') ?? ($sub->end_date ?: '—')); ?></td>
                                            <td class="px-4 py-3"><span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?php if($sub->status === 'active'): ?> bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200 <?php elseif($sub->status === 'expired'): ?> bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200 <?php elseif($sub->status === 'paused'): ?> bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-200 <?php else: ?> bg-rose-100 text-rose-700 dark:bg-rose-900 dark:text-rose-200 <?php endif; ?>"><?php echo e(ucfirst($sub->status)); ?></span></td>
                                            <td class="px-4 py-3 text-right"><a href="<?php echo e(route('accountant.subscriptions.show', $sub)); ?>" class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Details</a></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">No subscriptions found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between"><h2 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Payments</h2><a href="<?php echo e(route('accountant.payments.index')); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a></div>
                        <div class="mt-4 overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-700">
                            <table class="min-w-full text-sm">
                                <thead class="bg-slate-50 dark:bg-slate-900 sticky top-0"><tr class="text-left text-slate-600 dark:text-slate-300"><th class="px-4 py-3">Amount</th><th class="px-4 py-3">Method</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Paid At</th><th class="px-4 py-3 text-right">Action</th></tr></thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    <?php $__empty_1 = true; $__currentLoopData = $student->payments()->latest('paid_at')->limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-900/40 transition">
                                            <td class="px-4 py-3 font-semibold text-slate-900 dark:text-white"><?php echo e(number_format((int) $pay->amount_cents)); ?> RWF</td>
                                            <td class="px-4 py-3"><?php echo e(ucfirst(str_replace('_',' ', $pay->method))); ?></td>
                                            <td class="px-4 py-3"><span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?php if($pay->status === 'succeeded'): ?> bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200 <?php elseif($pay->status === 'pending'): ?> bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-200 <?php else: ?> bg-rose-100 text-rose-700 dark:bg-rose-900 dark:text-rose-200 <?php endif; ?>"><?php echo e(ucfirst($pay->status)); ?></span></td>
                                            <td class="px-4 py-3"><?php echo e(optional($pay->paid_at)->format('M d, Y H:i') ?? '—'); ?></td>
                                            <td class="px-4 py-3 text-right"><a href="<?php echo e(route('accountant.payments.show', $pay)); ?>" class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9"/></svg>Details</a></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">No payments found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between"><h2 class="text-lg font-semibold text-slate-900 dark:text-white">Attendance Timeline</h2><a href="<?php echo e(route('admin.student-attendance.index')); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a></div>
                        <div class="mt-4 space-y-4">
                            <?php $__empty_1 = true; $__currentLoopData = $student->attendances()->latest()->limit(8)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="flex items-start gap-3"><span class="mt-1 w-2 h-2 rounded-full <?php if($att->status === 'present'): ?> bg-emerald-500 <?php elseif($att->status === 'absent'): ?> bg-rose-500 <?php else: ?> bg-amber-500 <?php endif; ?>"></span><div class="flex-1"><p class="text-sm text-slate-900 dark:text-white font-medium capitalize"><?php echo e($att->status); ?></p><p class="text-xs text-slate-600 dark:text-slate-300"><?php echo e(optional($att->created_at)->format('M d, Y H:i')); ?> · Session #<?php echo e($att->training_session_id); ?></p></div></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-sm text-slate-500">No attendance records found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/students-modern/show.blade.php ENDPATH**/ ?>