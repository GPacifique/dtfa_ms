<?php
    $editing = isset($event);
?>

<form action="<?php echo e($editing ? route('admin.upcoming-events.update', $event) : route('admin.upcoming-events.store')); ?>" method="POST" class="max-w-4xl mx-auto bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <!-- Status Badge -->
    <?php if($editing): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo e($event->status === 'upcoming' ? 'bg-blue-50 dark:bg-blue-900' : ($event->status === 'ongoing' ? 'bg-yellow-50 dark:bg-yellow-900' : ($event->status === 'completed' ? 'bg-green-50 dark:bg-green-900' : 'bg-red-50 dark:bg-red-900'))); ?>">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Event Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <?php if($event->status === 'upcoming'): ?>
                        📅 Upcoming - Event is scheduled
                    <?php elseif($event->status === 'ongoing'): ?>
                        🔴 Ongoing - Event is happening now
                    <?php elseif($event->status === 'completed'): ?>
                        ✅ Completed - Event has finished
                    <?php else: ?>
                        ❌ Cancelled - Event was cancelled
                    <?php endif; ?>
                </p>
            </div>
            <span class="px-4 py-2 rounded-full font-semibold <?php echo e($event->status === 'upcoming' ? 'bg-blue-200 text-blue-800' : ($event->status === 'ongoing' ? 'bg-yellow-200 text-yellow-800' : ($event->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'))); ?>">
                <?php echo e(ucfirst($event->status)); ?>

            </span>
        </div>
    </div>
    <?php endif; ?>

    <!-- Event Information -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📋 Event Details
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Event Name *</label>
            <input type="text" name="event_name" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., Annual Sports Championship" value="<?php echo e($editing ? $event->event_name : ''); ?>" required>
            <?php $__errorArgs = ['event_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Event Date *</label>
                <input type="date" name="date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $event->date?->format('Y-m-d') : ''); ?>" required>
                <?php $__errorArgs = ['date'];
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
                <input type="text" name="venue" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., National Stadium" value="<?php echo e($editing ? $event->venue : ''); ?>" required>
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
            <!-- Starting Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Starting Time *</label>
                <input type="time" name="starting_time" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $event->starting_time : ''); ?>" required>
                <?php $__errorArgs = ['starting_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Ending Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ending Time *</label>
                <input type="time" name="ending_time" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $event->ending_time : ''); ?>" required>
                <?php $__errorArgs = ['ending_time'];
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

    <!-- Content -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📝 Event Content
        </h2>

        <!-- Objective -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Objective of Event *</label>
            <textarea name="objective" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the main objective..." required><?php echo e($editing ? $event->objective : ''); ?></textarea>
            <?php $__errorArgs = ['objective'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Targeted Audience -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Targeted Audience *</label>
            <textarea name="targeted_audience" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the target audience..." required><?php echo e($editing ? $event->targeted_audience : ''); ?></textarea>
            <?php $__errorArgs = ['targeted_audience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- Organizers -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            👥 Event Organizers
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Coordinator Name *</label>
            <input type="text" name="coordinator_name" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Coordinator's full name" value="<?php echo e($editing ? $event->coordinator_name : ''); ?>" required>
            <?php $__errorArgs = ['coordinator_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Supporting Staff (one per line)</label>
            <textarea name="supporting_staff_names" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm" placeholder="Staff Name 1&#10;Staff Name 2&#10;Staff Name 3"><?php if($editing && $event->supporting_staff_names): ?><?php echo e(implode("\n", $event->supporting_staff_names)); ?><?php endif; ?></textarea>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Enter each staff member on a new line</p>
        </div>
    </div>

    <!-- Payment -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            💰 Payment Information
        </h2>

        <div class="flex items-center gap-4 mb-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_paid" class="rounded" <?php echo e($editing && $event->is_paid ? 'checked' : ''); ?>>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">This is a Paid Event</span>
            </label>
        </div>

        <div id="paymentFields" class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display: <?php echo e(($editing && $event->is_paid) || request('is_paid') ? 'grid' : 'none'); ?>;">
            <!-- Amount -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount</label>
                <input type="number" name="amount" step="0.01" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="0.00" value="<?php echo e($editing ? $event->amount : ''); ?>">
                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Currency -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Currency</label>
                <select name="currency" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="RWF" <?php echo e($editing && $event->currency === 'RWF' ? 'selected' : ''); ?>>RWF - Rwanda Franc</option>
                    <option value="USD" <?php echo e($editing && $event->currency === 'USD' ? 'selected' : ''); ?>>USD - US Dollar</option>
                    <option value="EUR" <?php echo e($editing && $event->currency === 'EUR' ? 'selected' : ''); ?>>EUR - Euro</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-between items-center">
        <a href="<?php echo e(route('admin.upcoming-events.index')); ?>" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            <?php echo e($editing ? '💾 Update Event' : '✅ Create Event'); ?>

        </button>
    </div>
</form>

<script>
    // Toggle payment fields based on checkbox
    document.querySelector('input[name="is_paid"]')?.addEventListener('change', function() {
        document.getElementById('paymentFields').style.display = this.checked ? 'grid' : 'none';
    });
</script>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\upcoming-events\_form.blade.php ENDPATH**/ ?>