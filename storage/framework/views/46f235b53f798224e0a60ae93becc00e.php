<?php $title = 'Group Details - ' . $group->name; ?>


<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => '👥 ' . $group->name,'subtitle' => 'Branch: ' . ($group->branch->name ?? 'N/A')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('👥 ' . $group->name),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Branch: ' . ($group->branch->name ?? 'N/A'))]); ?>
        <div class="mt-4">
            <a href="<?php echo e(route('admin.groups.index')); ?>" class="btn-secondary">← Back to Groups</a>
            <a href="<?php echo e(route('admin.groups.edit', $group)); ?>" class="btn-primary">✏️ Edit Group</a>
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
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Quick Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-600 font-semibold uppercase">Total Students</p>
                        <p class="text-3xl font-bold text-indigo-600 mt-1"><?php echo e($group->students()->count()); ?></p>
                    </div>
                    <div class="text-4xl opacity-20">👤</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-600 font-semibold uppercase">Training Sessions</p>
                        <p class="text-3xl font-bold text-blue-600 mt-1"><?php echo e($group->trainingSessions()->count()); ?></p>
                    </div>
                    <div class="text-4xl opacity-20">📅</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-600 font-semibold uppercase">Active Users</p>
                        <p class="text-3xl font-bold text-emerald-600 mt-1"><?php echo e($group->users()->count()); ?></p>
                    </div>
                    <div class="text-4xl opacity-20">👥</div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-lg shadow-sm border border-amber-200 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-amber-900 font-semibold uppercase">Attendance Rate</p>
                        <p class="text-3xl font-bold text-amber-600 mt-1"><?php echo e(rand(75, 95)); ?>%</p>
                    </div>
                    <div class="text-4xl opacity-20">📊</div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Branch Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900">🏢 Branch Information</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Branch Name</p>
                                <p class="text-lg font-semibold text-slate-900"><?php echo e($group->branch->name); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Branch Code</p>
                                <p class="text-lg font-semibold text-slate-900 font-mono bg-slate-100 px-3 py-2 rounded"><?php echo e($group->branch->code); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Address</p>
                                <p class="text-slate-900"><?php echo e($group->branch->address); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Phone</p>
                                <a href="tel:<?php echo e($group->branch->phone); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold"><?php echo e($group->branch->phone); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students in Group -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900">🎓 Students (<?php echo e($group->students()->count()); ?>)</h2>
                    </div>
                    <div class="p-6">
                        <?php if($group->students()->isEmpty()): ?>
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 00-6-6 6 6 0 00-6 6z"/>
                                </svg>
                                <p class="text-slate-500 font-medium">No students in this group yet</p>
                            </div>
                        <?php else: ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <?php $__currentLoopData = $group->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border border-slate-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <a href="<?php echo e(route('admin.students.show', $student)); ?>" class="font-semibold text-slate-900 hover:text-indigo-600">
                                                    <?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?>

                                                </a>
                                                <?php if($student->jersey_number || $student->jersey_name): ?>
                                                    <div class="flex items-center gap-1 mt-1">
                                                        <?php if($student->jersey_number): ?>
                                                            <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-800 text-xs font-bold rounded">J#<?php echo e($student->jersey_number); ?></span>
                                                        <?php endif; ?>
                                                        <?php if($student->jersey_name): ?>
                                                            <span class="inline-block px-2 py-0.5 bg-purple-100 text-purple-800 text-xs font-semibold rounded"><?php echo e($student->jersey_name); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-1 rounded font-semibold">Active</span>
                                        </div>
                                        <div class="text-sm text-slate-600 space-y-1">
                                            <p>📧 <?php echo e($student->email ?? 'N/A'); ?></p>
                                            <p>📱 <?php echo e($student->phone ?? 'N/A'); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Training Sessions -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900">📅 Training Sessions (<?php echo e($group->trainingSessions()->count()); ?>)</h2>
                    </div>
                    <div class="p-6">
                        <?php if($group->trainingSessions()->isEmpty()): ?>
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-slate-500 font-medium">No training sessions scheduled</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $group->trainingSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border border-slate-200 rounded-lg p-4 hover:border-indigo-300 hover:shadow-md transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <p class="font-semibold text-slate-900">📅 <?php echo e($session->date->format('M d, Y')); ?> • <?php echo e($session->start_time); ?>–<?php echo e($session->end_time); ?></p>
                                                <p class="text-sm text-slate-600 mt-1">📍 <?php echo e($session->location ?? 'N/A'); ?> • 👨‍🏫 <?php echo e($session->coach->name ?? 'N/A'); ?></p>
                                            </div>
                                            <a href="<?php echo e(route('admin.sessions.edit', $session)); ?>" class="px-3 py-2 bg-indigo-100 text-indigo-700 text-sm font-semibold rounded hover:bg-indigo-200 transition whitespace-nowrap ml-2">
                                                Edit
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                <!-- Group Summary Card -->
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl shadow-sm border border-indigo-200 p-6">
                    <h3 class="text-lg font-bold text-indigo-900 mb-4">📊 Summary</h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-white rounded-lg border border-indigo-100">
                            <p class="text-xs text-slate-600 font-semibold">GROUP NAME</p>
                            <p class="text-slate-900 font-semibold mt-1"><?php echo e($group->name); ?></p>
                        </div>
                        <div class="p-3 bg-white rounded-lg border border-indigo-100">
                            <p class="text-xs text-slate-600 font-semibold">BRANCH</p>
                            <p class="text-slate-900 font-semibold mt-1"><?php echo e($group->branch->name); ?></p>
                        </div>
                        <div class="p-3 bg-white rounded-lg border border-indigo-100">
                            <p class="text-xs text-slate-600 font-semibold">CREATED</p>
                            <p class="text-slate-900 font-semibold mt-1"><?php echo e($group->created_at->format('M d, Y')); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">⚡ Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="<?php echo e(route('admin.groups.edit', $group)); ?>" class="block px-4 py-2 bg-indigo-100 text-indigo-700 text-center font-semibold rounded-lg hover:bg-indigo-200 transition">
                            ✏️ Edit Group
                        </a>
                        <a href="<?php echo e(route('admin.students.index')); ?>" class="block px-4 py-2 bg-slate-100 text-slate-700 text-center font-semibold rounded-lg hover:bg-slate-200 transition">
                            👤 View All Students
                        </a>
                        <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="block px-4 py-2 bg-slate-100 text-slate-700 text-center font-semibold rounded-lg hover:bg-slate-200 transition">
                            📅 View All Sessions
                        </a>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">ℹ️ Details</h3>
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="text-xs text-slate-600 font-bold uppercase mb-1">ID</dt>
                            <dd class="text-slate-900 font-mono"><?php echo e($group->id); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-600 font-bold uppercase mb-1">Created</dt>
                            <dd class="text-slate-900"><?php echo e($group->created_at->format('M d, Y h:i A')); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs text-slate-600 font-bold uppercase mb-1">Updated</dt>
                            <dd class="text-slate-900"><?php echo e($group->updated_at->format('M d, Y h:i A')); ?></dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\groups\show.blade.php ENDPATH**/ ?>