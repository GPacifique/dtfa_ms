<?php $__env->startPush('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Training Session Records','subtitle' => 'Filter and review training sessions']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Training Session Records','subtitle' => 'Filter and review training sessions']); ?>
        <a href="<?php echo e(route('admin.training_session_records.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Record</a>
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
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">📚 Training Session Records</h1>
        <a href="<?php echo e(route('admin.training_session_records.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Record</a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="p-4 border-b">
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs text-gray-500">Branch</label>
                    <select name="branch" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm">
                        <option value="">All</option>
                        <?php if(!empty($branches)): ?>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($b); ?>" <?php echo e(request('branch') === $b ? 'selected' : ''); ?>><?php echo e($b); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">Pitch</label>
                    <select name="training_pitch" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm">
                        <option value="">All</option>
                        <?php if(!empty($pitches)): ?>
                            <?php $__currentLoopData = $pitches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($p); ?>" <?php echo e(request('training_pitch') === $p ? 'selected' : ''); ?>><?php echo e($p); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">Coach</label>
                    <select name="coach_id" class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm">
                        <option value="">All</option>
                        <?php if(!empty($coaches)): ?>
                            <?php $__currentLoopData = $coaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($c->id); ?>" <?php echo e(request('coach_id') == $c->id ? 'selected' : ''); ?>><?php echo e($c->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500">Date</label>
                    <input type="date" name="date" value="<?php echo e(request('date')); ?>" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm" />
                </div>

                <div class="ml-2">
                    <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white rounded-md text-sm">Filter</button>
                    <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="ml-2 px-3 py-1.5 border rounded-md text-sm">Reset</a>
                </div>
            </form>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Coach</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pitch</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Attendees</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e(optional($record->date)->format('Y-m-d') ?? $record->date); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($record->coach_name); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($record->training_pitch); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($record->number_of_kids); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                            <?php if(!$record->number_of_kids && !$record->incident_report && !$record->comments): ?>
                                <!-- Not yet reported: show Prepare and Report buttons -->
                                <a href="<?php echo e(route('admin.training_session_records.prepare', $record)); ?>" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 mr-2">
                                    📝 Prepare
                                </a>
                                <a href="<?php echo e(route('admin.training_session_records.report', $record)); ?>" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white text-xs rounded-md hover:bg-emerald-700 mr-2">
                                    📊 Report
                                </a>
                            <?php else: ?>
                                <!-- Already reported: show View Report and Edit buttons -->
                                <a href="<?php echo e(route('admin.training_session_records.show', $record)); ?>" class="inline-flex items-center px-3 py-1.5 bg-purple-600 text-white text-xs rounded-md hover:bg-purple-700 mr-2">
                                    👁️ View Report
                                </a>
                                <a href="<?php echo e(route('admin.training_session_records.edit', $record)); ?>" class="inline-flex items-center px-3 py-1.5 bg-yellow-600 text-white text-xs rounded-md hover:bg-yellow-700 mr-2">
                                    ✏️ Edit
                                </a>
                            <?php endif; ?>
                            <form action="<?php echo e(route('admin.training_session_records.destroy', $record)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Delete this record?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-800 ml-2">🗑️</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($records->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/training_session_records/index.blade.php ENDPATH**/ ?>