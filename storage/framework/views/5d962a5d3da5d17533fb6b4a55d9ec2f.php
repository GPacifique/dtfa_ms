

<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'New Staff Profile','subtitle' => 'Add a new team member']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'New Staff Profile','subtitle' => 'Add a new team member']); ?>
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
    <div class="container mx-auto px-6 py-8">

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-8">
            <form method="POST" action="<?php echo e(route('staff.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                
                <div class="mb-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <label class="block text-sm font-bold text-blue-900 dark:text-blue-300 mb-3">📸 Profile Photo</label>
                    <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-100 dark:file:bg-blue-900/50 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-200 dark:hover:file:bg-blue-900/70 transition-colors cursor-pointer">
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2">Supported: JPEG, PNG, GIF • Max size: 2MB</p>
                    <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-sm text-red-600 dark:text-red-400 mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👤 Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">First Name *</label>
                            <input name="first_name" value="<?php echo e(old('first_name')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
                            <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Last Name *</label>
                            <input name="last_name" value="<?php echo e(old('last_name')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
                            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">🏢 Branch</label>
                            <select name="branch" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select Branch --</option>
                                <option value="RWANDA" <?php echo e(old('branch') == 'RWANDA' ? 'selected' : ''); ?>>🇷🇼 Rwanda</option>
                                <option value="TANZANIA" <?php echo e(old('branch') == 'TANZANIA' ? 'selected' : ''); ?>>🇹🇿 Tanzania</option>
                            </select>
                            <?php $__errorArgs = ['branch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">⚽ Sport Discipline</label>
                            <select name="discipline" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                <option value="Football" <?php echo e(old('discipline') == 'Football' ? 'selected' : ''); ?>>⚽ Football</option>
                                <option value="Basketball" <?php echo e(old('discipline') == 'Basketball' ? 'selected' : ''); ?>>🏀 Basketball</option>
                            </select>
                            <?php $__errorArgs = ['discipline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">👥 Gender</label>
                            <select name="gender" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                <option value="Male" <?php echo e(old('gender') == 'Male' ? 'selected' : ''); ?>>👨 Male</option>
                                <option value="Female" <?php echo e(old('gender') == 'Female' ? 'selected' : ''); ?>>👩 Female</option>
                            </select>
                            <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">📅 Date of Birth</label>
                            <input type="date" name="dob" value="<?php echo e(old('dob')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">💼 Role & Position</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Role *</label>
                            <select name="role_name" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">-- Select Role --</option>
                                <?php $__currentLoopData = ($roles ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($r->name); ?>" <?php if(old('role_function')===$r->name): echo 'selected'; endif; ?>><?php echo e($r->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['role_function'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Volunteer Role</label>
                            <input name="volunteer_role" value="<?php echo e(old('volunteer_role')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Senior Coach" />
                            <?php $__errorArgs = ['volunteer_role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">📌 Date of Entry</label>
                            <input type="date" name="date_entry" value="<?php echo e(old('date_entry')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            <?php $__errorArgs = ['date_entry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">📌 Date of Exit</label>
                            <input type="date" name="date_exit" value="<?php echo e(old('date_exit')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            <?php $__errorArgs = ['date_exit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">🎓 Qualifications & Experience</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Academic Qualification</label>
                            <select name="academic_qualification" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select Qualification --</option>
                                <option value="Primary" <?php echo e(old('academic_qualification') == 'Primary' ? 'selected' : ''); ?>>Primary</option>
                                <option value="Secondary" <?php echo e(old('academic_qualification') == 'Secondary' ? 'selected' : ''); ?>>Secondary</option>
                                <option value="University" <?php echo e(old('academic_qualification') == 'University' ? 'selected' : ''); ?>>University</option>
                            </select>
                            <?php $__errorArgs = ['academic_qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Major / Specialization</label>
                            <input name="major" value="<?php echo e(old('major')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Sports Science" />
                            <?php $__errorArgs = ['major'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Name of University</label>
                            <input name="university_name" value="<?php echo e(old('university_name')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., University of Rwanda" />
                            <?php $__errorArgs = ['university_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Name of Qualification</label>
                            <input name="qualification_name" value="<?php echo e(old('qualification_name')); ?>" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Bachelor of Science" />
                            <?php $__errorArgs = ['qualification_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Professional Certificates</label>
                            <textarea name="professional_certificates" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3" placeholder="One certificate per line"><?php echo e(old('professional_certificates')); ?></textarea>
                            <?php $__errorArgs = ['professional_certificates'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Other Organizations</label>
                            <textarea name="other_organizations" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3" placeholder="Organizations worked with or affiliated"><?php echo e(old('other_organizations')); ?></textarea>
                            <?php $__errorArgs = ['other_organizations'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👕 Uniform Sizes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php $sizeOptions = ['Small'=>'Small','Medium'=>'Medium','Large'=>'Large','X Large'=>'X Large','XX Large'=>'XX Large','XXX Large'=>'XXX Large']; ?>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">T-Shirt Size</label>
                            <select name="tshirt_size" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                <?php $__currentLoopData = $sizeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(old('tshirt_size')===$val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tshirt_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Shorts Size</label>
                            <select name="short_size" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                <?php $__currentLoopData = $sizeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(old('short_size')===$val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['short_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tracksuit Top</label>
                            <select name="top_tracksuit_size" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                <?php $__currentLoopData = $sizeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(old('top_tracksuit_size')===$val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['top_tracksuit_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tracksuit Pants</label>
                            <select name="pant_tracksuit_size" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                <?php $__currentLoopData = $sizeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(old('pant_tracksuit_size')===$val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['pant_tracksuit_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📧 Personnel Email</h2>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Staff Email Account</label>
                        <select name="email" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Select User Email --</option>
                            <?php $__currentLoopData = ($userEmails ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($email); ?>" <?php if(old('email')===$email): echo 'selected'; endif; ?>><?php echo e($email); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 dark:text-red-400 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="flex items-center gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                    <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition">
                        ✓ Save
                    </button>
                    <a href="<?php echo e(route('staff.index')); ?>" class="px-6 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-semibold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Documents\GitHub\dtfa_ms\resources\views/staff/create.blade.php ENDPATH**/ ?>