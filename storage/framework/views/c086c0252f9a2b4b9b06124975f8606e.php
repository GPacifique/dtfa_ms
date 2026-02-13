<?php
    $isEdit = isset($trainingSessionRecord) && $trainingSessionRecord->exists;
    $old = fn($k, $default='') => old($k, $isEdit ? ($trainingSessionRecord->$k ?? $default) : $default);
?>

<div class="grid grid-cols-1 gap-6">
    
    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
        <h2 class="text-lg font-bold text-blue-900 dark:text-blue-300 mb-6">🎯 Training Objectives</h2>

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Main Topic</label>
                <input type="text" name="main_topic" value="<?php echo e($old('main_topic')); ?>" placeholder="e.g., Passing techniques, Ball control" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Area of Performance</label>
                <select name="area_performance" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select area --</option>
                    <option value="Physical" <?php echo e(old('area_performance', $isEdit ? ($trainingSessionRecord->area_performance ?? '') : '') === 'Physical' ? 'selected' : ''); ?>>Physical</option>
                    <option value="Technical" <?php echo e(old('area_performance', $isEdit ? ($trainingSessionRecord->area_performance ?? '') : '') === 'Technical' ? 'selected' : ''); ?>>Technical</option>
                    <option value="Tactical" <?php echo e(old('area_performance', $isEdit ? ($trainingSessionRecord->area_performance ?? '') : '') === 'Tactical' ? 'selected' : ''); ?>>Tactical</option>
                    <option value="Mental" <?php echo e(old('area_performance', $isEdit ? ($trainingSessionRecord->area_performance ?? '') : '') === 'Mental' ? 'selected' : ''); ?>>Mental</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Training Objective</label>
                <textarea name="training_objective" rows="3" placeholder="Describe the training objectives for this session" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"><?php echo e($old('training_objective')); ?></textarea>
            </div>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" name="date" value="<?php echo e($old('date')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Start Time</label>
            <input type="time" name="start_time" value="<?php echo e($old('start_time')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Finish Time</label>
            <input type="time" name="finish_time" value="<?php echo e($old('finish_time')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Coach</label>
        <?php if(!empty($coaches) && count($coaches)): ?>
            <select name="coach_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Select coach --</option>
                <?php $__currentLoopData = $coaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($c->id); ?>" <?php echo e((int)old('coach_id', $isEdit ? ($trainingSessionRecord->coach_id ?? '') : '') === $c->id ? 'selected' : ''); ?>><?php echo e($c->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        <?php else: ?>
            <input type="text" name="coach_name" value="<?php echo e($old('coach_name')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            <p class="text-xs text-gray-500">No coaches found — enter a name manually.</p>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Branch</label>
            <?php if(!empty($branches) && count($branches)): ?>
                <select name="branch" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">-- Select branch --</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($b); ?>" <?php echo e(old('branch', $isEdit ? ($trainingSessionRecord->branch ?? '') : '') === $b ? 'selected' : ''); ?>><?php echo e($b); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <?php else: ?>
                <input type="text" name="branch" value="<?php echo e($old('branch')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            <?php endif; ?>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Training Pitch</label>
            <?php if(!empty($pitches) && count($pitches)): ?>
                <select name="training_pitch" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">-- Select pitch --</option>
                    <?php $__currentLoopData = $pitches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p); ?>" <?php echo e(old('training_pitch', $isEdit ? ($trainingSessionRecord->training_pitch ?? '') : '') === $p ? 'selected' : ''); ?>><?php echo e($p); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <?php else: ?>
                <input type="text" name="training_pitch" value="<?php echo e($old('training_pitch')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Country</label>
            <select name="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Select country --</option>
                <option value="Rwanda" <?php echo e(old('country', $isEdit ? ($trainingSessionRecord->country ?? '') : '') === 'Rwanda' ? 'selected' : ''); ?>>Rwanda</option>
                <option value="Tanzania" <?php echo e(old('country', $isEdit ? ($trainingSessionRecord->country ?? '') : '') === 'Tanzania' ? 'selected' : ''); ?>>Tanzania</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">City</label>
            <select name="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Select city --</option>
                <option value="Kigali" <?php echo e(old('city', $isEdit ? ($trainingSessionRecord->city ?? '') : '') === 'Kigali' ? 'selected' : ''); ?>>Kigali</option>
                <option value="Mwanza" <?php echo e(old('city', $isEdit ? ($trainingSessionRecord->city ?? '') : '') === 'Mwanza' ? 'selected' : ''); ?>>Mwanza</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Sport Discipline</label>
            <select name="sport_discipline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Select discipline --</option>
                <option value="Football" <?php echo e(old('sport_discipline', $isEdit ? ($trainingSessionRecord->sport_discipline ?? '') : '') === 'Football' ? 'selected' : ''); ?>>Football</option>
                <option value="Basketball" <?php echo e(old('sport_discipline', $isEdit ? ($trainingSessionRecord->sport_discipline ?? '') : '') === 'Basketball' ? 'selected' : ''); ?>>Basketball</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Other Training Pitch</label>
            <input type="text" name="other_training_pitch" value="<?php echo e($old('other_training_pitch')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
    </div>    <div>
        <label class="block text-sm font-medium text-gray-700">Part 1 — Introduction (Activities + Time)</label>
        <div class="grid grid-cols-1 gap-3">
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part1_a1_desc" placeholder="Activity 1 description" value="<?php echo e($old('part1_a1_desc')); ?>" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part1_a1_time" placeholder="Time (e.g. 10m)" value="<?php echo e($old('part1_a1_time')); ?>" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part1_a2_desc" placeholder="Activity 2 description" value="<?php echo e($old('part1_a2_desc')); ?>" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part1_a2_time" placeholder="Time" value="<?php echo e($old('part1_a2_time')); ?>" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part1_a3_desc" placeholder="Activity 3 description" value="<?php echo e($old('part1_a3_desc')); ?>" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part1_a3_time" placeholder="Time" value="<?php echo e($old('part1_a3_time')); ?>" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <textarea name="part1_activities" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Optional notes for Part 1"><?php echo e($old('part1_activities')); ?></textarea>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 2 — Main Topic (Activities + Time)</label>
        <div class="grid grid-cols-1 gap-3">
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part2_a1_desc" placeholder="Activity 1 description" value="<?php echo e($old('part2_a1_desc')); ?>" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part2_a1_time" placeholder="Time" value="<?php echo e($old('part2_a1_time')); ?>" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part2_a2_desc" placeholder="Activity 2 description" value="<?php echo e($old('part2_a2_desc')); ?>" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part2_a2_time" placeholder="Time" value="<?php echo e($old('part2_a2_time')); ?>" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part2_a3_desc" placeholder="Activity 3 description" value="<?php echo e($old('part2_a3_desc')); ?>" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part2_a3_time" placeholder="Time" value="<?php echo e($old('part2_a3_time')); ?>" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <textarea name="part2_activities" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Optional notes for Part 2"><?php echo e($old('part2_activities')); ?></textarea>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 3 — Notes</label>
        <textarea name="part3_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><?php echo e($old('part3_notes')); ?></textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 4 — Message</label>
        <textarea name="part4_message" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><?php echo e($old('part4_message')); ?></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Number of Kids</label>
            <input type="number" name="number_of_kids" value="<?php echo e($old('number_of_kids')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Incident Report</label>
            <input type="text" name="incident_report" value="<?php echo e($old('incident_report')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Missed / Damaged Equipment</label>
        <textarea name="missed_damaged_equipment" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><?php echo e($old('missed_damaged_equipment')); ?></textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Comments / Improvements for next session</label>
        <textarea name="comments" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><?php echo e($old('comments')); ?></textarea>
    </div>
</div>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/training_session_records/_form.blade.php ENDPATH**/ ?>