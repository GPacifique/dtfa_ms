<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Session Details','subtitle' => 'Review session schedule and info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Session Details','subtitle' => 'Review session schedule and info']); ?>
        <a href="<?php echo e(route('coach.sessions.create')); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">➕ Schedule New Session</a>

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
<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border border-slate-200 dark:border-neutral-700">
        <dl class="divide-y divide-slate-100 dark:divide-neutral-800">
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Date</dt>
                <dd><?php echo e($session->date->format('M d, Y')); ?></dd>
            </div>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Time</dt>
                <dd><?php echo e($session->start_time); ?> – <?php echo e($session->end_time); ?></dd>
            </div>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Location</dt>
                <dd><?php echo e($session->location); ?></dd>
            </div>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Group</dt>
                <dd><?php echo e($session->group->name ?? 'N/A'); ?></dd>
            </div>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Branch</dt>
                <dd><?php echo e($session->branch->name ?? 'N/A'); ?></dd>
            </div>
            <?php if($session->training_days && count($session->training_days) > 0): ?>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Training Days</dt>
                <dd><?php echo e(implode(', ', $session->training_days)); ?></dd>
            </div>
            <?php endif; ?>
        </dl>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\coach\sessions\show.blade.php ENDPATH**/ ?>