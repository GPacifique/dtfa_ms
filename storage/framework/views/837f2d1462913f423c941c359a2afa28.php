<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['gradient' => 'cyan','title' => 'Staff Directory','subtitle' => 'Manage and review all staff profiles']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['gradient' => 'cyan','title' => 'Staff Directory','subtitle' => 'Manage and review all staff profiles']); ?>
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <a href="<?php echo e(route('staff.create')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-cyan-700 rounded-xl hover:bg-cyan-50 transition font-semibold shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Add New Staff
            </a>
            <span class="px-4 py-2 bg-white/20 backdrop-blur rounded-xl text-white font-medium">
                👥 Total: <?php echo e($staff->total() ?? count($staff)); ?> Staff Members
            </span>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $attributes = $__attributesOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__attributesOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $component = $__componentOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__componentOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Search & Filter Section -->
<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 mb-8 border border-slate-200 dark:border-slate-700">
    <form method="get" class="flex flex-col lg:flex-row gap-4 items-end">
        <div class="flex-1 w-full">
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">🔍 Search Staff</label>
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search by name, email, phone, or role..."
                class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition">
        </div>
        <div class="w-full lg:w-48">
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">🏢 Branch</label>
            <select name="branch" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition">
                <option value="">All Branches</option>
                <?php $__currentLoopData = $staff->pluck('branch')->unique()->filter(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($branch); ?>" <?php echo e(request('branch') === $branch ? 'selected' : ''); ?>><?php echo e($branch); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="w-full lg:w-48">
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">⚽ Discipline</label>
            <select name="discipline" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition">
                <option value="">All Disciplines</option>
                <?php $__currentLoopData = $staff->pluck('discipline')->unique()->filter(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discipline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($discipline); ?>" <?php echo e(request('discipline') === $discipline ? 'selected' : ''); ?>><?php echo e($discipline); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="flex gap-2 w-full lg:w-auto">
            <button type="submit" class="flex-1 lg:flex-none px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl hover:from-cyan-600 hover:to-blue-700 transition font-semibold shadow-lg">
                Search
            </button>
            <a href="<?php echo e(route('staff.index')); ?>" class="flex-1 lg:flex-none px-6 py-3 border-2 border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition font-semibold text-center">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Staff Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-slate-200 dark:border-slate-700 hover:border-cyan-300 dark:hover:border-cyan-600 hover:-translate-y-1">
            <!-- Card Header with Photo -->
            <div class="relative h-32 bg-gradient-to-br from-cyan-500 via-blue-500 to-indigo-600">
                <div class="absolute inset-0 bg-black/10"></div>
                <!-- Role Badge -->
                <div class="absolute top-3 right-3">
                    <span class="px-3 py-1 bg-white/90 backdrop-blur text-xs font-bold text-cyan-700 rounded-full shadow">
                        <?php echo e($s->role_function ?? 'Staff'); ?>

                    </span>
                </div>
                <!-- Photo -->
                <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                    <img
                        src="<?php echo e($s->photo_url); ?>"
                        alt="<?php echo e($s->first_name); ?> <?php echo e($s->last_name); ?>"
                        class="w-24 h-24 rounded-full object-cover ring-4 ring-white dark:ring-slate-800 shadow-xl"
                        onerror="this.onerror=null; this.src='data:image/svg+xml;base64,<?php echo e(base64_encode('<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 128 128\'><rect width=\'128\' height=\'128\' fill=\'#6366f1\'/><text x=\'50%\' y=\'50%\' font-family=\'system-ui\' font-size=\'52\' font-weight=\'600\' fill=\'#fff\' text-anchor=\'middle\' dy=\'.35em\'>' . strtoupper(mb_substr($s->first_name ?? 'S', 0, 1) . mb_substr($s->last_name ?? 'T', 0, 1)) . '</text></svg>')); ?>';"
                    >
                </div>
            </div>

            <!-- Card Body -->
            <div class="pt-14 pb-4 px-4 text-center">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white truncate">
                    <?php echo e($s->first_name); ?> <?php echo e($s->last_name); ?>

                </h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1"><?php echo e($s->discipline ?? 'General'); ?></p>

                <!-- Info Grid -->
                <div class="mt-4 space-y-2 text-left">
                    <?php if($s->branch): ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="w-6 h-6 rounded-full bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center text-cyan-600 dark:text-cyan-400">🏢</span>
                        <span class="text-slate-600 dark:text-slate-400 truncate"><?php echo e($s->branch); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($s->email): ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">📧</span>
                        <span class="text-slate-600 dark:text-slate-400 truncate"><?php echo e($s->email); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($s->phone_number): ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">📱</span>
                        <span class="text-slate-600 dark:text-slate-400"><?php echo e($s->phone_number); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($s->date_entry): ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">📅</span>
                        <span class="text-slate-600 dark:text-slate-400">Joined: <?php echo e($s->date_entry->format('M d, Y')); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card Footer Actions -->
            <div class="px-4 pb-4 pt-2 border-t border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between gap-2">
                    <a href="<?php echo e(route('staff.show', $s)); ?>" class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-cyan-100 dark:hover:bg-cyan-900/30 hover:text-cyan-700 dark:hover:text-cyan-400 transition text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        View
                    </a>
                    <a href="<?php echo e(route('staff.edit', $s)); ?>" class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <a href="<?php echo e(route('attendances.create', ['staff_id' => $s->id])); ?>" class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition text-sm font-medium" title="Record attendance">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Attend
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full">
            <div class="text-center py-16 bg-white dark:bg-slate-800 rounded-2xl border-2 border-dashed border-slate-300 dark:border-slate-600">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-300">No Staff Found</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Get started by adding your first staff member.</p>
                <a href="<?php echo e(route('staff.create')); ?>" class="inline-flex items-center gap-2 mt-4 px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl hover:from-cyan-600 hover:to-blue-700 transition font-semibold shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Add First Staff Member
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Pagination -->
<?php if($staff->hasPages()): ?>
<div class="mt-8 flex justify-center">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg px-4 py-3 border border-slate-200 dark:border-slate-700">
        <?php echo e($staff->withQueryString()->links()); ?>

    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/staff/index.blade.php ENDPATH**/ ?>