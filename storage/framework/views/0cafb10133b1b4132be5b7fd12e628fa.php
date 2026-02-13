<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => ''.e(__('app.create_capacity_building')).'','subtitle' => ''.e(__('app.add_new_training_session')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('app.create_capacity_building')).'','subtitle' => ''.e(__('app.add_new_training_session')).'']); ?>
        <div class="mt-4">

        </div>
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
<div class="max-w-4xl mx-auto p-6">

    <form action="<?php echo e(route('admin.inhousetrainings.store')); ?>" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First Name</label>
                <input type="text" name="first_name" value="<?php echo e(old('first_name')); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Second Name</label>
                <input type="text" name="second_name" value="<?php echo e(old('second_name')); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['second_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender</label>
                <select name="gender" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">Select Gender</option>
                    <option value="Male" <?php if(old('gender') === 'Male'): echo 'selected'; endif; ?>>Male</option>
                    <option value="Female" <?php if(old('gender') === 'Female'): echo 'selected'; endif; ?>>Female</option>
                </select>
                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                <select name="country" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="Rwanda" <?php if(old('country') === 'Rwanda'): echo 'selected'; endif; ?>>Rwanda</option>
                    <option value="Tanzania" <?php if(old('country') === 'Tanzania'): echo 'selected'; endif; ?>>Tanzania</option>
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

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                <select name="city" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="Kigali" <?php if(old('city') === 'Kigali'): echo 'selected'; endif; ?>>Kigali</option>
                    <option value="Mwanza" <?php if(old('city') === 'Mwanza'): echo 'selected'; endif; ?>>Mwanza</option>
                </select>
                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Discipline</label>
                <select name="discipline" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="Football" <?php if(old('discipline') === 'Football'): echo 'selected'; endif; ?>>Football</option>
                    <option value="Basketball" <?php if(old('discipline') === 'Basketball'): echo 'selected'; endif; ?>>Basketball</option>
                </select>
                <?php $__errorArgs = ['discipline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Branch</label>
                <select name="branch_id" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">Select Branch</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($b->id); ?>" <?php if(old('branch_id') == $b->id): echo 'selected'; endif; ?>><?php echo e($b->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['branch_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                <select name="role_id" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">Select Role</option>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($r->id); ?>" <?php if(old('role_id') == $r->id): echo 'selected'; endif; ?>><?php echo e($r->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Training Name</label>
                <input type="text" name="training_name" value="<?php echo e(old('training_name')); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['training_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Channel</label>
                <select name="channel" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">Select Channel</option>
                    <option value="In person" <?php if(old('channel') === 'In person'): echo 'selected'; endif; ?>>In person</option>
                    <option value="virtual" <?php if(old('channel') === 'virtual'): echo 'selected'; endif; ?>>virtual</option>
                </select>
                <?php $__errorArgs = ['channel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Training Date</label>
                <input type="date" name="training_date" value="<?php echo e(old('training_date')); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['training_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date & Time</label>
                <input type="datetime-local" name="start" value="<?php echo e(old('start')); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['start'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date & Time</label>
                <input type="datetime-local" name="end" value="<?php echo e(old('end')); ?>" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['end'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cost Type <span class="text-red-500">*</span></label>
                <select name="cost" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                    <option value="Paid" <?php if(old('cost', 'Paid') === 'Paid'): echo 'selected'; endif; ?>>Paid</option>
                    <option value="Free" <?php if(old('cost') === 'Free'): echo 'selected'; endif; ?>>Free</option>
                </select>
                <?php $__errorArgs = ['cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Training Category <span class="text-red-500">*</span></label>
                <select name="training_category" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                    <option value="In house" <?php if(old('training_category', 'In house') === 'In house'): echo 'selected'; endif; ?>>In House</option>
                    <option value="Outside DTFA" <?php if(old('training_category') === 'Outside DTFA'): echo 'selected'; endif; ?>>Outside DTFA</option>
                </select>
                <?php $__errorArgs = ['training_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Venue</label>
                <input type="text" name="venue" value="<?php echo e(old('venue')); ?>" placeholder="e.g., Conference Room A" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['venue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location</label>
                <input type="text" name="location" value="<?php echo e(old('location')); ?>" placeholder="e.g., Main Office Building" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Trainer Name</label>
                <input type="text" name="trainer_name" value="<?php echo e(old('trainer_name')); ?>" placeholder="e.g., John Doe" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                <?php $__errorArgs = ['trainer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Did participant receive certificate?</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="certificate_received" value="1" class="form-radio" <?php if(old('certificate_received') == '1'): echo 'checked'; endif; ?>>
                        <span class="ml-2">Yes</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="certificate_received" value="0" class="form-radio" <?php if(old('certificate_received') == '0'): echo 'checked'; endif; ?>>
                        <span class="ml-2">No</span>
                    </label>
                </div>
                <?php $__errorArgs = ['certificate_received'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label>
                <textarea name="notes" rows="4" placeholder="Additional notes or description..." class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700"><?php echo e(old('notes')); ?></textarea>
                <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

        </div>

        <div class="flex items-center justify-end gap-2 pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="<?php echo e(route('admin.inhousetrainings.index')); ?>" class="px-4 py-2 border rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition">Save Training</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/inhousetrainings/create.blade.php ENDPATH**/ ?>