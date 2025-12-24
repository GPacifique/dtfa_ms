<?php $__env->startPush('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Matches','subtitle' => 'Plan, manage, and review game activities']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Matches','subtitle' => 'Plan, manage, and review game activities']); ?>
        <div class="mt-4 flex items-center gap-2">
            <a href="<?php echo e(route('admin.games.create')); ?>" class="btn-primary">➕ Create New Match</a>
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
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Match</th>
                    <th class="px-6 py-3">Discipline</th>
                    <th class="px-6 py-3">Score</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                <?php $__empty_1 = true; $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?php echo e($game->date?->format('M d, Y')); ?></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full shadow-md border border-gray-200 dark:border-gray-600" style="background-color: <?php echo e($game->home_color ?? '#3B82F6'); ?>" title="<?php echo e($game->home_team); ?> color"></span>
                            <span class="font-medium text-gray-900 dark:text-white"><?php echo e($game->home_team); ?></span>
                            <span class="text-gray-500 dark:text-gray-400 mx-1">vs</span>
                            <span class="font-medium text-gray-900 dark:text-white"><?php echo e($game->away_team); ?></span>
                            <span class="w-6 h-6 rounded-full shadow-md border border-gray-200 dark:border-gray-600" style="background-color: <?php echo e($game->away_color ?? '#EF4444'); ?>" title="<?php echo e($game->away_team); ?> color"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400"><?php echo e($game->discipline); ?></td>
                    <td class="px-6 py-4">
                        <?php if($game->status === 'completed'): ?>
                            <span class="font-bold text-lg text-gray-900 dark:text-white"><?php echo e($game->home_score ?? 0); ?> - <?php echo e($game->away_score ?? 0); ?></span>
                        <?php else: ?>
                            <span class="text-gray-500 dark:text-gray-400">—</span>
                        <?php endif; ?>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex gap-2 justify-end items-center">
                            <?php if($game->status === 'scheduled'): ?>
                                <a href="<?php echo e(route('admin.games.prepare', $game)); ?>" class="px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg font-medium text-sm transition">
                                    📋 Prepare
                                </a>
                                <form action="<?php echo e(route('admin.games.start', $game)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <button class="px-3 py-1.5 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg font-medium text-sm transition">
                                        ▶️ Start
                                    </button>
                                </form>
                            <?php elseif($game->status === 'in_progress'): ?>
                                <a href="<?php echo e(route('admin.games.report', $game)); ?>" class="px-3 py-1.5 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded-lg font-medium text-sm transition">
                                    📝 Report
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('admin.games.report', $game)); ?>" class="px-3 py-1.5 bg-emerald-100 hover:bg-emerald-200 text-emerald-700 rounded-lg font-medium text-sm transition">
                                    📊 View Report
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('admin.games.show', $game)); ?>" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium text-sm transition">
                                👁️
                            </a>
                            <form action="<?php echo e(route('admin.games.destroy', $game)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this match?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg font-medium text-sm transition">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        No matches found.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php echo e($games->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/games/index.blade.php ENDPATH**/ ?>