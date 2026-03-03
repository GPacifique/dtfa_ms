<?php $__env->startSection('content'); ?>
<div class="container">

    <h2>Training Details</h2>

    <div class="card p-4">

        <p><strong>Name:</strong> <?php echo e($training->training_name); ?></p>
        <p><strong>First Name:</strong> <?php echo e($training->first_name); ?></p>
        <p><strong>Discipline:</strong> <?php echo e($training->discipline); ?></p>
        <p><strong>Country:</strong> <?php echo e($training->country); ?></p>
        <p><strong>Start:</strong> <?php echo e($training->start); ?></p>
        <p><strong>End:</strong> <?php echo e($training->end); ?></p>
        <p><strong>Branch:</strong> <?php echo e($training->branch->name); ?></p>

        <a href="<?php echo e(route('trainings.index')); ?>" class="btn btn-secondary mt-3">Back</a>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\capacity_buildings\edit.blade.php ENDPATH**/ ?>