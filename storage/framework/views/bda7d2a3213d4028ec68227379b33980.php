<?php $__env->startSection('content'); ?>
<div class="p-6">

    <div class="mb-6">
        <a href="<?php echo e(route('admin.tasks.index')); ?>" class="text-blue-600">← Back to list</a>
    </div>

    <div class="bg-white p-6 rounded shadow">

        <!-- Task Header -->
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold"><?php echo e($task->goal); ?></h2>

            <span class="px-3 py-1 rounded
                <?php if(now() > $task->end_date): ?>
                    bg-green-200 text-green-800
                <?php else: ?>
                    bg-yellow-200 text-yellow-800
                <?php endif; ?>">
                <?php if(now() > $task->end_date): ?>
                    Completed
                <?php else: ?>
                    In Progress
                <?php endif; ?>
            </span>
        </div>

        <!-- Staff -->
        <p class="text-gray-600 mb-3">
            <strong>Assigned Staff:</strong> <?php echo e($task->staff->name); ?>

        </p>

        <!-- Dates -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-100 p-4 rounded">
                <strong>Start Date:</strong> <?php echo e($task->start_date); ?>

            </div>
            <div class="bg-gray-100 p-4 rounded">
                <strong>End Date:</strong> <?php echo e($task->end_date); ?>

            </div>
        </div>

        <!-- Progress -->
        <?php
            $totalDays = \Carbon\Carbon::parse($task->start_date)->diffInDays($task->end_date);
            $passedDays = \Carbon\Carbon::parse($task->start_date)->diffInDays(now());
            $progress = min(100, intval(($passedDays / $totalDays) * 100));
        ?>

        <div class="mb-8">
            <h3 class="font-semibold mb-2">Progress</h3>
            <div class="w-full bg-gray-200 rounded h-4">
                <div class="bg-blue-600 h-4 rounded" style="width: <?php echo e($progress); ?>%"></div>
            </div>
            <p class="text-sm text-gray-600 mt-1"><?php echo e($progress); ?>% completed</p>
        </div>

        <!-- Timeline -->
        <h3 class="text-xl font-bold mb-3">Task Timeline</h3>
        <div class="border-l-4 border-blue-600 pl-4">
            <div class="mb-6">
                <p class="text-blue-600 font-semibold"><?php echo e($task->start_date); ?></p>
                <p class="text-gray-700">Task started</p>
            </div>
            <div class="mb-6">
                <p class="text-yellow-600 font-semibold">Current Status</p>
                <p class="text-gray-700">
                    <?php if(now() > $task->end_date): ?>
                        Task completed successfully.
                    <?php else: ?>
                        Task is still in progress.
                    <?php endif; ?>
                </p>
            </div>
            <div>
                <p class="text-green-600 font-semibold"><?php echo e($task->end_date); ?></p>
                <p class="text-gray-700">Deadline</p>
            </div>
        </div>

        <!-- Activities -->
        <div class="mt-8">
            <h3 class="text-xl font-bold mb-2">Activities</h3>
            <p class="bg-gray-50 p-4 rounded"><?php echo e($task->activities ?? 'No activities defined.'); ?></p>
        </div>

        <!-- Reporting -->
        <div class="mt-8">
            <h3 class="text-xl font-bold mb-2">Reporting</h3>
            <p class="bg-gray-50 p-4 rounded"><?php echo e($task->reporting ?? 'No report yet.'); ?></p>
        </div>

        <!-- Message -->
        <div class="mt-8">
            <h3 class="text-xl font-bold mb-2">Message</h3>
            <p class="bg-gray-50 p-4 rounded"><?php echo e($task->message ?? 'No message.'); ?></p>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\tasks\show.blade.php ENDPATH**/ ?>