<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Student: ' . ($student->first_name . ' ' . $student->second_name),'subtitle' => 'Profile overview']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Student: ' . ($student->first_name . ' ' . $student->second_name)),'subtitle' => 'Profile overview']); ?>
        <div class="mt-4 flex items-center gap-2">
            <a href="<?php echo e(route('coach.students.index')); ?>" class="btn-secondary">← Back to Students</a>
            <a href="<?php echo e(route('coach.students.edit', $student)); ?>" class="btn-primary">Edit</a>
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
<div class="max-w-3xl mx-auto p-6 space-y-6">

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
        <div class="flex justify-center mb-6">
            <img src="<?php echo e($student->photo_url); ?>" alt="Profile Image" class="h-32 w-32 rounded-full object-cover border-2 border-slate-200 shadow">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div class="text-sm text-neutral-500">Name</div>
                <div class="font-medium"><?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Status</div>
                <div class="font-medium"><?php echo e(ucfirst($student->status ?? 'active')); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Email</div>
                <div class="font-medium"><?php echo e($student->email ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Phone</div>
                <div class="font-medium"><?php echo e($student->phone ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Emergency Phone</div>
                <div class="font-medium"><?php echo e($student->emergency_phone ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Date of Birth</div>
                <div class="font-medium"><?php echo e(optional($student->dob)->format('M d, Y') ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Branch / Group</div>
                <div class="font-medium"><?php echo e($student->branch?->name ?? '—'); ?> / <?php echo e($student->group?->name ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Sport Discipline</div>
                <div class="font-medium"><?php echo e($student->sport_discipline ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Position</div>
                <div class="font-medium"><?php echo e($student->position ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Coach</div>
                <div class="font-medium"><?php echo e($student->coach ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Father's Name</div>
                <div class="font-medium"><?php echo e($student->father_name ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Mother's Name</div>
                <div class="font-medium"><?php echo e($student->mother_name ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Parent</div>
                <div class="font-medium"><?php echo e($student->parent?->name ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">School</div>
                <div class="font-medium"><?php echo e($student->school_name ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Jersey Number</div>
                <div class="font-medium"><?php echo e($student->jersey_number ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Jersey Name</div>
                <div class="font-medium"><?php echo e($student->jersey_name ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Membership Type</div>
                <div class="font-medium"><?php echo e($student->membership_type ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Program</div>
                <div class="font-medium"><?php echo e($student->program ?? '—'); ?></div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Joined</div>
                <div class="font-medium"><?php echo e(optional($student->joined_at)->format('M d, Y') ?? '—'); ?></div>
            </div>
        </div>

        <div class="mt-6">
            <a href="<?php echo e(route('coach.students.attendance', $student)); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">View Attendance History</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\coach\students\show.blade.php ENDPATH**/ ?>