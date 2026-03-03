<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => __('app.attendance') . ': ' . ($session->date->format('M d, Y')),'subtitle' => $session->group->name ?? $session->group_name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('app.attendance') . ': ' . ($session->date->format('M d, Y'))),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($session->group->name ?? $session->group_name)]); ?>
        <div class="mt-4">
            <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="btn-secondary">← <?php echo e(__('app.back_to_sessions')); ?></a>
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

    <form method="POST" action="<?php echo e(route('admin.sessions.attendance.store', $session)); ?>">
        <?php echo csrf_field(); ?>

        <div class="bg-white shadow rounded p-4 mb-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left"><?php echo e(__('app.student')); ?></th>
                        <th class="text-left"><?php echo e(__('app.status')); ?></th>
                        <th class="text-left"><?php echo e(__('app.notes')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $rec = $existing->get($student->id);
                            $status = $rec?->status ?? 'absent';
                            $notes = $rec?->notes ?? '';
                        ?>
                        <tr class="border-t">
                            <td class="py-2"><?php echo e($student->name ?? ($student->first_name . ' ' . ($student->last_name ?? ''))); ?></td>
                            <td class="py-2">
                                <select name="attendances[<?php echo e($student->id); ?>][status]" class="border p-1">
                                    <option value="present" <?php echo e($status === 'present' ? 'selected' : ''); ?>><?php echo e(__('app.present')); ?></option>
                                    <option value="absent" <?php echo e($status === 'absent' ? 'selected' : ''); ?>><?php echo e(__('app.absent')); ?></option>
                                    <option value="late" <?php echo e($status === 'late' ? 'selected' : ''); ?>><?php echo e(__('app.late')); ?></option>
                                    <option value="excused" <?php echo e($status === 'excused' ? 'selected' : ''); ?>><?php echo e(__('app.excused')); ?></option>
                                </select>
                            </td>
                            <td class="py-2">
                                <input type="text" name="attendances[<?php echo e($student->id); ?>][notes]" class="border p-1 w-full" value="<?php echo e(old('attendances.'.$student->id.'.notes', $notes)); ?>">
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="py-4 text-sm text-slate-500"><?php echo e(__('app.no_students_found_session')); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded"><?php echo e(__('app.save_attendance')); ?></button>
            <a href="<?php echo e(route('admin.sessions.recordAllAttendance', $session)); ?>" class="px-4 py-2 bg-emerald-500 text-white rounded" onclick="return confirm('<?php echo e(__('app.confirm_mark_all_present')); ?>');"><?php echo e(__('app.mark_all_present')); ?></a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\inhousetrainings\attendance.blade.php ENDPATH**/ ?>