<?php $title = 'Unified Equipment Management'; ?>


<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Equipment Management','subtitle' => 'All equipment in one place – General, Sports & Office']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Equipment Management','subtitle' => 'All equipment in one place – General, Sports & Office']); ?>
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="<?php echo e(route('admin.equipment.unified.requests')); ?>" class="btn-primary">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Equipment Requests
            </a>
            <a href="<?php echo e(route('admin.equipment.unified.training')); ?>" class="btn-secondary">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Training Schedules
            </a>
            <a href="<?php echo e(route('admin.equipment.unified.usage-reports')); ?>" class="btn-secondary">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Usage Reports
            </a>
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

    
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-indigo-600"><?php echo e($stats['general_total']); ?></p>
            <p class="text-xs text-slate-500 mt-1">General Items</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-green-600"><?php echo e($stats['general_avail']); ?></p>
            <p class="text-xs text-slate-500 mt-1">General Avail.</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-blue-600"><?php echo e($stats['sports_total']); ?></p>
            <p class="text-xs text-slate-500 mt-1">Sports Items</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-green-600"><?php echo e($stats['sports_avail']); ?></p>
            <p class="text-xs text-slate-500 mt-1">Sports Avail.</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-purple-600"><?php echo e($stats['office_total']); ?></p>
            <p class="text-xs text-slate-500 mt-1">Office Items</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-green-600"><?php echo e($stats['office_avail']); ?></p>
            <p class="text-xs text-slate-500 mt-1">Office Avail.</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-yellow-200 p-4 text-center">
            <p class="text-2xl font-bold text-yellow-600"><?php echo e($stats['pending_requests']); ?></p>
            <p class="text-xs text-slate-500 mt-1">Pending Requests</p>
        </div>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <div class="bg-white rounded-xl shadow-sm border border-indigo-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-indigo-100 rounded-lg p-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">General Equipment</h3>
            </div>
            <div class="flex flex-col gap-2">
                <a href="<?php echo e(route('admin.equipment.index')); ?>" class="flex items-center gap-2 px-3 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    View All
                </a>
                <a href="<?php echo e(route('admin.equipment.create')); ?>" class="flex items-center gap-2 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add New
                </a>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-blue-100 rounded-lg p-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7a4 4 0 00-4 4v6a4 4 0 004 4h12a4 4 0 004-4v-6a4 4 0 00-4-4M3 11h6M15 11h6M3 17h6M15 17h6"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Sports Equipment</h3>
            </div>
            <div class="flex flex-col gap-2">
                <a href="<?php echo e(route('admin.sports-equipment.index')); ?>" class="flex items-center gap-2 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    View All
                </a>
                <a href="<?php echo e(route('admin.sports-equipment.create')); ?>" class="flex items-center gap-2 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add New
                </a>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-purple-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-purple-100 rounded-lg p-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m0 0L4 7m8 4v10l8-4v-10m-8 14l-8-4v-10"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Office Equipment</h3>
            </div>
            <div class="flex flex-col gap-2">
                <a href="<?php echo e(route('admin.office-equipment.index')); ?>" class="flex items-center gap-2 px-3 py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    View All
                </a>
                <a href="<?php echo e(route('admin.office-equipment.create')); ?>" class="flex items-center gap-2 px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add New
                </a>
            </div>
        </div>

        
        <?php if(Route::has('kit-manager.dashboard')): ?>
        <div class="bg-white rounded-xl shadow-sm border border-amber-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-amber-100 rounded-lg p-2">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8.97-5.7a1 1 0 00-1.06 0L4 7m16 0l-8 4.97m0 0L4 7m16 0v10a1 1 0 01-.94.997L12 22.97m0 0l8-4.97V7M12 22.97L4 18M12 22.97v-4.97"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Kit Manager</h3>
            </div>
            <div class="flex flex-col gap-2">
                <a href="<?php echo e(route('kit-manager.dashboard')); ?>" class="flex items-center gap-2 px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Open Dashboard
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <form method="GET" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 items-end">
            <input type="hidden" name="tab" value="<?php echo e($tab); ?>">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Search</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Name…"
                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Status</option>
                    <option value="available" <?php if(request('status')==='available'): echo 'selected'; endif; ?>>Available</option>
                    <option value="in_use" <?php if(request('status')==='in_use'): echo 'selected'; endif; ?>>In Use</option>
                    <option value="maintenance" <?php if(request('status')==='maintenance'): echo 'selected'; endif; ?>>Maintenance</option>
                    <option value="retired" <?php if(request('status')==='retired'): echo 'selected'; endif; ?>>Retired</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Condition</label>
                <select name="condition" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Conditions</option>
                    <option value="excellent" <?php if(request('condition')==='excellent'): echo 'selected'; endif; ?>>Excellent</option>
                    <option value="good" <?php if(request('condition')==='good'): echo 'selected'; endif; ?>>Good</option>
                    <option value="fair" <?php if(request('condition')==='fair'): echo 'selected'; endif; ?>>Fair</option>
                    <option value="poor" <?php if(request('condition')==='poor'): echo 'selected'; endif; ?>>Poor</option>
                    <option value="damaged" <?php if(request('condition')==='damaged'): echo 'selected'; endif; ?>>Damaged</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Branch</label>
                <select name="branch_id" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Branches</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->id); ?>" <?php if(request('branch_id')==$branch->id): echo 'selected'; endif; ?>><?php echo e($branch->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">Filter</button>
                <a href="<?php echo e(route('admin.equipment.unified')); ?>" class="px-4 py-2 bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-300 transition">Reset</a>
            </div>
        </form>
    </div>

    
    <div x-data="{ tab: '<?php echo e($tab); ?>' }" class="bg-white rounded-xl shadow-sm border border-slate-200">
        
        <div class="border-b border-slate-200 px-6">
            <nav class="-mb-px flex gap-1 overflow-x-auto">
                <button @click="tab='general'"
                    :class="tab==='general' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700'"
                    class="inline-flex items-center gap-2 px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap">
                    General Equipment
                    <span class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full text-xs"><?php echo e($general->total()); ?></span>
                </button>
                <button @click="tab='sports'"
                    :class="tab==='sports' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700'"
                    class="inline-flex items-center gap-2 px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap">
                    Sports Equipment
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs"><?php echo e($sports->total()); ?></span>
                </button>
                <button @click="tab='office'"
                    :class="tab==='office' ? 'border-purple-600 text-purple-600' : 'border-transparent text-slate-500 hover:text-slate-700'"
                    class="inline-flex items-center gap-2 px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap">
                    Office Equipment
                    <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full text-xs"><?php echo e($office->total()); ?></span>
                </button>
            </nav>
        </div>

        
        <div class="px-6 py-3 border-b border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">
            <div x-show="tab==='general'">
                <a href="<?php echo e(route('admin.equipment.create')); ?>"
                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add General Equipment
                </a>
            </div>
            <div x-show="tab==='sports'">
                <a href="<?php echo e(route('admin.sports-equipment.create')); ?>"
                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Sports Equipment
                </a>
            </div>
            <div x-show="tab==='office'">
                <a href="<?php echo e(route('admin.office-equipment.create')); ?>"
                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-purple-600 text-white text-xs font-semibold rounded-lg hover:bg-purple-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Office Equipment
                </a>
            </div>
        </div>

        
        <div x-show="tab==='general'" x-cloak class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Name</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Category</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Qty / Avail.</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Condition</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Branch</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $general; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 font-medium text-slate-800"><?php echo e($item->name); ?></td>
                        <td class="px-5 py-3 text-slate-600 capitalize"><?php echo e($item->category); ?></td>
                        <td class="px-5 py-3 text-center">
                            <span class="font-semibold"><?php echo e($item->quantity); ?></span>
                            <span class="text-slate-400">/</span>
                            <span class="text-green-600 font-semibold"><?php echo e($item->available_quantity); ?></span>
                        </td>
                        <td class="px-5 py-3"><?php echo $__env->make('admin.equipment._condition_badge', ['condition' => $item->condition], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                        <td class="px-5 py-3"><?php echo $__env->make('admin.equipment._status_badge', ['status' => $item->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                        <td class="px-5 py-3 text-slate-600"><?php echo e($item->branch?->name ?? '–'); ?></td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('admin.equipment.show', $item)); ?>" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View</a>
                                <a href="<?php echo e(route('admin.equipment.edit', $item)); ?>" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form action="<?php echo e(route('admin.equipment.destroy', $item)); ?>" method="POST" class="inline"
                                    onsubmit="return confirm('Delete <?php echo e(addslashes($item->name)); ?>?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="px-5 py-8 text-center text-slate-400">No general equipment found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if($general->hasPages()): ?>
            <div class="px-5 py-4 border-t border-slate-200"><?php echo e($general->appends(request()->except('general_page'))->links()); ?></div>
            <?php endif; ?>
        </div>

        
        <div x-show="tab==='sports'" x-cloak class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Name</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Type</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Qty / Avail.</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Condition</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Branch</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Ref. Code</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 font-medium text-slate-800"><?php echo e($item->name); ?></td>
                        <td class="px-5 py-3 text-slate-600 capitalize"><?php echo e($item->equipment_type); ?></td>
                        <td class="px-5 py-3 text-center">
                            <span class="font-semibold"><?php echo e($item->quantity); ?></span>
                            <span class="text-slate-400">/</span>
                            <span class="text-green-600 font-semibold"><?php echo e($item->available_quantity); ?></span>
                        </td>
                        <td class="px-5 py-3"><?php echo $__env->make('admin.equipment._condition_badge', ['condition' => $item->condition], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                        <td class="px-5 py-3"><?php echo $__env->make('admin.equipment._status_badge', ['status' => $item->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                        <td class="px-5 py-3 text-slate-600"><?php echo e($item->branch?->name ?? '–'); ?></td>
                        <td class="px-5 py-3 text-slate-500 font-mono text-xs"><?php echo e($item->reference_code ?? '–'); ?></td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('admin.sports-equipment.show', $item)); ?>" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View</a>
                                <a href="<?php echo e(route('admin.sports-equipment.edit', $item)); ?>" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form action="<?php echo e(route('admin.sports-equipment.destroy', $item)); ?>" method="POST" class="inline"
                                    onsubmit="return confirm('Delete <?php echo e(addslashes($item->name)); ?>?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="8" class="px-5 py-8 text-center text-slate-400">No sports equipment found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if($sports->hasPages()): ?>
            <div class="px-5 py-4 border-t border-slate-200"><?php echo e($sports->appends(request()->except('sports_page'))->links()); ?></div>
            <?php endif; ?>
        </div>

        
        <div x-show="tab==='office'" x-cloak class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Name</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Type</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Qty / Avail.</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Condition</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Branch</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Warranty</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $office; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 font-medium text-slate-800"><?php echo e($item->name); ?></td>
                        <td class="px-5 py-3 text-slate-600 capitalize"><?php echo e($item->equipment_type); ?></td>
                        <td class="px-5 py-3 text-center">
                            <span class="font-semibold"><?php echo e($item->quantity); ?></span>
                            <span class="text-slate-400">/</span>
                            <span class="text-green-600 font-semibold"><?php echo e($item->available_quantity); ?></span>
                        </td>
                        <td class="px-5 py-3"><?php echo $__env->make('admin.equipment._condition_badge', ['condition' => $item->condition], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                        <td class="px-5 py-3"><?php echo $__env->make('admin.equipment._status_badge', ['status' => $item->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                        <td class="px-5 py-3 text-slate-600"><?php echo e($item->branch?->name ?? '–'); ?></td>
                        <td class="px-5 py-3">
                            <?php if($item->warranty_expiry): ?>
                                <?php if($item->isWarrantyExpired()): ?>
                                    <span class="text-red-600 text-xs font-medium">Expired <?php echo e($item->warranty_expiry->format('d M Y')); ?></span>
                                <?php else: ?>
                                    <span class="text-green-600 text-xs font-medium">Until <?php echo e($item->warranty_expiry->format('d M Y')); ?></span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-slate-400 text-xs">–</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('admin.office-equipment.show', $item)); ?>" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View</a>
                                <a href="<?php echo e(route('admin.office-equipment.edit', $item)); ?>" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form action="<?php echo e(route('admin.office-equipment.destroy', $item)); ?>" method="POST" class="inline"
                                    onsubmit="return confirm('Delete <?php echo e(addslashes($item->name)); ?>?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="8" class="px-5 py-8 text-center text-slate-400">No office equipment found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if($office->hasPages()): ?>
            <div class="px-5 py-4 border-t border-slate-200"><?php echo e($office->appends(request()->except('office_page'))->links()); ?></div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($recentRequests->count()): ?>
    <?php $reqStatusColors = ['pending' => 'yellow', 'approved' => 'blue', 'rejected' => 'red', 'fulfilled' => 'green', 'returned' => 'gray']; ?>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-800">Recent Equipment Requests</h3>
            <a href="<?php echo e(route('admin.equipment.unified.requests')); ?>" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">View All →</a>
        </div>
        <div class="space-y-3">
            <?php $__currentLoopData = $recentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $reqColor = $reqStatusColors[$req->status] ?? 'gray'; ?>
                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate"><?php echo e($req->equipment_name); ?></p>
                        <p class="text-xs text-slate-500"><?php echo e($req->getTrainingLabel()); ?> &bull; Requested by <?php echo e($req->requestedBy?->name ?? '—'); ?></p>
                    </div>
                    <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                        <span class="text-sm font-semibold text-slate-700">×<?php echo e($req->quantity_requested); ?></span>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-<?php echo e($reqColor); ?>-100 text-<?php echo e($reqColor); ?>-700 capitalize"><?php echo e($req->status); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/equipment/unified.blade.php ENDPATH**/ ?>