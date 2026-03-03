<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Meeting Minutes','subtitle' => ''.e($minute->date?->format('l, F d, Y')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Meeting Minutes','subtitle' => ''.e($minute->date?->format('l, F d, Y')).'']); ?>
        <a href="<?php echo e(route('admin.minutes.index')); ?>" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">← Back to Minutes</a>
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
<div class="max-w-7xl mx-auto p-6">


    <!-- Status Badge and Actions -->
    <div class="mb-6 p-4 rounded-lg <?php echo e($minute->status === 'scheduled' ? 'bg-blue-50 dark:bg-blue-900' : ($minute->status === 'completed' ? 'bg-green-50 dark:bg-green-900' : 'bg-red-50 dark:bg-red-900')); ?>">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Meeting Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <?php if($minute->status === 'scheduled'): ?>
                        📅 Scheduled - Meeting to be held
                    <?php elseif($minute->status === 'completed'): ?>
                        ✅ Completed - Minutes recorded
                    <?php else: ?>
                        ❌ Cancelled - Meeting was cancelled
                    <?php endif; ?>
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-full font-semibold <?php echo e($minute->status === 'scheduled' ? 'bg-blue-200 text-blue-800' : ($minute->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')); ?>">
                    <?php echo e(ucfirst($minute->status)); ?>

                </span>

                <?php if($minute->isScheduled()): ?>
                <form action="<?php echo e(route('admin.minutes.markCompleted', $minute)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition">
                        ✅ Mark Completed
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Meeting Details -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Meeting Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Date</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e($minute->date?->format('F d, Y')); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Time</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e($minute->starting_time); ?> - <?php echo e($minute->end_time); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Venue</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e($minute->venue); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Duration</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e(\Carbon\Carbon::parse($minute->starting_time)->diff(\Carbon\Carbon::parse($minute->end_time))->format('%H:%I')); ?> hours</p>
                    </div>
                </div>
            </div>

            <!-- Participants -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Participants</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Chaired By</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e($minute->chaired_by); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Note Taken By</p>
                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e($minute->note_taken_by); ?></p>
                    </div>
                </div>
            </div>

            <!-- Attendance -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Attendance</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Present -->
                    <div class="p-4 bg-green-50 dark:bg-green-900 rounded-lg">
                        <h3 class="font-semibold text-green-900 dark:text-green-200 mb-2">✓ Present</h3>
                        <ul class="text-sm text-green-800 dark:text-green-300">
                            <?php if($minute->attendance_list && count($minute->attendance_list) > 0): ?>
                                <?php $__currentLoopData = $minute->attendance_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($name); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li class="text-gray-600 dark:text-gray-400">No attendees recorded</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Absent with Apology -->
                    <div class="p-4 bg-yellow-50 dark:bg-yellow-900 rounded-lg">
                        <h3 class="font-semibold text-yellow-900 dark:text-yellow-200 mb-2">📝 Absent (with apology)</h3>
                        <ul class="text-sm text-yellow-800 dark:text-yellow-300">
                            <?php if($minute->absent_apology && count($minute->absent_apology) > 0): ?>
                                <?php $__currentLoopData = $minute->absent_apology; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($name); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li class="text-gray-600 dark:text-gray-400">None</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Absent without Apology -->
                    <div class="p-4 bg-red-50 dark:bg-red-900 rounded-lg">
                        <h3 class="font-semibold text-red-900 dark:text-red-200 mb-2">✗ Absent (without apology)</h3>
                        <ul class="text-sm text-red-800 dark:text-red-300">
                            <?php if($minute->absent_no_apology && count($minute->absent_no_apology) > 0): ?>
                                <?php $__currentLoopData = $minute->absent_no_apology; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($name); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li class="text-gray-600 dark:text-gray-400">None</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Agenda -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📋 Agenda/Topics</h2>
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap"><?php echo e($minute->agenda); ?></p>
            </div>

            <!-- Resolution -->
            <?php if($minute->resolution): ?>
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">✅ Resolution/Decisions</h2>
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap"><?php echo e($minute->resolution); ?></p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Important Dates -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">📅 Important Dates</h2>
                <?php if($minute->start_date): ?>
                <div class="mb-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Start Date</p>
                    <p class="font-medium text-gray-900 dark:text-white"><?php echo e($minute->start_date?->format('F d, Y')); ?></p>
                </div>
                <?php endif; ?>
                <?php if($minute->competition_date): ?>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Competition Date</p>
                    <p class="font-medium text-gray-900 dark:text-white"><?php echo e($minute->competition_date?->format('F d, Y')); ?></p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Responsible Person -->
            <?php if($minute->responsible_person): ?>
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">👤 Responsible Person</h2>
                <p class="text-gray-700 dark:text-gray-300"><?php echo e($minute->responsible_person); ?></p>
            </div>
            <?php endif; ?>

            <!-- Actions -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Actions</h2>
                <div class="space-y-2">
                    <a href="<?php echo e(route('admin.minutes.edit', $minute)); ?>" class="block w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium text-center transition">
                        ✏️ Edit
                    </a>
                    <form action="<?php echo e(route('admin.minutes.destroy', $minute)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition" onclick="return confirm('Delete these minutes?');">
                            🗑️ Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\minutes\show.blade.php ENDPATH**/ ?>