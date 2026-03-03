<?php $title = 'Equipment Usage Reports'; ?>


<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Equipment Usage Reports','subtitle' => 'Post-training equipment usage records']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Equipment Usage Reports','subtitle' => 'Post-training equipment usage records']); ?>
        <div class="mt-4 flex gap-3">
            <a href="<?php echo e(route('admin.equipment.unified.requests')); ?>" class="btn-secondary">← Equipment Requests</a>
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
<div class="space-y-6">

    <?php if(session('success')): ?>
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Training Type</label>
                <select name="training_type" class="px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All</option>
                    <option value="session" <?php if(request('training_type')==='session'): echo 'selected'; endif; ?>>Training Session</option>
                    <option value="inhouse" <?php if(request('training_type')==='inhouse'): echo 'selected'; endif; ?>>Inhouse Training</option>
                </select>
            </div>
            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">Filter</button>
            <a href="<?php echo e(route('admin.equipment.unified.usage-reports')); ?>" class="px-5 py-2 bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-300 transition">Reset</a>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-200">
            <h3 class="text-base font-bold text-slate-800">All Usage Reports (<?php echo e($reports->total()); ?>)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Training</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Equipment</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Used</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Returned</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Damaged</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Lost</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Condition After</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Reported By</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Date</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">View</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition <?php echo e($report->hasLosses() ? 'bg-red-50/30' : ''); ?>">
                        <td class="px-4 py-3">
                            <p class="text-xs font-medium text-slate-700">
                                <?php if($report->trainingSession): ?>
                                    Session #<?php echo e($report->training_session_id); ?> (<?php echo e($report->trainingSession->date?->format('d M Y')); ?>)
                                <?php elseif($report->inhouseTraining): ?>
                                    <?php echo e($report->inhouseTraining->training_name); ?>

                                <?php else: ?> — <?php endif; ?>
                            </p>
                        </td>
                        <td class="px-4 py-3 font-medium text-slate-800"><?php echo e($report->equipment_name); ?></td>
                        <td class="px-4 py-3 text-center font-semibold text-slate-700"><?php echo e($report->quantity_used); ?></td>
                        <td class="px-4 py-3 text-center text-green-600 font-semibold"><?php echo e($report->quantity_returned); ?></td>
                        <td class="px-4 py-3 text-center <?php echo e($report->quantity_damaged > 0 ? 'text-orange-600 font-semibold' : 'text-slate-400'); ?>"><?php echo e($report->quantity_damaged); ?></td>
                        <td class="px-4 py-3 text-center <?php echo e($report->quantity_lost > 0 ? 'text-red-600 font-semibold' : 'text-slate-400'); ?>"><?php echo e($report->quantity_lost); ?></td>
                        <td class="px-4 py-3"><?php echo $__env->make('admin.equipment._condition_badge', ['condition' => $report->equipment_condition_after], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                        <td class="px-4 py-3 text-slate-600 text-xs"><?php echo e($report->reportedBy?->name ?? '—'); ?></td>
                        <td class="px-4 py-3 text-slate-500 text-xs"><?php echo e($report->reported_at?->format('d M Y') ?? $report->created_at->format('d M Y')); ?></td>
                        <td class="px-4 py-3 text-center">
                            <a href="<?php echo e(route('admin.equipment.unified.usage-reports.show', $report)); ?>" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="10" class="px-5 py-10 text-center text-slate-400">No usage reports found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($reports->hasPages()): ?>
        <div class="px-5 py-4 border-t border-slate-200"><?php echo e($reports->links()); ?></div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\equipment\usage-reports.blade.php ENDPATH**/ ?>