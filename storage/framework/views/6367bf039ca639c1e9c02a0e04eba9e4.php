<?php $title = 'Sports Equipment Management'; ?>


<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        
        <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-lime-500/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-blue-400/30 to-cyan-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

            <div class="relative z-10 px-6 py-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">🏋️ Sports Equipment Management</h1>
                    <p class="text-white/90 mt-1">Manage sports equipment inventory and tracking</p>
                </div>
                <a href="<?php echo e(route('admin.sports-equipment.create')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-emerald-700 font-semibold rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Equipment
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Equipment Type</label>
                    <input type="text" name="equipment_type" value="<?php echo e(request('equipment_type')); ?>" placeholder="e.g., balls, nets..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
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
                <div class="flex items-end gap-2">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Filter
                    </button>
                    <a href="<?php echo e(route('admin.sports-equipment.index')); ?>" class="px-6 py-2 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
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
                        <th class="px-6 py-3">Quantity</th>
                        <th class="px-6 py-3">Condition</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Location</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php $__empty_1 = true; $__currentLoopData = $sports_equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-slate-900"><?php echo e($item->name); ?></p>
                            <p class="text-xs text-slate-500">Ref: <?php echo e($item->reference_code ?? 'N/A'); ?></p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600"><?php echo e($item->equipment_type); ?></td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <span class="font-semibold"><?php echo e($item->available_quantity); ?></span> / <?php echo e($item->quantity); ?>

                        </td>
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
                        <td class="px-6 py-4 text-sm text-slate-600"><?php echo e($item->location); ?></td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="<?php echo e(route('admin.sports-equipment.show', $item)); ?>" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View</a>
                            <a href="<?php echo e(route('admin.sports-equipment.edit', $item)); ?>" class="text-blue-600 hover:text-blue-900 font-medium text-sm">Edit</a>
                            <form action="<?php echo e(route('admin.sports-equipment.destroy', $item)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this equipment?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600 hover:text-red-900 font-medium text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                            No sports equipment found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <?php echo e($sports_equipment->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\sports-equipment\index.blade.php ENDPATH**/ ?>