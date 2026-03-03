<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'My Students','subtitle' => 'Manage student profiles and attendance records','gradient' => 'emerald']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'My Students','subtitle' => 'Manage student profiles and attendance records','gradient' => 'emerald']); ?>
        <div class="mt-4 flex flex-wrap items-center gap-2">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="q" value="<?php echo e($q); ?>" placeholder="Search by name or phone…" class="px-4 py-2 bg-white/20 backdrop-blur-sm border border-white/30 text-white rounded-xl focus:ring-2 focus:ring-white/50 placeholder-white/70" />
                <button class="px-4 py-2 bg-white hover:bg-slate-50 text-emerald-700 font-semibold rounded-xl shadow-lg transition">🔍 Search</button>
                <?php if($q): ?>
                    <a href="#" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl transition">Clear</a>
                <?php endif; ?>
            </form>
            <a href="<?php echo e(route('coach.dashboard')); ?>" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl transition">← Back</a>
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
<div class="max-w-6xl mx-auto p-6">

    <?php if($students->isEmpty()): ?>
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 00-6-6 6 6 0 00-6 6z"/>
            </svg>
            <p class="text-slate-500 font-medium text-lg mb-2">
                <?php if($q): ?>
                    No students found matching "<?php echo e($q); ?>"
                <?php else: ?>
                    No students in your group yet
                <?php endif; ?>
            </p>
            <p class="text-slate-600 text-sm">Students will appear here once they are assigned to your group</p>
        </div>
    <?php else: ?>
        <!-- Photo Grid View -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 mb-4">📸 Student Photos</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <a href="<?php echo e(route('coach.students.show', $student)); ?>" class="block transform hover:scale-105 transition-all duration-300">
                            <!-- Photo Container -->
                            <div class="aspect-square bg-slate-100 relative">
                                <img src="<?php echo e($student->photo_url); ?>" alt="<?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?>" class="w-full h-full object-cover group-hover:brightness-75 transition-all">
                                <!-- Overlay on Hover -->
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all flex items-end opacity-0 group-hover:opacity-100">
                                    <div class="w-full p-2 bg-gradient-to-t from-black/80 to-transparent text-white">
                                        <p class="text-xs font-semibold truncate"><?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?></p>
                                        <?php if($student->jersey_number): ?>
                                            <p class="text-xs text-yellow-300">Jersey #<?php echo e($student->jersey_number); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Jersey Badge -->
                        <?php if($student->jersey_number): ?>
                            <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold rounded-full w-8 h-8 flex items-center justify-center shadow-lg group-hover:bg-blue-700 z-10">
                                #<?php echo e($student->jersey_number); ?>

                            </div>
                        <?php endif; ?>
                        <!-- Status Badge -->
                        <?php if($student->status === 'active'): ?>
                            <div class="absolute top-2 left-2 bg-emerald-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-lg z-10">✓</div>
                        <?php endif; ?>
                        <!-- Action Buttons on Bottom -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900 to-transparent p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300 z-20">
                            <div class="flex gap-2 mt-4">
                                <a href="<?php echo e(route('coach.students.show', $student)); ?>" class="flex-1 text-center px-2 py-1 bg-slate-700 hover:bg-slate-600 text-white text-xs rounded font-semibold transition">
                                    👁️ View
                                </a>
                                <a href="<?php echo e(route('coach.students.attendance', $student)); ?>" class="flex-1 text-center px-2 py-1 bg-green-600 hover:bg-green-700 text-white text-xs rounded font-semibold transition">
                                    📋 Attend
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Students Grid - Detailed View -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 mb-4">📋 Detailed View</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-700 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                    <!-- Card Header with Image -->
                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-neutral-800 dark:to-neutral-700 px-4 py-3 border-b border-slate-200 dark:border-neutral-700 flex flex-col items-center">
                        <img src="<?php echo e($student->photo_url); ?>" alt="Profile Image" class="h-16 w-16 rounded-full object-cover border-2 border-slate-200 shadow mb-2">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white"><?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?></h3>
                        <?php if($student->jersey_number || $student->jersey_name): ?>
                            <div class="flex items-center gap-2 mt-2">
                                <?php if($student->jersey_number): ?>
                                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded">Jersey #<?php echo e($student->jersey_number); ?></span>
                                <?php endif; ?>
                                <?php if($student->jersey_name): ?>
                                    <span class="inline-block px-2 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded"><?php echo e($student->jersey_name); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Card Body -->
                    <div class="p-4">
                        <!-- Student Info -->
                        <div class="space-y-2 mb-4 pb-4 border-b border-slate-100 dark:border-neutral-700">
                            <?php if($student->group): ?>
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    <span class="font-semibold">👥 Group:</span> <?php echo e($student->group->name); ?>

                                </p>
                            <?php endif; ?>
                            <?php if($student->phone): ?>
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    <span class="font-semibold">📱 Phone:</span> <?php echo e($student->phone); ?>

                                </p>
                            <?php endif; ?>
                            <?php if($student->parent): ?>
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    <span class="font-semibold">👤 Parent:</span> <?php echo e($student->parent->name); ?>

                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Attendance Action Button -->
                        <div class="mb-4 flex gap-2">
                            <a href="<?php echo e(route('coach.students.attendance', $student)); ?>" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg font-semibold transition">📋 Attendance</a>
                        </div>

                        <!-- Status Badge -->
                        <div class="mb-4">
                            <?php if($student->status === 'active'): ?>
                                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-full">✓ Active</span>
                            <?php elseif($student->status === 'inactive'): ?>
                                <span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 text-xs font-bold rounded-full">○ Inactive</span>
                            <?php else: ?>
                                <span class="inline-block px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full">⟳ <?php echo e(ucfirst($student->status)); ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-2">
                            <a href="<?php echo e(route('coach.students.show', $student)); ?>" class="text-center px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-slate-300 rounded-lg font-semibold transition text-sm">
                                👁️ View Profile
                            </a>
                            <a href="<?php echo e(route('coach.students.attendance', $student)); ?>" class="text-center px-3 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 hover:shadow-lg text-white rounded-lg font-semibold transition text-sm">
                                📋 Attendance
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Pagination -->
        <?php if($students->hasPages()): ?>
            <div class="mt-6">
                <?php echo e($students->links()); ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\coach\students\index.blade.php ENDPATH**/ ?>