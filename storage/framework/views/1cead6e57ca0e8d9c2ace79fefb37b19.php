<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-4xl font-bold text-slate-900 dark:text-white">➕ Create Training Session</h1>
        <a href="<?php echo e(route('coach.sessions.index')); ?>" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 font-semibold transition">

        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-8">
        <form method="POST" action="<?php echo e(route('coach.sessions.store')); ?>" class="space-y-8">
            <?php echo csrf_field(); ?>

            <!-- Date & Time Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📅 Schedule</h2>
                <div class="space-y-6">
                    <div>
                        <label for="date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Date *</label>
                        <input type="date" name="date" id="date" value="<?php echo e(old('date', now()->format('Y-m-d'))); ?>" required
                               class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_time" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Start Time *</label>
                            <input type="time" name="start_time" id="start_time" value="<?php echo e(old('start_time')); ?>" required
                                   class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">End Time *</label>
                            <input type="time" name="end_time" id="end_time" value="<?php echo e(old('end_time')); ?>" required
                                   class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <?php $__errorArgs = ['end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location & Group Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📍 Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="location" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Location *</label>
                        <input type="text" name="location" id="location" value="<?php echo e(old('location', $branch->name ?? '')); ?>" required
                               class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="group_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Group *</label>
                        <select name="group_id" id="group_id" required
                                class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">-- Select a group --</option>
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($group->id); ?>" <?php echo e(old('group_id') == $group->id ? 'selected' : ''); ?>>
                                    <?php echo e($group->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['group_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Training Days Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📆 Training Days</h2>
                <div class="grid grid-cols-4 md:grid-cols-7 gap-3">
                    <?php $__currentLoopData = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex flex-col items-center gap-2 cursor-pointer p-3 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition">
                            <input type="checkbox" name="training_days[]" value="<?php echo e($day); ?>" <?php echo e(in_array($day, old('training_days', [])) ? 'checked' : ''); ?>

                                   class="rounded border-slate-300 dark:border-slate-600 text-indigo-600 dark:bg-slate-700 focus:ring-indigo-500">
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300"><?php echo e(substr($day, 0, 3)); ?></span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['training_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                <button type="submit" class="px-8 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition">
                    ✓ Create Session
                </button>
                <a href="<?php echo e(route('coach.sessions.index')); ?>" class="px-8 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-semibold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\coach\sessions\create.blade.php ENDPATH**/ ?>