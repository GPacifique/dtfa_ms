<?php ($title = 'Office Equipment Management'); ?>


<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Office Equipment Management</h1>
                <p class="text-slate-600 mt-1">Manage office equipment inventory and tracking</p>
            </div>
            <a href="<?php echo e(route('admin.office-equipment.create')); ?>" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Office Equipment
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Equipment Type</label>
                    <input type="text" name="equipment_type" value="<?php echo e(request('equipment_type')); ?>" placeholder="e.g., computers, furniture..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Condition</label>
                    <select name="condition" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Conditions</option>
                        <option value="excellent" <?php if(request('condition') === 'excellent'): echo 'selected'; endif; ?>>Excellent</option>
                        <option value="good" <?php if(request('condition') === 'good'): echo 'selected'; endif; ?>>Good</option>
                        <option value="fair" <?php if(request('condition') === 'fair'): echo 'selected'; endif; ?>>Fair</option>
                        <option value="poor" <?php if(request('condition') === 'poor'): echo 'selected'; endif; ?>>Poor</option>
                        <option value="damaged" <?php if(request('condition') === 'damaged'): echo 'selected'; endif; ?>>Damaged</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Status</option>
                        <option value="available" <?php if(request('status') === 'available'): echo 'selected'; endif; ?>>Available</option>
                        <option value="in_use" <?php if(request('status') === 'in_use'): echo 'selected'; endif; ?>>In Use</option>
                        <option value="maintenance" <?php if(request('status') === 'maintenance'): echo 'selected'; endif; ?>>Maintenance</option>
                        <option value="retired" <?php if(request('status') === 'retired'): echo 'selected'; endif; ?>>Retired</option>
                        <option value="lost" <?php if(request('status') === 'lost'): echo 'selected'; endif; ?>>Lost</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Assigned To</label>
                    <input type="text" name="assigned_to" value="<?php echo e(request('assigned_to')); ?>" placeholder="Person or Department" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Filter
                    </button>
                    <a href="<?php echo e(route('admin.office-equipment.index')); ?>" class="px-6 py-2 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-left text-sm font-semibold text-slate-700">
                        <th class="px-6 py-3">Equipment Name</th>
                        <th class="px-6 py-3">Type</th>
                        <th class="px-6 py-3">Assigned To</th>
                        <th class="px-6 py-3">Condition</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php $__empty_1 = true; $__currentLoopData = $office_equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-slate-900"><?php echo e($item->name); ?></p>
                            <p class="text-xs text-slate-500">Ref: <?php echo e($item->reference_code ?? 'N/A'); ?></p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600"><?php echo e($item->equipment_type); ?></td>
                        <td class="px-6 py-4 text-sm text-slate-600"><?php echo e($item->assigned_to ?? '-'); ?></td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-<?php echo e($item->getConditionBadgeColor()); ?>-100 text-<?php echo e($item->getConditionBadgeColor()); ?>-800">
                                <?php echo e(ucfirst($item->condition)); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-<?php echo e($item->getStatusBadgeColor()); ?>-100 text-<?php echo e($item->getStatusBadgeColor()); ?>-800">
                                <?php echo e(ucfirst(str_replace('_', ' ', $item->status))); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="<?php echo e(route('admin.office-equipment.show', $item)); ?>" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View</a>
                            <a href="<?php echo e(route('admin.office-equipment.edit', $item)); ?>" class="text-blue-600 hover:text-blue-900 font-medium text-sm">Edit</a>
                            <form action="<?php echo e(route('admin.office-equipment.destroy', $item)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this equipment?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600 hover:text-red-900 font-medium text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                            No office equipment found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <?php echo e($office_equipment->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/office-equipment/index.blade.php ENDPATH**/ ?>