<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold"><?php echo e($team->name); ?></h2>
            <div>
                <a href="<?php echo e(route('admin.teams.edit', $team)); ?>" class="btn btn-secondary mr-2">Edit</a>
                <a href="<?php echo e(route('admin.teams.index')); ?>" class="btn">Back to teams</a>
            </div>
        </div>

        <?php if($team->description): ?>
            <div class="mb-4 p-4 bg-white shadow rounded"><?php echo e($team->description); ?></div>
        <?php endif; ?>

        <div class="bg-white shadow rounded p-4">
            <h3 class="font-semibold mb-2">Players (<?php echo e($team->players->count()); ?>)</h3>
            <?php if($team->players->isEmpty()): ?>
                <p class="text-sm text-slate-500">No players assigned.</p>
            <?php else: ?>
                <ul class="list-disc pl-5">
                    <?php $__currentLoopData = $team->players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($player->name ?? ($player->first_name . ' ' . ($player->last_name ?? ''))); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\teams\show.blade.php ENDPATH**/ ?>