<?php $__env->startSection('hero'); ?>
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 shadow-lg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative py-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-1">
                    <h1 class="text-4xl font-bold text-white mb-2">Training Session Details</h1>
                    <p class="text-blue-100">Review comprehensive recorded session information</p>
                </div>
                <div class="mt-6 sm:mt-0 flex gap-3">
                    <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white text-blue-700 border-2 border-white rounded-lg text-sm font-semibold hover:bg-blue-50 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back
                    </a>
                    <a href="<?php echo e(route('admin.training_session_records.edit', $trainingSessionRecord)); ?>" class="inline-flex items-center px-4 py-2 bg-yellow-400 text-yellow-900 rounded-lg text-sm font-semibold hover:bg-yellow-300 transition duration-200">
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
            <!-- Date Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-5 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider">Date</p>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?php echo e(optional($trainingSessionRecord->date)->format('M d, Y') ?? 'N/A'); ?></p>
                    </div>
                    <svg class="w-8 h-8 text-blue-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path></svg>
                </div>
            </div>

            <!-- Time Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-5 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider">Duration</p>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?php echo e($trainingSessionRecord->start_time); ?> — <?php echo e($trainingSessionRecord->finish_time); ?></p>
                    </div>
                    <svg class="w-8 h-8 text-green-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"></path></svg>
                </div>
            </div>

            <!-- Coach Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-5 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider">Coach</p>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?php echo e($trainingSessionRecord->coach_name); ?></p>
                    </div>
                    <svg class="w-8 h-8 text-purple-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>
            </div>

            <!-- Participants Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-5 border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider">Participants</p>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?php echo e($trainingSessionRecord->number_of_kids); ?></p>
                    </div>
                    <svg class="w-8 h-8 text-orange-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M13 7H7v6h6V7z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Location & Details Section -->
        <div class="bg-white rounded-lg shadow-md mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    Location & Session Details
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Branch / Pitch</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($trainingSessionRecord->branch); ?> — <?php echo e($trainingSessionRecord->training_pitch); ?></p>
                    <?php if($trainingSessionRecord->other_training_pitch): ?>
                        <p class="text-sm text-gray-600 mt-2 italic">(<?php echo e($trainingSessionRecord->other_training_pitch); ?>)</p>
                    <?php endif; ?>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Country / City</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($trainingSessionRecord->country); ?> — <?php echo e($trainingSessionRecord->city); ?></p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Sport Discipline</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($trainingSessionRecord->sport_discipline); ?></p>
                </div>
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1">Area of Performance</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($trainingSessionRecord->area_performance); ?></p>
                </div>
            </div>
        </div>

        <!-- Training Days Section -->
        <?php if($trainingSessionRecord->training_days && count($trainingSessionRecord->training_days) > 0): ?>
        <div class="bg-white rounded-lg shadow-md mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h1a1 1 0 000-2h-.5A2.5 2.5 0 013 7.5V17a2 2 0 002 2h6a2 2 0 002-2v-2.1a2 2 0 100-4V7.5A2.5 2.5 0 013.5 5H4zm6 4a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                    Training Schedule
                </h2>
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-2">
                    <?php $__currentLoopData = $trainingSessionRecord->training_days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-cyan-100 text-cyan-800 border border-cyan-300">
                            <?php echo e($day); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Training Objective & Main Topic -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.25l4 6a1 1 0 110 1.5l-4 6a1 1 0 11-1.932-.5L14.6 9l-3.6-5.25a1 1 0 01.632-1.25z" clip-rule="evenodd"></path></svg>
                        Training Objective
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-800 text-base leading-relaxed whitespace-pre-wrap"><?php echo e($trainingSessionRecord->training_objective); ?></p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        Main Topic
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-800 text-base font-semibold"><?php echo e($trainingSessionRecord->main_topic); ?></p>
                </div>
            </div>
        </div>

        <!-- Training Parts Section -->
        <div class="space-y-8">
            <!-- Part 1 - Introduction -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-600 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-white bg-opacity-30 mr-3 text-white font-bold text-sm">1</span>
                        Introduction
                    </h2>
                </div>
                <div class="p-6">
                    <?php if($trainingSessionRecord->part1_a1_desc || $trainingSessionRecord->part1_a2_desc || $trainingSessionRecord->part1_a3_desc): ?>
                        <div class="space-y-3">
                            <?php if($trainingSessionRecord->part1_a1_desc): ?>
                                <div class="flex gap-4 pb-3 border-b border-gray-200">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-sm">A1</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium"><?php echo e($trainingSessionRecord->part1_a1_desc); ?></p>
                                        <?php if($trainingSessionRecord->part1_a1_time): ?>
                                            <p class="text-sm text-gray-500 mt-1">⏱ <?php echo e($trainingSessionRecord->part1_a1_time); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($trainingSessionRecord->part1_a2_desc): ?>
                                <div class="flex gap-4 pb-3 border-b border-gray-200">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-sm">A2</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium"><?php echo e($trainingSessionRecord->part1_a2_desc); ?></p>
                                        <?php if($trainingSessionRecord->part1_a2_time): ?>
                                            <p class="text-sm text-gray-500 mt-1">⏱ <?php echo e($trainingSessionRecord->part1_a2_time); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($trainingSessionRecord->part1_a3_desc): ?>
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-sm">A3</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium"><?php echo e($trainingSessionRecord->part1_a3_desc); ?></p>
                                        <?php if($trainingSessionRecord->part1_a3_time): ?>
                                            <p class="text-sm text-gray-500 mt-1">⏱ <?php echo e($trainingSessionRecord->part1_a3_time); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if($trainingSessionRecord->part1_activities): ?>
                            <div class="mt-4 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                <p class="text-sm text-gray-600 uppercase font-semibold mb-2">Activities</p>
                                <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($trainingSessionRecord->part1_activities); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($trainingSessionRecord->part1_activities); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Part 2 - Main Topic -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-white bg-opacity-30 mr-3 text-white font-bold text-sm">2</span>
                        Main Training
                    </h2>
                </div>
                <div class="p-6">
                    <?php if($trainingSessionRecord->part2_a1_desc || $trainingSessionRecord->part2_a2_desc || $trainingSessionRecord->part2_a3_desc): ?>
                        <div class="space-y-3">
                            <?php if($trainingSessionRecord->part2_a1_desc): ?>
                                <div class="flex gap-4 pb-3 border-b border-gray-200">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <span class="text-green-600 font-semibold text-sm">A1</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium"><?php echo e($trainingSessionRecord->part2_a1_desc); ?></p>
                                        <?php if($trainingSessionRecord->part2_a1_time): ?>
                                            <p class="text-sm text-gray-500 mt-1">⏱ <?php echo e($trainingSessionRecord->part2_a1_time); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($trainingSessionRecord->part2_a2_desc): ?>
                                <div class="flex gap-4 pb-3 border-b border-gray-200">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <span class="text-green-600 font-semibold text-sm">A2</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium"><?php echo e($trainingSessionRecord->part2_a2_desc); ?></p>
                                        <?php if($trainingSessionRecord->part2_a2_time): ?>
                                            <p class="text-sm text-gray-500 mt-1">⏱ <?php echo e($trainingSessionRecord->part2_a2_time); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($trainingSessionRecord->part2_a3_desc): ?>
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <span class="text-green-600 font-semibold text-sm">A3</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium"><?php echo e($trainingSessionRecord->part2_a3_desc); ?></p>
                                        <?php if($trainingSessionRecord->part2_a3_time): ?>
                                            <p class="text-sm text-gray-500 mt-1">⏱ <?php echo e($trainingSessionRecord->part2_a3_time); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if($trainingSessionRecord->part2_activities): ?>
                            <div class="mt-4 p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                                <p class="text-sm text-gray-600 uppercase font-semibold mb-2">Activities</p>
                                <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($trainingSessionRecord->part2_activities); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($trainingSessionRecord->part2_activities); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Part 3 - Notes -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-white bg-opacity-30 mr-3 text-white font-bold text-sm">3</span>
                        Notes & Observations
                    </h2>
                </div>
                <div class="p-6">
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($trainingSessionRecord->part3_notes); ?></p>
                    </div>
                </div>
            </div>

            <!-- Part 4 - Message -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="bg-gradient-to-r from-pink-500 to-rose-600 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-white bg-opacity-30 mr-3 text-white font-bold text-sm">4</span>
                        Message & Feedback
                    </h2>
                </div>
                <div class="p-6">
                    <div class="p-4 bg-pink-50 rounded-lg">
                        <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($trainingSessionRecord->part4_message); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Incidents & Equipment Section -->
        <?php if($trainingSessionRecord->incident_report || $trainingSessionRecord->missed_damaged_equipment): ?>
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
            <?php if($trainingSessionRecord->incident_report): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-red-500">
                <div class="bg-gradient-to-r from-red-500 to-rose-600 px-6 py-4">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Incident Report
                    </h2>
                </div>
                <div class="p-6">
                    <div class="p-4 bg-red-50 rounded-lg">
                        <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($trainingSessionRecord->incident_report); ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($trainingSessionRecord->missed_damaged_equipment): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-orange-500">
                <div class="bg-gradient-to-r from-orange-500 to-amber-600 px-6 py-4">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.25l4 6a1 1 0 110 1.5l-4 6a1 1 0 11-1.932-.5L14.6 9l-3.6-5.25a1 1 0 01.632-1.25z" clip-rule="evenodd"></path></svg>
                        Equipment Issues
                    </h2>
                </div>
                <div class="p-6">
                    <div class="p-4 bg-orange-50 rounded-lg">
                        <p class="text-gray-800 whitespace-pre-wrap"><?php echo e($trainingSessionRecord->missed_damaged_equipment); ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/training_session_records/show.blade.php ENDPATH**/ ?>