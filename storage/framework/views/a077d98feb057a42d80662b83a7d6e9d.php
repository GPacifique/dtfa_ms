<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Create Communication</h1>
            <a href="<?php echo e(route('staff.communications.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                ← Back
            </a>
        </div>

        <form action="<?php echo e(route('staff.communications.store')); ?>" method="POST" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6 space-y-6">
            <?php echo csrf_field(); ?>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" required placeholder="Communication title" value="<?php echo e(old('title')); ?>" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Body -->
            <div>
                <label for="body" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Message <span class="text-red-500">*</span></label>
                <textarea id="body" name="body" required rows="6" placeholder="Write your communication message..." class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-vertical font-mono text-sm"><?php echo e(old('body')); ?></textarea>
                <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Minutes -->
            <div>
                <label for="minutes" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meeting Minutes (Optional)</label>
                <textarea id="minutes" name="minutes" rows="4" placeholder="Add meeting minutes if applicable..." class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-vertical font-mono text-sm"><?php echo e(old('minutes')); ?></textarea>
                <?php $__errorArgs = ['minutes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Activity Type -->
            <div>
                <label for="activity_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Activity Type (Optional)</label>
                <select id="activity_type" name="activity_type" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Select activity type</option>
                    <option value="training">Training</option>
                    <option value="meeting">Meeting</option>
                    <option value="announcement">Announcement</option>
                    <option value="update">Update</option>
                    <option value="other">Other</option>
                </select>
                <?php $__errorArgs = ['activity_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Audience -->
            <div>
                <label for="audience" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Send To <span class="text-red-500">*</span></label>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="audience" value="staff" checked class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-slate-700 dark:text-slate-300">Staff Only</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="audience" value="all" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-slate-700 dark:text-slate-300">All Users & Staff</span>
                    </label>
                </div>
                <?php $__errorArgs = ['audience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Options -->
            <div class="flex items-center gap-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="send_now" value="1" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-slate-700 dark:text-slate-300">Send immediately</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex gap-2 pt-2">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                    📤 Send
                </button>
                <a href="<?php echo e(route('staff.communications.index')); ?>" class="inline-flex items-center gap-2 px-6 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\staff\communications\create.blade.php ENDPATH**/ ?>