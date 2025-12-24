<?php $__env->startSection('content'); ?>

<div class="py-4 md:py-6 px-3 sm:px-4 md:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-6 md:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white truncate">Equipment Dashboard</h1>
                <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 mt-1">Real-time equipment inventory and status overview</p>
            </div>
            <div class="flex flex-col xs:flex-row gap-2 flex-shrink-0">
                <a href="<?php echo e(route('admin.sports-equipment.index')); ?>" class="btn btn-secondary text-xs sm:text-sm px-3 sm:px-4 py-2">Sports Equip</a>
                <a href="<?php echo e(route('admin.office-equipment.index')); ?>" class="btn btn-secondary text-xs sm:text-sm px-3 sm:px-4 py-2">Office Equip</a>
            </div>
        </div>
    </div>

    <!-- Key Metrics Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mb-6 md:mb-8">
        <!-- Total Sports Equipment -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 truncate">Sports Equipment</p>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 dark:text-blue-400 mt-1 sm:mt-2"><?php echo e($sportsEquipmentTotal); ?></p>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 sm:mt-2">Total inventory</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900/30 p-2 sm:p-3 rounded-lg flex-shrink-0">
                    <svg class="w-6 sm:w-8 h-6 sm:h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Office Equipment -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6 border-l-4 border-emerald-500 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 truncate">Office Equipment</p>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-emerald-600 dark:text-emerald-400 mt-1 sm:mt-2"><?php echo e($officeEquipmentTotal); ?></p>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 sm:mt-2">Total inventory</p>
                </div>
                <div class="bg-emerald-100 dark:bg-emerald-900/30 p-2 sm:p-3 rounded-lg flex-shrink-0">
                    <svg class="w-6 sm:w-8 h-6 sm:h-8 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm0 8a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Equipment In Use -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 truncate">In Active Use</p>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-green-600 dark:text-green-400 mt-1 sm:mt-2"><?php echo e($sportsEquipmentInUse + $officeEquipmentInUse); ?></p>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 sm:mt-2 truncate">
                        <?php echo e(($sportsEquipmentTotal + $officeEquipmentTotal) > 0
                            ? round((($sportsEquipmentInUse + $officeEquipmentInUse) / ($sportsEquipmentTotal + $officeEquipmentTotal)) * 100, 1)
                            : 0); ?>% utilization
                    </p>
                </div>
                <div class="bg-green-100 dark:bg-green-900/30 p-2 sm:p-3 rounded-lg flex-shrink-0">
                    <svg class="w-6 sm:w-8 h-6 sm:h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-2.77 3.066 3.066 0 00-3.58 3.03A3.066 3.066 0 006.267 3.455zm9.8 6.32a3.066 3.066 0 001.745-2.77 3.066 3.066 0 00-3.58 3.03 3.066 3.066 0 001.835-.26zM9 13a3 3 0 11-6 0 3 3 0 016 0zm7 0a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Attention Required -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6 border-l-4 border-amber-500 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 truncate">Needs Attention</p>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-amber-600 dark:text-amber-400 mt-1 sm:mt-2"><?php echo e(count($damageSportsEquipment) + count($damageOfficeEquipment) + $warrantyExpiringCount); ?></p>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 sm:mt-2 truncate">Damaged + Warranty expiring</p>
                </div>
                <div class="bg-amber-100 dark:bg-amber-900/30 p-2 sm:p-3 rounded-lg flex-shrink-0">
                    <svg class="w-6 sm:w-8 h-6 sm:h-8 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Status & Condition Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 md:gap-6 mb-6 md:mb-8">
        <!-- Sports Equipment Condition -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6 h-full">
            <h3 class="text-base sm:text-lg font-semibold text-slate-900 dark:text-white mb-3 sm:mb-4 flex items-center gap-2">
                <span class="w-1 h-5 sm:h-6 bg-blue-500 rounded"></span>
                <span class="truncate">Sports Equipment Condition</span>
            </h3>
            <div class="space-y-3">
                <?php
                    $conditionColors = [
                        'excellent' => 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300',
                        'good' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300',
                        'fair' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300',
                        'damaged' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300',
                    ];
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $sportsEquipmentByCondition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full <?php echo e($condition === 'excellent' ? 'bg-green-500' : ($condition === 'good' ? 'bg-blue-500' : ($condition === 'fair' ? 'bg-yellow-500' : 'bg-red-500'))); ?>"></div>
                            <span class="text-slate-700 dark:text-slate-300 capitalize font-medium"><?php echo e($condition); ?></span>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold <?php echo e($conditionColors[$condition] ?? 'bg-slate-100 text-slate-800'); ?>">
                            <?php echo e($count); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-slate-500 dark:text-slate-400 text-sm text-center py-4">No equipment recorded</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Office Equipment Condition -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6 h-full">
            <h3 class="text-base sm:text-lg font-semibold text-slate-900 dark:text-white mb-3 sm:mb-4 flex items-center gap-2">
                <span class="w-1 h-5 sm:h-6 bg-emerald-500 rounded"></span>
                <span class="truncate">Office Equipment Condition</span>
            </h3>
            <div class="space-y-3">
                <?php $__empty_1 = true; $__currentLoopData = $officeEquipmentByCondition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full <?php echo e($condition === 'excellent' ? 'bg-green-500' : ($condition === 'good' ? 'bg-blue-500' : ($condition === 'fair' ? 'bg-yellow-500' : 'bg-red-500'))); ?>"></div>
                            <span class="text-slate-700 dark:text-slate-300 capitalize font-medium"><?php echo e($condition); ?></span>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold <?php echo e($conditionColors[$condition] ?? 'bg-slate-100 text-slate-800'); ?>">
                            <?php echo e($count); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-slate-500 dark:text-slate-400 text-sm text-center py-4">No equipment recorded</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Storage Status -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6 h-full md:col-span-1">
            <h3 class="text-base sm:text-lg font-semibold text-slate-900 dark:text-white mb-3 sm:mb-4 flex items-center gap-2">
                <span class="w-1 h-5 sm:h-6 bg-purple-500 rounded"></span>
                <span class="truncate">Storage Status</span>
            </h3>
            <div class="space-y-3">
                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-700 dark:text-slate-300">Sports - Stored</span>
                        <span class="font-bold text-slate-900 dark:text-white"><?php echo e($sportsEquipmentStored); ?></span>
                    </div>
                </div>
                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-700 dark:text-slate-300">Office - Assigned</span>
                        <span class="font-bold text-slate-900 dark:text-white"><?php echo e($officeEquipmentAssigned); ?></span>
                    </div>
                </div>
                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-700 dark:text-slate-300">Sports - Good Condition</span>
                        <span class="font-bold text-slate-900 dark:text-white"><?php echo e($sportsEquipmentInGoodCondition); ?></span>
                    </div>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-900">
                    <div class="flex justify-between items-center">
                        <span class="text-blue-700 dark:text-blue-300 font-medium">Warranty Expiring (30d)</span>
                        <span class="font-bold text-blue-600 dark:text-blue-400"><?php echo e($warrantyExpiringCount); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Equipment Needing Attention Alert -->
    <?php if(count($damageSportsEquipment) > 0 || count($damageOfficeEquipment) > 0): ?>
        <div class="mb-6 md:mb-8 bg-gradient-to-r from-red-50 to-amber-50 dark:from-red-900/20 dark:to-amber-900/20 rounded-lg shadow-md p-4 sm:p-5 md:p-6 border-l-4 border-red-500">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base sm:text-lg font-semibold text-red-900 dark:text-red-400 mb-2">Equipment Requiring Maintenance</h3>
                    <p class="text-xs sm:text-sm text-red-700 dark:text-red-300 mb-4"><?php echo e(count($damageSportsEquipment) + count($damageOfficeEquipment)); ?> items need immediate attention</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                        <?php if(count($damageSportsEquipment) > 0): ?>
                            <div class="bg-white dark:bg-slate-800/70 rounded p-3 sm:p-4 md:p-5 border border-red-200 dark:border-red-900">
                                <h4 class="font-semibold text-base sm:text-lg text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0"></span>
                                    <span class="truncate">Sports Equipment (<?php echo e(count($damageSportsEquipment)); ?>)</span>
                                </h4>
                                <div class="space-y-2">
                                    <?php $__currentLoopData = $damageSportsEquipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-start justify-between gap-2 text-xs sm:text-sm">
                                            <div class="min-w-0 flex-1">
                                                <p class="font-medium text-slate-900 dark:text-white truncate"><?php echo e($equipment->name); ?></p>
                                                <p class="text-slate-600 dark:text-slate-400 text-xs"><?php echo e($equipment->equipment_type); ?></p>
                                            </div>
                                            <a href="<?php echo e(route('admin.sports-equipment.edit', $equipment)); ?>" class="text-blue-600 dark:text-blue-400 hover:underline text-xs sm:text-xs whitespace-nowrap font-medium flex-shrink-0">Repair</a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(count($damageOfficeEquipment) > 0): ?>
                            <div class="bg-white dark:bg-slate-800/70 rounded p-3 sm:p-4 md:p-5 border border-red-200 dark:border-red-900">
                                <h4 class="font-semibold text-base sm:text-lg text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0"></span>
                                    <span class="truncate">Office Equipment (<?php echo e(count($damageOfficeEquipment)); ?>)</span>
                                </h4>
                                <div class="space-y-2">
                                    <?php $__currentLoopData = $damageOfficeEquipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-start justify-between gap-2 text-xs sm:text-sm">
                                            <div class="min-w-0 flex-1">
                                                <p class="font-medium text-slate-900 dark:text-white truncate"><?php echo e($equipment->name); ?></p>
                                                <p class="text-slate-600 dark:text-slate-400 text-xs"><?php echo e($equipment->assigned_to ?? 'Unassigned'); ?></p>
                                            </div>
                                            <a href="<?php echo e(route('admin.office-equipment.edit', $equipment)); ?>" class="text-blue-600 dark:text-blue-400 hover:underline text-xs sm:text-xs whitespace-nowrap font-medium flex-shrink-0">Repair</a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Recent Activity & Equipment Types -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
        <!-- Recent Updates -->
        <div class="space-y-4 sm:space-y-5 md:space-y-6">
            <!-- Recent Sports Equipment Updates -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6">
                <h3 class="text-base sm:text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 sm:h-6 bg-blue-500 rounded"></span>
                    <span>Recent Sports Equipment</span>
                </h3>
                <div class="space-y-2">
                    <?php $__empty_1 = true; $__currentLoopData = $recentSportsEquipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('admin.sports-equipment.show', $equipment)); ?>" class="block p-2 sm:p-3 bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition group">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-xs sm:text-sm text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition truncate"><?php echo e($equipment->name); ?></p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Updated <?php echo e($equipment->updated_at->diffForHumans()); ?></p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm text-center py-4">No equipment yet</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Office Equipment Updates -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6">
                <h3 class="text-base sm:text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 sm:h-6 bg-emerald-500 rounded"></span>
                    <span>Recent Office Equipment</span>
                </h3>
                <div class="space-y-2">
                    <?php $__empty_1 = true; $__currentLoopData = $recentOfficeEquipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('admin.office-equipment.show', $equipment)); ?>" class="block p-2 sm:p-3 bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition group">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-xs sm:text-sm text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition truncate"><?php echo e($equipment->name); ?></p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Updated <?php echo e($equipment->updated_at->diffForHumans()); ?></p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm text-center py-4">No equipment yet</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Equipment Types Breakdown -->
        <?php if($equipmentTypes->count() > 0): ?>
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6">
                <h3 class="text-base sm:text-lg font-semibold text-slate-900 dark:text-white mb-4 sm:mb-6 flex items-center gap-2">
                    <span class="w-1 h-5 sm:h-6 bg-indigo-500 rounded"></span>
                    <span>Equipment Types Distribution</span>
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4">
                    <?php $__currentLoopData = $equipmentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-800 rounded-lg p-3 sm:p-4 text-center border border-slate-200 dark:border-slate-700 hover:shadow-md transition">
                            <p class="text-2xl sm:text-3xl font-bold text-indigo-600 dark:text-indigo-400"><?php echo e($type->count); ?></p>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2 capitalize line-clamp-2"><?php echo e(str_replace('_', ' ', $type->equipment_type)); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6">
                <p class="text-slate-500 dark:text-slate-400 text-center text-sm">No equipment types recorded yet</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/kit-manager/dashboard2.blade.php ENDPATH**/ ?>