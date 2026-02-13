<?php $__env->startSection('hero'); ?>
    <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 shadow-lg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative py-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-1">
                    <h1 class="text-4xl font-bold text-white mb-2">🎓 <?php echo e($inhousetraining->training_name); ?></h1>
                    <p class="text-pink-100">Complete training information and participant details</p>
                </div>
                <div class="mt-6 sm:mt-0 flex gap-3">
                    <a href="<?php echo e(route('admin.inhousetrainings.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white text-purple-700 border-2 border-white rounded-lg text-sm font-semibold hover:bg-purple-50 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back
                    </a>
                    <a href="<?php echo e(route('admin.inhousetrainings.edit', $inhousetraining->id)); ?>" class="inline-flex items-center px-4 py-2 bg-yellow-400 text-yellow-900 rounded-lg text-sm font-semibold hover:bg-yellow-300 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Quick Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Participant Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-5 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider">Participant</p>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?php echo e($inhousetraining->first_name ?? 'N/A'); ?></p>
                    </div>
                    <svg class="w-8 h-8 text-blue-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                </div>
            </div>

            <!-- Training Category Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-5 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider">Category</p>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?php echo e($inhousetraining->training_category ?? 'N/A'); ?></p>
                    </div>
                    <svg class="w-8 h-8 text-green-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 3.062v6.218c0 1.126-.694 2.107-1.675 2.53a5.396 5.396 0 01-1.677.86 3.07 3.07 0 01-.464.045 3.064 3.064 0 01-1.257-.256 3.06 3.06 0 01-2.675-3V6.517c0-.927-.6-1.726-1.433-2.012A3.066 3.066 0 006.267 3.455z" clip-rule="evenodd"></path></svg>
                </div>
            </div>

            <!-- Cost Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-5 border-l-4 border-amber-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider">Cost</p>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?php echo e($inhousetraining->cost ?? 'N/A'); ?></p>
                    </div>
                    <svg class="w-8 h-8 text-amber-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M8.16 5a.5.5 0 00-.496.574l.847 4.232H5.5a.5.5 0 00-.493.575l.848 4.231h2.016l-.847-4.231h2.016l.847 4.231h2.016l-.848-4.231h2.336a.5.5 0 00.493-.575l-.848-4.231H10.5a.5.5 0 00.496-.574L10.149 5H8.16z"></path></svg>
                </div>
            </div>

            <!-- Trainer Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-5 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider">Trainer</p>
                        <p class="text-lg font-bold text-gray-900 mt-1 truncate"><?php echo e($inhousetraining->trainer_name ?? 'N/A'); ?></p>
                    </div>
                    <svg class="w-8 h-8 text-purple-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Participant Information Section -->
        <div class="bg-white rounded-lg shadow-md mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                    Participant Information
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">First Name</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->first_name ?? '—'); ?></p>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Second Name</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->second_name ?? '—'); ?></p>
                </div>
                <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Gender</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->gender ?? '—'); ?></p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Role</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->role->name ?? '—'); ?></p>
                </div>
            </div>
        </div>

        <!-- Location & Discipline Section -->
        <div class="bg-white rounded-lg shadow-md mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    Location & Discipline
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Country</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->country ?? '—'); ?></p>
                </div>
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">City</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->city ?? '—'); ?></p>
                </div>
                <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Discipline</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->discipline ?? '—'); ?></p>
                </div>
                <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Branch</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->branch->name ?? '—'); ?></p>
                </div>
            </div>
        </div>

        <!-- Training Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Training Category & Cost -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 3.062v6.218c0 1.126-.694 2.107-1.675 2.53a5.396 5.396 0 01-1.677.86 3.07 3.07 0 01-.464.045 3.064 3.064 0 01-1.257-.256 3.06 3.06 0 01-2.675-3V6.517c0-.927-.6-1.726-1.433-2.012A3.066 3.066 0 006.267 3.455z" clip-rule="evenodd"></path></svg>
                            Category & Cost
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Training Category</p>
                            <span class="inline-block px-4 py-2 text-sm font-bold rounded-full <?php echo e($inhousetraining->training_category === 'In house' ? 'bg-green-100 text-green-800 border-2 border-green-400' : 'bg-blue-100 text-blue-800 border-2 border-blue-400'); ?>">
                                <?php echo e($inhousetraining->training_category ?? '—'); ?>

                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Cost Status</p>
                            <span class="inline-block px-4 py-2 text-sm font-bold rounded-full <?php echo e($inhousetraining->cost === 'Free' ? 'bg-emerald-100 text-emerald-800 border-2 border-emerald-400' : 'bg-amber-100 text-amber-800 border-2 border-amber-400'); ?>">
                                <?php echo e($inhousetraining->cost ?? '—'); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <!-- Channel & Venue -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path></svg>
                            Delivery & Venue
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Channel</p>
                            <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->channel ?? '—'); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Venue</p>
                            <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->venue ?? '—'); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Location</p>
                            <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->location ?? '—'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Training Dates -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path></svg>
                            Training Timeline
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="bg-rose-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 font-semibold mb-1">Training Date</p>
                            <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->training_date?->format('M d, Y') ?? '—'); ?></p>
                        </div>
                        <div class="bg-pink-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 font-semibold mb-1">Start Date & Time</p>
                            <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->start?->format('M d, Y H:i') ?? '—'); ?></p>
                        </div>
                        <div class="bg-rose-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 font-semibold mb-1">End Date & Time</p>
                            <p class="text-lg font-bold text-gray-900"><?php echo e($inhousetraining->end?->format('M d, Y H:i') ?? '—'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Trainer Info -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-violet-500 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                            Trainer Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-violet-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 font-semibold mb-2">Trainer Name</p>
                            <p class="text-xl font-bold text-gray-900"><?php echo e($inhousetraining->trainer_name ?? '—'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        <?php if($inhousetraining->notes): ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-4">
                <h3 class="text-lg font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h1a1 1 0 000-2h-.5A2.5 2.5 0 013 7.5V17a2 2 0 002 2h6a2 2 0 002-2v-2.1a2 2 0 100-4V7.5A2.5 2.5 0 013.5 5H4zm6 4a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                    Additional Notes
                </h3>
            </div>
            <div class="p-6">
                <div class="bg-cyan-50 p-4 rounded-lg border-l-4 border-cyan-500">
                    <p class="text-gray-900 text-base whitespace-pre-wrap"><?php echo e($inhousetraining->notes); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Timestamps Footer -->
        <div class="bg-gradient-to-r from-gray-700 to-gray-800 rounded-lg shadow-md p-6 text-white">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-gray-300 text-sm font-semibold uppercase mb-1">Created</p>
                    <p class="text-lg font-bold"><?php echo e($inhousetraining->created_at?->format('M d, Y') ?? '—'); ?></p>
                    <p class="text-xs text-gray-400"><?php echo e($inhousetraining->created_at?->format('H:i') ?? '—'); ?></p>
                </div>
                <div>
                    <p class="text-gray-300 text-sm font-semibold uppercase mb-1">Updated</p>
                    <p class="text-lg font-bold"><?php echo e($inhousetraining->updated_at?->format('M d, Y') ?? '—'); ?></p>
                    <p class="text-xs text-gray-400"><?php echo e($inhousetraining->updated_at?->format('H:i') ?? '—'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/inhousetrainings/show.blade.php ENDPATH**/ ?>