<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">🏫 In-House Trainings</h1>
        <a href="<?php echo e(route('trainings.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Training</a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Training Name</th>
                <th>Discipline</th>
                <th>Country</th>
                <th>Start</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($t->id); ?></td>
                <td><?php echo e($t->training_name); ?></td>
                <td><?php echo e($t->discipline); ?></td>
                <td><?php echo e($t->country); ?></td>
                <td><?php echo e($t->start); ?></td>
                <td><?php echo e($t->branch->name ?? ''); ?></td>

                <td>
                    <a href="<?php echo e(route('trainings.show', $t->id)); ?>" class="btn btn-info btn-sm">View</a>
                    <a href="<?php echo e(route('trainings.edit', $t->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                    <form action="<?php echo e(route('trainings.destroy', $t->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($trainings->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\capacity_buildings\index.blade.php ENDPATH**/ ?>