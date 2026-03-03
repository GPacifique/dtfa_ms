<?php $title = 'Training Schedule Equipment'; ?>


<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Training Schedule Equipment','subtitle' => 'Equipment requests and reports per training session']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Training Schedule Equipment','subtitle' => 'Equipment requests and reports per training session']); ?>
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="<?php echo e(route('admin.equipment.unified.requests')); ?>" class="btn-primary">+ New Request</a>
            <a href="<?php echo e(route('admin.equipment.unified')); ?>" class="btn-secondary">← Equipment Inventory</a>
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
<div class="space-y-6" x-data="{ view: 'sessions' }">

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="flex border-b border-slate-200">
            <button @click="view='sessions'" :class="view==='sessions' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500'"
                class="px-6 py-4 text-sm font-semibold border-b-2 transition">
                Training Sessions (<?php echo e($sessions->total()); ?>)
            </button>
            <button @click="view='inhouse'" :class="view==='inhouse' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500'"
                class="px-6 py-4 text-sm font-semibold border-b-2 transition">
                Inhouse Trainings (<?php echo e($inhouse->total()); ?>)
            </button>
        </div>

        
        <?php $reqStatusColors = ['pending'=>'yellow','approved'=>'blue','rejected'=>'red','fulfilled'=>'green','returned'=>'gray']; ?>
        <div x-show="view==='sessions'" x-cloak class="divide-y divide-slate-100">
            <?php $__empty_1 = true; $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-5">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h4 class="font-bold text-slate-800">
                                Session #<?php echo e($session->id); ?>

                                <?php if($session->group): ?> – <?php echo e($session->group->name); ?> <?php endif; ?>
                            </h4>
                            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full"><?php echo e($session->date?->format('d M Y') ?? '–'); ?></span>
                            <?php if($session->branch): ?>
                            <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full"><?php echo e($session->branch->name); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if($session->coach): ?>
                        <p class="text-xs text-slate-500 mt-1">Coach: <?php echo e($session->coach->name); ?></p>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('admin.equipment.unified.requests')); ?>?training_type=session&session_id=<?php echo e($session->id); ?>"
                        class="flex-shrink-0 text-xs text-indigo-600 hover:text-indigo-800 font-medium">View requests →</a>
                </div>

                
                <?php if($session->equipmentRequests->count()): ?>
                <div class="mt-3 overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Equipment</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Cat.</th>
                                <th class="px-3 py-2 text-center font-semibold text-slate-600">Req / Appr</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Status</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $session->equipmentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t border-slate-100">
                                <td class="px-3 py-2 font-medium text-slate-700"><?php echo e($req->equipment_name); ?></td>
                                <td class="px-3 py-2 text-slate-500 capitalize"><?php echo e($req->equipment_type); ?></td>
                                <td class="px-3 py-2 text-center">
                                    <?php echo e($req->quantity_requested); ?>

                                    <?php if($req->quantity_approved !== null): ?> / <span class="text-green-600"><?php echo e($req->quantity_approved); ?></span> <?php endif; ?>
                                </td>
                                <td class="px-3 py-2">
                                    <?php $sc = $reqStatusColors[$req->status] ?? 'gray'; ?>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-<?php echo e($sc); ?>-100 text-<?php echo e($sc); ?>-700 capitalize"><?php echo e($req->status); ?></span>
                                </td>
                                <td class="px-3 py-2">
                                    <?php if($req->usageReport): ?>
                                        <a href="<?php echo e(route('admin.equipment.unified.usage-reports.show', $req->usageReport)); ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">View</a>
                                    <?php elseif(in_array($req->status, ['approved','fulfilled'])): ?>
                                        <a href="<?php echo e(route('admin.equipment.unified.usage-reports.create', $req)); ?>" class="text-green-600 hover:text-green-800 font-medium">+ Report</a>
                                    <?php else: ?>
                                        <span class="text-slate-400">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p class="mt-3 text-xs text-slate-400 italic">No equipment requested for this session.</p>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-10 text-center text-slate-400">No training sessions found.</div>
            <?php endif; ?>
        </div>
        <?php if($sessions->hasPages()): ?>
        <div class="px-5 py-4 border-t border-slate-200" x-show="view==='sessions'" x-cloak><?php echo e($sessions->links()); ?></div>
        <?php endif; ?>

        
        <div x-show="view==='inhouse'" x-cloak class="divide-y divide-slate-100">
            <?php $__empty_1 = true; $__currentLoopData = $inhouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-5">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h4 class="font-bold text-slate-800"><?php echo e($training->training_name ?? 'Inhouse Training #'.$training->id); ?></h4>
                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full"><?php echo e($training->training_date?->format('d M Y') ?? '–'); ?></span>
                            <?php if($training->branch): ?>
                            <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full"><?php echo e($training->branch->name); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if($training->trainer_name): ?>
                        <p class="text-xs text-slate-500 mt-1">Trainer: <?php echo e($training->trainer_name); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($training->equipmentRequests->count()): ?>
                <div class="mt-3 overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Equipment</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Cat.</th>
                                <th class="px-3 py-2 text-center font-semibold text-slate-600">Req / Appr</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Status</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $training->equipmentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t border-slate-100">
                                <td class="px-3 py-2 font-medium text-slate-700"><?php echo e($req->equipment_name); ?></td>
                                <td class="px-3 py-2 text-slate-500 capitalize"><?php echo e($req->equipment_type); ?></td>
                                <td class="px-3 py-2 text-center">
                                    <?php echo e($req->quantity_requested); ?>

                                    <?php if($req->quantity_approved !== null): ?> / <span class="text-green-600"><?php echo e($req->quantity_approved); ?></span> <?php endif; ?>
                                </td>
                                <td class="px-3 py-2">
                                    <?php $sc = $reqStatusColors[$req->status] ?? 'gray'; ?>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-<?php echo e($sc); ?>-100 text-<?php echo e($sc); ?>-700 capitalize"><?php echo e($req->status); ?></span>
                                </td>
                                <td class="px-3 py-2">
                                    <?php if($req->usageReport): ?>
                                        <a href="<?php echo e(route('admin.equipment.unified.usage-reports.show', $req->usageReport)); ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">View</a>
                                    <?php elseif(in_array($req->status, ['approved','fulfilled'])): ?>
                                        <a href="<?php echo e(route('admin.equipment.unified.usage-reports.create', $req)); ?>" class="text-green-600 hover:text-green-800 font-medium">+ Report</a>
                                    <?php else: ?>
                                        <span class="text-slate-400">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p class="mt-3 text-xs text-slate-400 italic">No equipment requested for this training.</p>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-10 text-center text-slate-400">No inhouse trainings found.</div>
            <?php endif; ?>
        </div>
        <?php if($inhouse->hasPages()): ?>
        <div class="px-5 py-4 border-t border-slate-200" x-show="view==='inhouse'" x-cloak><?php echo e($inhouse->links()); ?></div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\equipment\training-equipment.blade.php ENDPATH**/ ?>