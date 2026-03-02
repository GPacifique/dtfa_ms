<?php $__env->startSection('title', 'Create Student Attendance'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-8">
    <div class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800">
        <strong>Debug: Available Students (<?php echo e($students->count()); ?>)</strong>
        <ul class="list-disc pl-6">
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>ID: <?php echo e($student->id); ?> - <?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <h1 class="text-2xl font-bold mb-6">Create Student Attendance for <?php echo e($date); ?></h1>
    <form method="POST" action="<?php echo e(route('admin.student-attendance.store')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="date" value="<?php echo e($date); ?>">
        <table class="min-w-full bg-white border border-slate-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Student</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="px-4 py-2 border"><?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?></td>
                    <td class="px-4 py-2 border">
                        <select name="attendance[<?php echo e($student->id); ?>]" class="border rounded px-2 py-1">
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                            <option value="late">Late</option>
                            <option value="excused">Excused</option>
                        </select>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="mt-6">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Save Attendance</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/attendance/create.blade.php ENDPATH**/ ?>