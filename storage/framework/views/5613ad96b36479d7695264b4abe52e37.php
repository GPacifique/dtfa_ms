

<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Edit Staff Profile','subtitle' => 'Update staff details and roles']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Staff Profile','subtitle' => 'Update staff details and roles']); ?>
        <div class="mt-4 flex items-center gap-2">

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
    <div class="bg-white dark:bg-slate-800 rounded shadow p-6 mt-6">
        <form method="POST" action="<?php echo e(route('staff.update', $staff)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="mb-6 p-4 bg-slate-50 dark:bg-slate-900/30 rounded-lg border border-slate-200 dark:border-slate-700">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Profile Photo</label>
                <div class="flex items-start gap-4 mb-3">
                    <img src="<?php echo e($staff->photo_url); ?>" alt="<?php echo e($staff->first_name); ?>" class="w-20 h-20 rounded-full object-cover ring-2 ring-slate-300 dark:ring-slate-600">
                    <div class="flex-1">
                        <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-400 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 transition-colors cursor-pointer">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Upload new photo to replace current • Supported: JPEG, PNG, GIF • Max: 2MB</p>
                    </div>
                </div>
                <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm">First Name</label>
                    <input name="first_name" value="<?php echo e(old('first_name', $staff->first_name)); ?>" class="w-full border rounded px-3 py-2" required />
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
                    <label class="block text-sm">Last Name</label>
                    <input name="last_name" value="<?php echo e(old('last_name', $staff->last_name)); ?>" class="w-full border rounded px-3 py-2" />
                    <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Branch</label>
                    <select name="branch" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Branch --</option>
                        <option value="RWANDA" <?php echo e(old('branch', $staff->branch) == 'RWANDA' ? 'selected' : ''); ?>>Rwanda</option>
                        <option value="TANZANIA" <?php echo e(old('branch', $staff->branch) == 'TANZANIA' ? 'selected' : ''); ?>>Tanzania</option>
                    </select>
                    <?php $__errorArgs = ['branch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Sport Discipline</label>
                    <select name="discipline" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select --</option>
                        <option value="Football" <?php echo e(old('discipline', $staff->discipline) == 'Football' ? 'selected' : ''); ?>>Football</option>
                        <option value="Basketball" <?php echo e(old('discipline', $staff->discipline) == 'Basketball' ? 'selected' : ''); ?>>Basketball</option>
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
                    <label class="block text-sm">Gender</label>
                    <select name="gender" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select --</option>
                        <option value="Male" <?php echo e(old('gender', $staff->gender) == 'Male' ? 'selected' : ''); ?>>Male</option>
                        <option value="Female" <?php echo e(old('gender', $staff->gender) == 'Female' ? 'selected' : ''); ?>>Female</option>
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
                    <label class="block text-sm">Date of Birth</label>
                    <input type="date" name="dob" value="<?php echo e(old('dob', $staff->dob?->format('Y-m-d'))); ?>" class="w-full border rounded px-3 py-2" />
                    <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Role</label>
                    <select name="role_name" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Role --</option>
                        <?php $__currentLoopData = ($roles ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($r->name); ?>" <?php if(old('role_name',$staff->role_function)===$r->name): echo 'selected'; endif; ?>><?php echo e($r->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['role_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm">Volunteer Role</label>
                    <input name="volunteer_role" value="<?php echo e(old('volunteer_role', $staff->volunteer_role)); ?>" class="w-full border rounded px-3 py-2" />
                    <?php $__errorArgs = ['volunteer_role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Date of Entry</label>
                    <input type="date" name="date_entry" value="<?php echo e(old('date_entry', $staff->date_entry?->format('Y-m-d'))); ?>" class="w-full border rounded px-3 py-2" />
                    <?php $__errorArgs = ['date_entry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Date of Exit</label>
                    <input type="date" name="date_exit" value="<?php echo e(old('date_exit', $staff->date_exit?->format('Y-m-d'))); ?>" class="w-full border rounded px-3 py-2" />
                    <?php $__errorArgs = ['date_exit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Other organizations</label>
                    <textarea name="other_organizations" class="w-full border rounded px-3 py-2"><?php echo e(old('other_organizations', $staff->other_organizations)); ?></textarea>
                    <?php $__errorArgs = ['other_organizations'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Academic Qualification</label>
                    <select name="academic_qualification" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Qualification --</option>
                        <option value="Primary" <?php echo e(old('academic_qualification', $staff->academic_qualification) == 'Primary' ? 'selected' : ''); ?>>Primary</option>
                        <option value="Secondary" <?php echo e(old('academic_qualification', $staff->academic_qualification) == 'Secondary' ? 'selected' : ''); ?>>Secondary</option>
                        <option value="University" <?php echo e(old('academic_qualification', $staff->academic_qualification) == 'University' ? 'selected' : ''); ?>>University</option>
                    </select>
                    <?php $__errorArgs = ['academic_qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Major / Combination</label>
                    <input name="major" value="<?php echo e(old('major', $staff->major)); ?>" class="w-full border rounded px-3 py-2" />
                    <?php $__errorArgs = ['major'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Name of University</label>
                    <input name="university_name" value="<?php echo e(old('university_name', $staff->university_name)); ?>" class="w-full border rounded px-3 py-2" />
                    <?php $__errorArgs = ['university_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Name of Qualification</label>
                    <input name="qualification_name" value="<?php echo e(old('qualification_name', $staff->qualification_name)); ?>" class="w-full border rounded px-3 py-2" />
                    <?php $__errorArgs = ['qualification_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Professional Certificates (one per line)</label>
                    <textarea name="professional_certificates" class="w-full border rounded px-3 py-2"><?php echo e(old('professional_certificates', $staff->professional_certificates)); ?></textarea>
                    <?php $__errorArgs = ['professional_certificates'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php $sizeOptions = ['Small'=>'Small','Medium'=>'Medium','Large'=>'Large','X Large'=>'X Large','XX Large'=>'XX Large','XXX Large'=>'XXX Large']; ?>
                <div>
                    <label class="block text-sm">Top T-Shirt Size</label>
                    <select name="tshirt_size" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Size --</option>
                        <?php $__currentLoopData = $sizeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if(old('tshirt_size', $staff->tshirt_size)===$val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['tshirt_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Short Size</label>
                    <select name="short_size" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Size --</option>
                        <?php $__currentLoopData = $sizeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if(old('short_size', $staff->short_size)===$val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['short_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Top Tracksuit Size</label>
                    <select name="top_tracksuit_size" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Size --</option>
                        <?php $__currentLoopData = $sizeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if(old('top_tracksuit_size', $staff->top_tracksuit_size)===$val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['top_tracksuit_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm">Pant Tracksuit Size</label>
                    <select name="pant_tracksuit_size" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Size --</option>
                        <?php $__currentLoopData = $sizeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if(old('pant_tracksuit_size', $staff->pant_tracksuit_size)===$val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['pant_tracksuit_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Staff Personnel Email</label>
                    <select name="email" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select User Email --</option>
                        <?php $__currentLoopData = ($userEmails ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($email); ?>" <?php if(old('email', $staff->email)===$email): echo 'selected'; endif; ?>><?php echo e($email); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mt-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
                <a href="<?php echo e(route('staff.index')); ?>" class="ml-2 px-4 py-2 border rounded">Cancel</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\staff\edit.blade.php ENDPATH**/ ?>