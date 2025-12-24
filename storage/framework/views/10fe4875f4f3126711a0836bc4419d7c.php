<?php $__env->startPush('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'In-House Trainings','subtitle' => 'Manage training records and schedules']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'In-House Trainings','subtitle' => 'Manage training records and schedules']); ?>
        <div class="mt-4">
            <a href="<?php echo e(route('admin.inhousetrainings.create')); ?>" class="btn-primary">➕ Add New Training</a>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                    <th class="px-6 py-3">Participant</th>
                    <th class="px-6 py-3">Training Name</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Venue/Channel</th>
                    <th class="px-6 py-3">Branch</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                <?php $__empty_1 = true; $__currentLoopData = $inhousetrainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900 dark:text-white"><?php echo e($t->first_name); ?> <?php echo e($t->second_name); ?></div>
                        <div class="text-xs text-gray-500"><?php echo e($t->role->name ?? '—'); ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900 dark:text-white"><?php echo e($t->training_name ?? '—'); ?></div>
                        <div class="text-xs text-gray-500"><?php echo e($t->discipline); ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo e($t->training_category === 'In house' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'); ?>">
                            <?php echo e($t->training_category); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                        <div><?php echo e($t->training_date?->format('M d, Y') ?? $t->start?->format('M d, Y') ?? '—'); ?></div>
                        <?php if($t->start && $t->end): ?>
                        <div class="text-xs text-gray-500"><?php echo e($t->start->format('H:i')); ?> - <?php echo e($t->end->format('H:i')); ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                        <?php echo e($t->venue ?? $t->channel ?? '—'); ?>

                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400"><?php echo e($t->branch->name ?? '—'); ?></td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="<?php echo e(route('admin.inhousetrainings.show', $t->id)); ?>" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400 font-medium">View</a>
                        <a href="<?php echo e(route('admin.inhousetrainings.edit', $t->id)); ?>" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400 font-medium">Edit</a>
                        <form action="<?php echo e(route('admin.inhousetrainings.destroy', $t->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this training?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600 hover:text-red-900 dark:hover:text-red-400 font-medium">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        No trainings found.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php echo e($inhousetrainings->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/inhousetrainings/index.blade.php ENDPATH**/ ?>