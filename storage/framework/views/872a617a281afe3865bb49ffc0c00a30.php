<?php ($title = 'Equipment Management'); ?>


<?php $__env->startPush('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Equipment Management','subtitle' => 'Manage sports equipment and inventory']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Equipment Management','subtitle' => 'Manage sports equipment and inventory']); ?>
        <div class="mt-4">
            <a href="<?php echo e(route('admin.equipment.create')); ?>" class="btn-primary">Add Equipment</a>
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
    <div class="space-y-6">

        <?php if(session('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Search</label>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search equipment..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Category</label>
                    <select name="category" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Categories</option>
                        <option value="balls" <?php if(request('category') === 'balls'): echo 'selected'; endif; ?>>Balls</option>
                        <option value="nets" <?php if(request('category') === 'nets'): echo 'selected'; endif; ?>>Nets</option>
                        <option value="training" <?php if(request('category') === 'training'): echo 'selected'; endif; ?>>Training Equipment</option>
                        <option value="safety" <?php if(request('category') === 'safety'): echo 'selected'; endif; ?>>Safety Gear</option>
                        <option value="facility" <?php if(request('category') === 'facility'): echo 'selected'; endif; ?>>Facility Equipment</option>
                        <option value="other" <?php if(request('category') === 'other'): echo 'selected'; endif; ?>>Other</option>
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
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Condition</label>
                    <select name="condition" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Conditions</option>
                        <option value="good" <?php if(request('condition') === 'good'): echo 'selected'; endif; ?>>Good</option>
                        <option value="fair" <?php if(request('condition') === 'fair'): echo 'selected'; endif; ?>>Fair</option>
                        <option value="poor" <?php if(request('condition') === 'poor'): echo 'selected'; endif; ?>>Poor</option>
                        <option value="damaged" <?php if(request('condition') === 'damaged'): echo 'selected'; endif; ?>>Damaged</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Branch</label>
                    <select name="branch_id" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Branches</option>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($branch->id); ?>" <?php if(request('branch_id') == $branch->id): echo 'selected'; endif; ?>><?php echo e($branch->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex items-end gap-2 md:col-span-2 lg:col-span-5">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Apply Filters
                    </button>
                    <a href="<?php echo e(route('admin.equipment.index')); ?>" class="px-6 py-2 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Equipment List -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <?php if($equipment->isEmpty()): ?>
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <p class="text-slate-500 font-medium text-lg">No equipment found</p>
                    <a href="<?php echo e(route('admin.equipment.create')); ?>" class="inline-block mt-4 px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Add First Equipment
                    </a>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Equipment</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Condition</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Branch</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <?php $__currentLoopData = $equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-slate-900"><?php echo e($item->name); ?></div>
                                        <?php if($item->description): ?>
                                            <div class="text-sm text-slate-500"><?php echo e(Str::limit($item->description, 50)); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            <?php if($item->category === 'balls'): ?> bg-blue-100 text-blue-800
                                            <?php elseif($item->category === 'nets'): ?> bg-purple-100 text-purple-800
                                            <?php elseif($item->category === 'training'): ?> bg-green-100 text-green-800
                                            <?php elseif($item->category === 'safety'): ?> bg-red-100 text-red-800
                                            <?php elseif($item->category === 'facility'): ?> bg-amber-100 text-amber-800
                                            <?php else: ?> bg-slate-100 text-slate-800 <?php endif; ?>">
                                            <?php echo e(ucfirst($item->category)); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900"><?php echo e($item->available_quantity); ?> / <?php echo e($item->quantity); ?></div>
                                        <div class="text-xs text-slate-500">Available / Total</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            <?php if($item->condition === 'good'): ?> bg-green-100 text-green-800
                                            <?php elseif($item->condition === 'fair'): ?> bg-yellow-100 text-yellow-800
                                            <?php elseif($item->condition === 'poor'): ?> bg-orange-100 text-orange-800
                                            <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>">
                                            <?php echo e(ucfirst($item->condition)); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            <?php if($item->status === 'available'): ?> bg-green-100 text-green-800
                                            <?php elseif($item->status === 'in_use'): ?> bg-blue-100 text-blue-800
                                            <?php elseif($item->status === 'maintenance'): ?> bg-amber-100 text-amber-800
                                            <?php else: ?> bg-slate-100 text-slate-800 <?php endif; ?>">
                                            <?php echo e(ucfirst(str_replace('_', ' ', $item->status))); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        <?php echo e($item->branch->name ?? 'N/A'); ?>

                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        <?php echo e($item->location ?? 'N/A'); ?>

                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="<?php echo e(route('admin.equipment.show', $item)); ?>" class="text-blue-600 hover:text-blue-800 font-medium">View</a>
                                            <a href="<?php echo e(route('admin.equipment.edit', $item)); ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>
                                            <form action="<?php echo e(route('admin.equipment.destroy', $item)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-slate-200">
                    <?php echo e($equipment->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/equipment/index.blade.php ENDPATH**/ ?>