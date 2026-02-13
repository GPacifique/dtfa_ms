<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Prepare Training Session','subtitle' => 'Plan and schedule training session details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Prepare Training Session','subtitle' => 'Plan and schedule training session details']); ?>

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


    <form action="<?php echo e(isset($trainingSessionRecord) ? route('admin.training_session_records.update', $trainingSessionRecord) : route('admin.training_session_records.store')); ?>" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-xl p-8">
        <?php echo csrf_field(); ?>
        <?php if(isset($trainingSessionRecord)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <!-- Training Objectives Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-purple-500">
                🎯 Training Objectives
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Main Topic</label>
                    <input type="text" name="main_topic" value="<?php echo e($trainingSessionRecord->main_topic ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="e.g., Passing techniques, Ball control">
                    <?php $__errorArgs = ['main_topic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Area of Performance</label>
                    <select name="area_performance" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Select area</option>
                        <option value="Physical" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->area_performance=='Physical') ? 'selected' : ''); ?>>💪 Physical</option>
                        <option value="Technical" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->area_performance=='Technical') ? 'selected' : ''); ?>>⚙️ Technical</option>
                        <option value="Tactical" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->area_performance=='Tactical') ? 'selected' : ''); ?>>♟️ Tactical</option>
                        <option value="Mental" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->area_performance=='Mental') ? 'selected' : ''); ?>>🧠 Mental</option>
                    </select>
                    <?php $__errorArgs = ['area_performance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Training Objective</label>
                <textarea name="training_objective" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Describe the objectives and goals for this training session..."><?php echo e($trainingSessionRecord->training_objective ?? ''); ?></textarea>
                <?php $__errorArgs = ['training_objective'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Basic Details Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-indigo-500">
                📅 Session Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Date</label>
                    <input type="date" name="date" value="<?php echo e(isset($trainingSessionRecord) && $trainingSessionRecord->date ? $trainingSessionRecord->date->format('Y-m-d') : ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Start Time</label>
                    <input type="time" name="start_time" value="<?php echo e($trainingSessionRecord->start_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Finish Time</label>
                    <input type="time" name="finish_time" value="<?php echo e($trainingSessionRecord->finish_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <?php $__errorArgs = ['finish_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sport Discipline</label>
                    <select name="sport_discipline" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select discipline</option>
                        <option value="Football" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->sport_discipline=='Football') ? 'selected' : ''); ?>>⚽ Football</option>
                        <option value="Basketball" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->sport_discipline=='Basketball') ? 'selected' : ''); ?>>🏀 Basketball</option>
                    </select>
                    <?php $__errorArgs = ['sport_discipline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Coach</label>
                    <select name="coach_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select coach</option>
                        <?php $__currentLoopData = $coaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($coach->id); ?>" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->coach_id == $coach->id) ? 'selected' : ''); ?>>
                                <?php echo e($coach->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['coach_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Lead Coach</label>
                    <select name="lead_coach_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select lead coach</option>
                        <?php $__currentLoopData = $coaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($coach->id); ?>" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->lead_coach_id == $coach->id) ? 'selected' : ''); ?>>
                                <?php echo e($coach->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['lead_coach_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="lg:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Support Staff</label>
                    <select name="support_staff[]" multiple class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <?php $__currentLoopData = $coaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($coach->id); ?>" <?php echo e((isset($trainingSessionRecord) && in_array($coach->id, (array)$trainingSessionRecord->support_staff)) ? 'selected' : ''); ?>>
                                <?php echo e($coach->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['support_staff'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Branch</label>
                    <select name="branch" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select branch</option>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($b); ?>" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->branch == $b) ? 'selected' : ''); ?>>
                                <?php echo e($b); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['branch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Location Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-emerald-500">
                📍 Location
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country</label>
                    <select name="country" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        <option value="">Select country</option>
                        <option value="Rwanda" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->country=='Rwanda') ? 'selected' : ''); ?>>🇷🇼 Rwanda</option>
                        <option value="Tanzania" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->country=='Tanzania') ? 'selected' : ''); ?>>🇹🇿 Tanzania</option>
                    </select>
                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">City</label>
                    <select name="city" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        <option value="">Select city</option>
                        <option value="Kigali" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->city=='Kigali') ? 'selected' : ''); ?>>Kigali</option>
                        <option value="Mwanza" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->city=='Mwanza') ? 'selected' : ''); ?>>Mwanza</option>
                    </select>
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Training Pitch</label>
                    <select name="training_pitch" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        <option value="">Select pitch</option>
                        <?php $__currentLoopData = $pitches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($p); ?>" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->training_pitch == $p) ? 'selected' : ''); ?>>
                                <?php echo e($p); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="Other" <?php echo e((isset($trainingSessionRecord) && $trainingSessionRecord->training_pitch == 'Other') ? 'selected' : ''); ?>>Other</option>
                    </select>
                    <?php $__errorArgs = ['training_pitch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Other Pitch (if Other)</label>
                    <input type="text" name="other_training_pitch" value="<?php echo e($trainingSessionRecord->other_training_pitch ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-emerald-500 focus:border-transparent" placeholder="Specify other pitch">
                    <?php $__errorArgs = ['other_training_pitch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Training Plan - Part 1 Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-blue-500">
                📋 Training Plan - Part 1 (Warm-up & Drills)
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Part 1 Activities Overview</label>
                <textarea name="part1_activities" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Brief overview of Part 1 activities..."><?php echo e($trainingSessionRecord->part1_activities ?? ''); ?></textarea>
                <?php $__errorArgs = ['part1_activities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- Activity 1 -->
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-blue-900 dark:text-blue-200">Activity 1</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part1_a1_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part1_a1_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part1_a1_time" value="<?php echo e($trainingSessionRecord->part1_a1_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 10 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-blue-900 dark:text-blue-200">Activity 2</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part1_a2_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part1_a2_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part1_a2_time" value="<?php echo e($trainingSessionRecord->part1_a2_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 15 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-blue-900 dark:text-blue-200">Activity 3</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part1_a3_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part1_a3_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part1_a3_time" value="<?php echo e($trainingSessionRecord->part1_a3_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 20 min">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Training Plan - Part 2 Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-teal-500">
                📋 Training Plan - Part 2 (Main Session)
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Part 2 Activities Overview</label>
                <textarea name="part2_activities" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="Brief overview of Part 2 activities..."><?php echo e($trainingSessionRecord->part2_activities ?? ''); ?></textarea>
                <?php $__errorArgs = ['part2_activities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- Activity 1 -->
                <div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-teal-900 dark:text-teal-200">Activity 1</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part2_a1_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part2_a1_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part2_a1_time" value="<?php echo e($trainingSessionRecord->part2_a1_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 25 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-teal-900 dark:text-teal-200">Activity 2</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part2_a2_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part2_a2_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part2_a2_time" value="<?php echo e($trainingSessionRecord->part2_a2_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 30 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-teal-900 dark:text-teal-200">Activity 3</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part2_a3_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part2_a3_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part2_a3_time" value="<?php echo e($trainingSessionRecord->part2_a3_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 20 min">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Training Plan - Part 3 Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-amber-500">
                📋 Training Plan - Part 3 (Cool-down & Conclusion)
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Part 3 Activities Overview</label>
                <textarea name="part3_notes" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-amber-500 focus:border-transparent" placeholder="Brief overview of Part 3 activities..."><?php echo e($trainingSessionRecord->part3_notes ?? ''); ?></textarea>
                <?php $__errorArgs = ['part3_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- Activity 1 -->
                <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-amber-900 dark:text-amber-200">Activity 1</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part3_a1_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part3_a1_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part3_a1_time" value="<?php echo e($trainingSessionRecord->part3_a1_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 10 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-amber-900 dark:text-amber-200">Activity 2</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part3_a2_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part3_a2_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part3_a2_time" value="<?php echo e($trainingSessionRecord->part3_a2_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 15 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-amber-900 dark:text-amber-200">Activity 3</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part3_a3_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part3_a3_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part3_a3_time" value="<?php echo e($trainingSessionRecord->part3_a3_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 20 min">
                        </div>
                    </div>
                </div>
            </div>

        <!-- Training Plan - Part 4 Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-red-500">
                📋 Training Plan - Part 4 (Communication)
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Part 4 Message (Communication to Players/Parents)</label>
                <textarea name="part4_message" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Brief overview of Part 4 message..."><?php echo e($trainingSessionRecord->part4_message ?? ''); ?></textarea>
                <?php $__errorArgs = ['part4_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- Activity 1 -->
                <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-red-900 dark:text-red-200">Activity 1</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part4_a1_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part4_a1_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part4_a1_time" value="<?php echo e($trainingSessionRecord->part4_a1_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 5 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-red-900 dark:text-red-200">Activity 2</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part4_a2_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part4_a2_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part4_a2_time" value="<?php echo e($trainingSessionRecord->part4_a2_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 5 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-red-900 dark:text-red-200">Activity 3</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part4_a3_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800"><?php echo e($trainingSessionRecord->part4_a3_desc ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part4_a3_time" value="<?php echo e($trainingSessionRecord->part4_a3_time ?? ''); ?>" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 5 min">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold transition">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                <?php echo e(isset($trainingSessionRecord) ? '✅ Save' : '✅ Save'); ?>

            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/training_session_records/prepare.blade.php ENDPATH**/ ?>