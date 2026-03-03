<?php
    $editing = isset($minute);
?>

<form action="<?php echo e($editing ? route('admin.minutes.update', $minute) : route('admin.minutes.store')); ?>" method="POST" class="max-w-4xl mx-auto bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <!-- Status Badge -->
    <?php if($editing): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo e($minute->status === 'scheduled' ? 'bg-blue-50 dark:bg-blue-900' : ($minute->status === 'completed' ? 'bg-green-50 dark:bg-green-900' : 'bg-red-50 dark:bg-red-900')); ?>">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Minutes Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <?php if($minute->status === 'scheduled'): ?>
                        📅 Scheduled - Ready to be held
                    <?php elseif($minute->status === 'completed'): ?>
                        ✅ Completed - Minutes recorded
                    <?php else: ?>
                        ❌ Cancelled - Meeting was cancelled
                    <?php endif; ?>
                </p>
            </div>
            <span class="px-4 py-2 rounded-full font-semibold <?php echo e($minute->status === 'scheduled' ? 'bg-blue-200 text-blue-800' : ($minute->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')); ?>">
                <?php echo e(ucfirst($minute->status)); ?>

            </span>
        </div>
    </div>
    <?php endif; ?>

    <!-- Basic Information -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📋 Meeting Details
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Meeting Date *</label>
                <input type="date" name="date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $minute->date?->format('Y-m-d') : ''); ?>" required>
                <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Starting Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Starting Time *</label>
                <input type="time" name="starting_time" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $minute->starting_time : ''); ?>" required>
                <?php $__errorArgs = ['starting_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- End Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Time *</label>
                <input type="time" name="end_time" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $minute->end_time : ''); ?>" required>
                <?php $__errorArgs = ['end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Venue -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Venue *</label>
                <input type="text" name="venue" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., Conference Room A" value="<?php echo e($editing ? $minute->venue : ''); ?>" required>
                <?php $__errorArgs = ['venue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Chaired By -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Chaired By *</label>
                <input type="text" name="chaired_by" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Chairperson name" value="<?php echo e($editing ? $minute->chaired_by : ''); ?>" required>
                <?php $__errorArgs = ['chaired_by'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Note Taken By -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Note Taken By *</label>
                <input type="text" name="note_taken_by" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Secretary name" value="<?php echo e($editing ? $minute->note_taken_by : ''); ?>" required>
                <?php $__errorArgs = ['note_taken_by'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <!-- Attendance -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            👥 Attendance
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Attendance List -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Attendance List</label>
                <select name="attendance_list[]" multiple size="8" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm">
                    <?php $__currentLoopData = ($staffList ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $fullName = trim($staff->first_name . ' ' . $staff->last_name; ?>)
                        <option value="<?php echo e($fullName); ?>" <?php if($editing && in_array($fullName, $minute->attendance_list ?? [])): ?> selected <?php endif; ?>><?php echo e($fullName); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
            </div>

            <!-- Absent with Apology -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Absent with Apology</label>
                <select name="absent_apology[]" multiple size="8" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm">
                    <?php $__currentLoopData = ($staffList ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $fullName = trim($staff->first_name . ' ' . $staff->last_name; ?>)
                        <option value="<?php echo e($fullName); ?>" <?php if($editing && in_array($fullName, $minute->absent_apology ?? [])): ?> selected <?php endif; ?>><?php echo e($fullName); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
            </div>

            <!-- Absent without Apology -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Absent without Apology</label>
                <select name="absent_no_apology[]" multiple size="8" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm">
                    <?php $__currentLoopData = ($staffList ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $fullName = trim($staff->first_name . ' ' . $staff->last_name; ?>)
                        <option value="<?php echo e($fullName); ?>" <?php if($editing && in_array($fullName, $minute->absent_no_apology ?? [])): ?> selected <?php endif; ?>><?php echo e($fullName); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
            </div>
        </div>
    </div>

    <!-- Meeting Content -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📝 Meeting Content
        </h2>

        <!-- Agenda -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Agenda/Topics *</label>
            <textarea name="agenda" rows="5" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the topics discussed..." required><?php echo e($editing ? $minute->agenda : ''); ?></textarea>
            <?php $__errorArgs = ['agenda'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Resolution -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Resolution/Decisions</label>
            <textarea name="resolution" rows="5" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the resolutions and decisions made..."><?php echo e($editing ? $minute->resolution : ''); ?></textarea>
            <?php $__errorArgs = ['resolution'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Responsible Person -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Responsible Person (for follow-up)</label>
            <input type="text" name="responsible_person" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Name and contact" value="<?php echo e($editing ? $minute->responsible_person : ''); ?>">
            <?php $__errorArgs = ['responsible_person'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- Important Dates -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📅 Important Dates
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Start Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                <input type="date" name="start_date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $minute->start_date?->format('Y-m-d') : ''); ?>">
                <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Competition Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Competition Date</label>
                <input type="date" name="competition_date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $minute->competition_date?->format('Y-m-d') : ''); ?>">
                <?php $__errorArgs = ['competition_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-between items-center">
        <a href="<?php echo e(route('admin.minutes.index')); ?>" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            <?php echo e($editing ? '💾 update' : '✅ Save'); ?>

        </button>
    </div>
</form>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\minutes\_form.blade.php ENDPATH**/ ?>