<?php
    $editing = isset($activityPlan);
?>

<form action="<?php echo e($editing ? route('admin.activity-plans.update', $activityPlan) : route('admin.activity-plans.store')); ?>" method="POST" class="max-w-4xl mx-auto bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <!-- Status Badge -->
    <?php if($editing): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo e($activityPlan->status === 'red' ? 'bg-red-50 dark:bg-red-900' : ($activityPlan->status === 'yellow' ? 'bg-yellow-50 dark:bg-yellow-900' : 'bg-green-50 dark:bg-green-900')); ?>">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Plan Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <?php echo e($activityPlan->status === 'red' ? '🔴 Not Achieved - Plan targets not met' : ($activityPlan->status === 'yellow' ? '🟡 Ongoing - Plan in progress' : '🟢 Achieved - Plan completed successfully')); ?>

                </p>
            </div>
            <span class="px-4 py-2 rounded-full font-semibold <?php echo e($activityPlan->status === 'red' ? 'bg-red-200 text-red-800' : ($activityPlan->status === 'yellow' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800')); ?>">
                <?php echo e($activityPlan->status === 'red' ? 'Not Achieved' : ($activityPlan->status === 'yellow' ? 'Ongoing' : 'Achieved')); ?>

            </span>
        </div>
    </div>
    <?php endif; ?>

    <!-- Basic Information -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📋 Basic Information
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Year -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Year *</label>
                <input type="number" name="year" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" min="2000" max="2100" value="<?php echo e($editing ? $activityPlan->year : ''); ?>" required>
                <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Country -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country *</label>
                <select name="country" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                    <option value="">Select Country</option>
                    <option value="Rwanda" <?php echo e($editing && $activityPlan->country === 'Rwanda' ? 'selected' : ''); ?>>Rwanda</option>
                    <option value="Tanzania" <?php echo e($editing && $activityPlan->country === 'Tanzania' ? 'selected' : ''); ?>>Tanzania</option>
                </select>
                <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Challenge *</label>
            <input type="text" name="challenge" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the challenge" value="<?php echo e($editing ? $activityPlan->challenge : ''); ?>" required>
            <?php $__errorArgs = ['challenge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Opportunity *</label>
            <input type="text" name="opportunity" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the opportunity" value="<?php echo e($editing ? $activityPlan->opportunity : ''); ?>" required>
            <?php $__errorArgs = ['opportunity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Baseline *</label>
            <textarea name="baseline" rows="3" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Current baseline situation" required><?php echo e($editing ? $activityPlan->baseline : ''); ?></textarea>
            <?php $__errorArgs = ['baseline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- Intervention & Objectives -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            🎯 Intervention & Objectives
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Intervention/Objective *</label>
            <textarea name="intervention_objective" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the intervention and objectives" required><?php echo e($editing ? $activityPlan->intervention_objective : ''); ?></textarea>
            <?php $__errorArgs = ['intervention_objective'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">List of Activities (one per line) *</label>
            <textarea name="list_of_activities" rows="5" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm font-mono" placeholder="Activity 1&#10;Activity 2&#10;Activity 3" required><?php if($editing && $activityPlan->list_of_activities): ?><?php echo e(implode("\n", $activityPlan->list_of_activities)); ?><?php endif; ?></textarea>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Enter each activity on a new line</p>
            <?php $__errorArgs = ['list_of_activities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Key Performance Indicator (KPI) *</label>
            <input type="text" name="kpi" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., 80% of activities completed by Q4" value="<?php echo e($editing ? $activityPlan->kpi : ''); ?>" required>
            <?php $__errorArgs = ['kpi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- Responsible Person & Focus Area -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            👥 Accountability & Focus
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Responsible Person (Staff Member) *</label>
            <select name="responsible_person_id" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                <option value="">Select Staff Member</option>
                <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($person->id); ?>" <?php echo e($editing && $activityPlan->responsible_person_id === $person->id ? 'selected' : ''); ?>>
                        <?php echo e($person->name ?? $person->email); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['responsible_person_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Focus Area *</label>
            <select name="focus_area" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                <option value="">Select Focus Area</option>
                <?php $__currentLoopData = $focusAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($area); ?>" <?php echo e($editing && $activityPlan->focus_area === $area ? 'selected' : ''); ?>>
                        <?php echo e($area); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['focus_area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- Timeline & Cost -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📅 Timeline & Budget
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Starting Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Starting Date *</label>
                <input type="date" name="starting_date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $activityPlan->starting_date->format('Y-m-d') : ''); ?>" required>
                <?php $__errorArgs = ['starting_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Ending Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ending Date *</label>
                <input type="date" name="ending_date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="<?php echo e($editing ? $activityPlan->ending_date->format('Y-m-d') : ''); ?>" required>
                <?php $__errorArgs = ['ending_date'];
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
            <!-- Cost -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Budget Cost *</label>
                <input type="number" name="cost" step="0.01" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="0.00" value="<?php echo e($editing ? $activityPlan->cost : ''); ?>" required>
                <?php $__errorArgs = ['cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Financing Mechanism -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Financing Mechanism *</label>
                <input type="text" name="financing_mechanism" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., Government Budget, Donor Funds, Self-funding" value="<?php echo e($editing ? $activityPlan->financing_mechanism : ''); ?>" required>
                <?php $__errorArgs = ['financing_mechanism'];
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

    <!-- Status Remarks -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📝 Additional Remarks
        </h2>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status Remarks (Optional)</label>
            <textarea name="status_remarks" rows="3" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Add any relevant notes about the plan's progress or challenges..."><?php echo e($editing ? $activityPlan->status_remarks : ''); ?></textarea>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-between items-center">
        <a href="<?php echo e(route('admin.activity-plans.index')); ?>" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            <?php echo e($editing ? '💾 Update Plan' : '✅ Create Plan'); ?>

        </button>
    </div>
</form>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\activity-plans\_form.blade.php ENDPATH**/ ?>