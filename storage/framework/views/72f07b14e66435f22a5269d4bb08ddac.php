<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => ''.e($activityPlan->challenge).'','subtitle' => ''.e($activityPlan->year).' • '.e($activityPlan->country).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($activityPlan->challenge).'','subtitle' => ''.e($activityPlan->year).' • '.e($activityPlan->country).'']); ?>
        <span class="px-4 py-2 rounded-full font-semibold text-lg <?php echo e($activityPlan->status === 'red' ? 'bg-red-200 text-red-800 dark:bg-red-900 dark:text-red-200' : ($activityPlan->status === 'yellow' ? 'bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-200')); ?>">
            <?php echo e($activityPlan->status === 'red' ? '🔴 Not Achieved' : ($activityPlan->status === 'yellow' ? '🟡 Ongoing' : '🟢 Achieved')); ?>

        </span>
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
<div class="container mx-auto px-4 py-6">


    <!-- Action Buttons -->
    <div class="mb-6 flex flex-wrap gap-2">
        <?php if($activityPlan->status !== 'red'): ?>
            <form action="<?php echo e(route('admin.activity-plans.markNotAchieved', $activityPlan)); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                    🔴 Mark as Not Achieved
                </button>
            </form>
        <?php endif; ?>

        <?php if($activityPlan->status !== 'yellow'): ?>
            <form action="<?php echo e(route('admin.activity-plans.markOngoing', $activityPlan)); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition">
                    🟡 Mark as Ongoing
                </button>
            </form>
        <?php endif; ?>

        <?php if($activityPlan->status !== 'green'): ?>
            <form action="<?php echo e(route('admin.activity-plans.markAchieved', $activityPlan)); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition">
                    🟢 Mark as Achieved
                </button>
            </form>
        <?php endif; ?>

        <a href="<?php echo e(route('admin.activity-plans.edit', $activityPlan)); ?>" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
            ✏️ Edit Plan
        </a>

        <form action="<?php echo e(route('admin.activity-plans.destroy', $activityPlan)); ?>" method="POST" class="inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition" onclick="return confirm('Are you sure?')">
                🗑️ Delete Plan
            </button>
        </form>

        <a href="<?php echo e(route('admin.activity-plans.index')); ?>" class="px-4 py-2 border border-gray-300 text-gray-700 dark:text-gray-300 dark:border-neutral-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Back to Plans
        </a>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content (2/3 width) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Opportunity & Challenge Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-indigo-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">🎯 Challenge & Opportunity</h2>
                <div class="space-y-4">
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Challenge</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1"><?php echo e($activityPlan->challenge); ?></p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Opportunity</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1"><?php echo e($activityPlan->opportunity); ?></p>
                    </div>
                </div>
            </div>

            <!-- Baseline Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-blue-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📊 Baseline</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap"><?php echo e($activityPlan->baseline); ?></p>
            </div>

            <!-- Intervention & Objectives Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-purple-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">🎯 Intervention & Objective</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap"><?php echo e($activityPlan->intervention_objective); ?></p>
            </div>

            <!-- Activities Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-green-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">✅ List of Activities</h2>
                <ul class="space-y-2">
                    <?php $__empty_1 = true; $__currentLoopData = $activityPlan->list_of_activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="flex items-start gap-3 p-2 bg-gray-50 dark:bg-neutral-800 rounded">
                            <span class="text-green-600 dark:text-green-400 font-bold">✓</span>
                            <span class="text-gray-900 dark:text-white"><?php echo e($activity); ?></span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-500 dark:text-gray-400">No activities defined</p>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- KPI Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-orange-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📈 Key Performance Indicator</h2>
                <p class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo e($activityPlan->kpi); ?></p>
            </div>

            <!-- Responsible Person Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-cyan-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">👤 Responsible Person</h2>
                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                    <?php echo e($activityPlan->responsiblePerson?->name ?? 'Not assigned'); ?>

                </div>
                <?php if($activityPlan->responsiblePerson): ?>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1"><?php echo e($activityPlan->responsiblePerson?->email); ?></p>
                <?php endif; ?>
            </div>

            <!-- Budget & Timeline Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-yellow-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">💰 Budget & Timeline</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Budget Cost</span>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">RWF <?php echo e(number_format($activityPlan->cost, 0)); ?></p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Financing Mechanism</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1"><?php echo e($activityPlan->financing_mechanism); ?></p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Starting Date</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1"><?php echo e($activityPlan->starting_date->format('M d, Y')); ?></p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Ending Date</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1"><?php echo e($activityPlan->ending_date->format('M d, Y')); ?></p>
                    </div>
                </div>
            </div>

            <!-- Status Remarks Card -->
            <?php if($activityPlan->status_remarks): ?>
                <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-pink-600">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📝 Status Remarks</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap"><?php echo e($activityPlan->status_remarks); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar (1/3 width) -->
        <div class="space-y-6">
            <!-- Quick Info Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">📌 Quick Info</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Year</span>
                        <p class="text-gray-900 dark:text-white font-semibold"><?php echo e($activityPlan->year); ?></p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Country</span>
                        <p class="text-gray-900 dark:text-white font-semibold"><?php echo e($activityPlan->country); ?></p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Focus Area</span>
                        <p class="text-gray-900 dark:text-white font-semibold"><?php echo e($activityPlan->focus_area); ?></p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Status</span>
                        <p class="text-lg font-bold <?php echo e($activityPlan->status === 'red' ? 'text-red-600' : ($activityPlan->status === 'yellow' ? 'text-yellow-600' : 'text-green-600')); ?>">
                            <?php echo e($activityPlan->status === 'red' ? 'Not Achieved' : ($activityPlan->status === 'yellow' ? 'Ongoing' : 'Achieved')); ?>

                        </p>
                    </div>
                </div>
            </div>

            <!-- Duration Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">⏱️ Duration</h3>
                <div class="text-center">
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                        <?php echo e($activityPlan->getDurationInDays()); ?>

                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">days</p>
                </div>
            </div>

            <!-- Dates Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">📅 Period</h3>
                <div class="space-y-2 text-sm">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">From</p>
                        <p class="font-semibold text-gray-900 dark:text-white"><?php echo e($activityPlan->starting_date->format('M d, Y')); ?></p>
                    </div>
                    <div class="border-t border-gray-200 dark:border-neutral-700 pt-2">
                        <p class="text-gray-600 dark:text-gray-400">To</p>
                        <p class="font-semibold text-gray-900 dark:text-white"><?php echo e($activityPlan->ending_date->format('M d, Y')); ?></p>
                    </div>
                </div>
            </div>

            <!-- Created & Updated Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">ℹ️ Metadata</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Created</span>
                        <p class="text-gray-900 dark:text-white"><?php echo e($activityPlan->created_at->format('M d, Y')); ?></p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Last Updated</span>
                        <p class="text-gray-900 dark:text-white"><?php echo e($activityPlan->updated_at->format('M d, Y')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\activity-plans\show.blade.php ENDPATH**/ ?>