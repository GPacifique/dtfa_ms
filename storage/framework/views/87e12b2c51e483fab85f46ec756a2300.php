<?php $title = 'Welcome to Our Academy'; ?>


<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-white to-emerald-50">
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-xl shadow p-8">
            <h1 class="text-3xl font-bold mb-2">Welcome</h1>
            <p class="text-slate-600 mb-6">Discover our branches and upcoming training sessions. Contact us to enroll.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-emerald-50 rounded-lg">
                    <p class="text-sm text-slate-500">Branches</p>
                    <div class="text-2xl font-bold mt-1"><?php echo e($branchesCount ?? 0); ?></div>
                </div>

                <div class="md:col-span-2 p-4 bg-white rounded-lg">
                    <p class="text-sm text-slate-500">Upcoming Sessions</p>
                    <?php if(($upcomingSessions ?? collect())->isEmpty()): ?>
                        <div class="text-slate-500 mt-2">No upcoming sessions scheduled. Check back later.</div>
                    <?php else: ?>
                        <ul class="mt-3 space-y-3">
                            <?php $__currentLoopData = $upcomingSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="border rounded p-3">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-semibold"><?php echo e($s->date->format('M d, Y')); ?> • <?php echo e($s->start_time); ?>–<?php echo e($s->end_time); ?></div>
                                            <div class="text-sm text-slate-600"><?php echo e($s->branch->name ?? 'N/A'); ?> — <?php echo e($s->group->name ?? 'General'); ?> — Coach: <?php echo e($s->coach->name ?? 'TBD'); ?></div>
                                        </div>
                                        <a href="<?php echo e(route('students.index')); ?>" class="text-sm text-indigo-600">Learn more</a>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\guest\dashboard.blade.php ENDPATH**/ ?>