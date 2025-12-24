<?php $__env->startPush('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Activity Plans','subtitle' => 'Manage organizational activity plans and progress']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Activity Plans','subtitle' => 'Manage organizational activity plans and progress']); ?>
        <a href="<?php echo e(route('admin.activity-plans.create')); ?>" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">➕ New Activity Plan</a>
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
<div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">📋 Activity Plans</h1>
        <a href="<?php echo e(route('admin.activity-plans.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Plan</a>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 py-0">
<div style="display: none;">


    <!-- Filters -->
    <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-4 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select name="status" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">All Statuses</option>
                    <option value="red" <?php echo e(request('status') === 'red' ? 'selected' : ''); ?>>🔴 Not Achieved</option>
                    <option value="yellow" <?php echo e(request('status') === 'yellow' ? 'selected' : ''); ?>>🟡 Ongoing</option>
                    <option value="green" <?php echo e(request('status') === 'green' ? 'selected' : ''); ?>>🟢 Achieved</option>
                </select>
            </div>

            <!-- Year Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Year</label>
                <input type="number" name="year" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Year" value="<?php echo e(request('year')); ?>">
            </div>

            <!-- Country Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                <select name="country" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">All Countries</option>
                    <option value="Rwanda" <?php echo e(request('country') === 'Rwanda' ? 'selected' : ''); ?>>Rwanda</option>
                    <option value="Tanzania" <?php echo e(request('country') === 'Tanzania' ? 'selected' : ''); ?>>Tanzania</option>
                </select>
            </div>

            <!-- Focus Area Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Focus Area</label>
                <select name="focus_area" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm">
                    <option value="">All Areas</option>
                    <option value="Sporting" <?php echo e(request('focus_area') === 'Sporting' ? 'selected' : ''); ?>>Sporting</option>
                    <option value="Administration and Finance" <?php echo e(request('focus_area') === 'Administration and Finance' ? 'selected' : ''); ?>>Admin & Finance</option>
                    <option value="Business" <?php echo e(request('focus_area') === 'Business' ? 'selected' : ''); ?>>Business</option>
                    <option value="Technology" <?php echo e(request('focus_area') === 'Technology' ? 'selected' : ''); ?>>Technology</option>
                    <option value="Capacity Building" <?php echo e(request('focus_area') === 'Capacity Building' ? 'selected' : ''); ?>>Capacity Building</option>
                    <option value="Social and Well Being" <?php echo e(request('focus_area') === 'Social and Well Being' ? 'selected' : ''); ?>>Social & Well Being</option>
                </select>
            </div>

            <!-- Search Button -->
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition">
                    🔍 Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-neutral-900 rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-neutral-800 border-b border-gray-200 dark:border-neutral-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Activity Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Year</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Country</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Focus Area</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Duration</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">Status</th>
                    <th class="px-6 py-3 text-right text-sm font-semibold text-gray-900 dark:text-white">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                <?php $__empty_1 = true; $__currentLoopData = $activityPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900 dark:text-white"><?php echo e($plan->challenge); ?></div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Obj: <?php echo e(Str::limit($plan->intervention_objective, 40)); ?></div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white font-semibold"><?php echo e($plan->year); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?php echo e($plan->country); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?php echo e(Str::limit($plan->focus_area, 15)); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                            <?php echo e($plan->starting_date->format('M d')); ?> → <?php echo e($plan->ending_date->format('M d')); ?>

                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold <?php echo e($plan->status === 'red' ? 'bg-red-200 text-red-800 dark:bg-red-900 dark:text-red-200' : ($plan->status === 'yellow' ? 'bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-200')); ?>">
                                <?php echo e($plan->status === 'red' ? '🔴 Not Achieved' : ($plan->status === 'yellow' ? '🟡 Ongoing' : '🟢 Achieved')); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-2 flex justify-end">
                            <a href="<?php echo e(route('admin.activity-plans.show', $plan)); ?>" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-medium transition">
                                View
                            </a>
                            <a href="<?php echo e(route('admin.activity-plans.edit', $plan)); ?>" class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded text-xs font-medium transition">
                                Edit
                            </a>
                            <form action="<?php echo e(route('admin.activity-plans.destroy', $plan)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-medium transition" onclick="return confirm('Delete this plan?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            <p class="text-lg">📋 No activity plans found</p>
                            <p class="text-sm mt-1">Create one to get started</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        <?php echo e($activityPlans->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/activity-plans/index.blade.php ENDPATH**/ ?>