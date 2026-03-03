<?php $title = 'Usage Report Details'; ?>


<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Usage Report #'.e($report->id).'','subtitle' => 'Equipment usage record after training']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Usage Report #'.e($report->id).'','subtitle' => 'Equipment usage record after training']); ?>
        <div class="mt-4 flex gap-3">
            <a href="<?php echo e(route('admin.equipment.unified.usage-reports')); ?>" class="btn-secondary">← All Reports</a>
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
<div class="max-w-3xl mx-auto space-y-6">

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Training</h3>
                <?php if($report->trainingSession): ?>
                    <p class="font-bold text-slate-800">Training Session #<?php echo e($report->training_session_id); ?></p>
                    <p class="text-sm text-slate-600"><?php echo e($report->trainingSession->date?->format('d M Y')); ?></p>
                    <?php if($report->trainingSession->branch): ?>
                    <p class="text-sm text-slate-500"><?php echo e($report->trainingSession->branch->name); ?></p>
                    <?php endif; ?>
                <?php elseif($report->inhouseTraining): ?>
                    <p class="font-bold text-slate-800"><?php echo e($report->inhouseTraining->training_name); ?></p>
                    <p class="text-sm text-slate-600"><?php echo e($report->inhouseTraining->training_date?->format('d M Y')); ?></p>
                <?php else: ?>
                    <p class="text-slate-500">—</p>
                <?php endif; ?>
            </div>
            <div>
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Equipment</h3>
                <p class="font-bold text-slate-800"><?php echo e($report->equipment_name); ?></p>
                <p class="text-sm text-slate-500 capitalize">Category: <?php echo e($report->equipment_type); ?></p>
                <div class="mt-2"><?php echo $__env->make('admin.equipment._condition_badge', ['condition' => $report->equipment_condition_after], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-blue-700"><?php echo e($report->quantity_used); ?></p>
            <p class="text-xs text-blue-600 mt-1 font-semibold">Used</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-green-700"><?php echo e($report->quantity_returned); ?></p>
            <p class="text-xs text-green-600 mt-1 font-semibold">Returned</p>
        </div>
        <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-orange-700"><?php echo e($report->quantity_damaged); ?></p>
            <p class="text-xs text-orange-600 mt-1 font-semibold">Damaged</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-red-700"><?php echo e($report->quantity_lost); ?></p>
            <p class="text-xs text-red-600 mt-1 font-semibold">Lost</p>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-5">
        <?php if($report->usage_summary): ?>
        <div>
            <h3 class="text-sm font-bold text-slate-700 mb-2">Usage Summary</h3>
            <p class="text-sm text-slate-600 leading-relaxed"><?php echo e($report->usage_summary); ?></p>
        </div>
        <?php endif; ?>

        <?php if($report->issues_encountered): ?>
        <div>
            <h3 class="text-sm font-bold text-orange-700 mb-2">Issues Encountered</h3>
            <p class="text-sm text-slate-600 leading-relaxed bg-orange-50 p-3 rounded-lg"><?php echo e($report->issues_encountered); ?></p>
        </div>
        <?php endif; ?>

        <?php if($report->recommendations): ?>
        <div>
            <h3 class="text-sm font-bold text-indigo-700 mb-2">Recommendations</h3>
            <p class="text-sm text-slate-600 leading-relaxed bg-indigo-50 p-3 rounded-lg"><?php echo e($report->recommendations); ?></p>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-3 text-sm text-slate-600">
        <p>Reported by <span class="font-semibold text-slate-800"><?php echo e($report->reportedBy?->name ?? '—'); ?></span></p>
        <p><?php echo e($report->reported_at?->format('d M Y, H:i') ?? $report->created_at->format('d M Y, H:i')); ?></p>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\equipment\show-usage-report.blade.php ENDPATH**/ ?>