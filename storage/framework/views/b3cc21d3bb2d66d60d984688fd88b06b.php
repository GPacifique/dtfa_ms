<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Income #'.e($income->id).'','subtitle' => 'Detailed income information']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Income #'.e($income->id).'','subtitle' => 'Detailed income information']); ?>
        <a href="<?php echo e(route('admin.incomes.edit', $income)); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg mr-2">Edit</a>
        <a href="<?php echo e(route('admin.incomes.index')); ?>" class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Incomes</a>
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
<div class="max-w-5xl mx-auto">
    <div class="card p-6">
        <!-- Header with amount focus -->
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Income #<?php echo e($income->id); ?></h2>
                <div class="mt-2 flex flex-wrap items-center gap-2">
                    <?php if($income->category): ?>
                        <span class="badge badge-slate"><?php echo e(ucfirst(str_replace('_',' ',$income->category))); ?></span>
                    <?php endif; ?>
                    <?php if($income->source): ?>
                        <span class="badge badge-slate"><?php echo e(ucfirst(str_replace('_',' ',$income->source))); ?></span>
                    <?php endif; ?>
                    <?php if($income->branch?->name): ?>
                        <span class="badge badge-slate"><?php echo e($income->branch->name); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-right">
                <div class="text-sm text-slate-500 dark:text-slate-400">Amount</div>
                <div class="text-3xl md:text-4xl font-extrabold tracking-tight text-emerald-600 dark:text-emerald-400">
                    <?php echo e(number_format($income->amount_cents, 0)); ?> <span class="text-base font-semibold"><?php echo e($income->currency ?? 'RWF'); ?></span>
                </div>
            </div>
        </div>

        <!-- Details grid -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Received At</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium"><?php echo e($income->received_at?->format('M d, Y H:i') ?? '—'); ?></div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Recorded By</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium"><?php echo e($income->recordedBy->name ?? '—'); ?></div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Branch</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium"><?php echo e($income->branch?->name ?? '—'); ?></div>
                </div>
            </div>
            <div class="space-y-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Category</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium"><?php echo e($income->category ?? '—'); ?></div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Source</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium"><?php echo e($income->source ?? '—'); ?></div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="mt-6">
            <div class="text-xs uppercase tracking-wide text-slate-500">Notes</div>
            <div class="mt-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 p-4 text-slate-700 dark:text-slate-200">
                <?php echo e($income->notes ?: 'No notes provided.'); ?>

            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="<?php echo e(route('admin.incomes.index')); ?>" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">Back to Incomes</a>
            <a href="<?php echo e(route('admin.incomes.edit', $income)); ?>" class="btn-primary">Edit</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\incomes\show.blade.php ENDPATH**/ ?>