<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Create Task</h2>

    <form action="<?php echo e(route('admin.tasks.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <!-- Staff -->
        <div class="mb-4">
            <label class="font-semibold">Name of Staff</label>
            <select name="staff_id" class="form-select w-full" required>
                <option value="">Select Staff</option>
                <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->first_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Goal -->
        <div class="mb-4">
            <label class="font-semibold">Goal</label>
            <input type="text" name="goal" class="form-input w-full">
        </div>

        <!-- Objective -->
        <div class="mb-4">
            <label class="font-semibold">Objective</label>
            <input type="text" name="objective" class="form-input w-full">
        </div>

        <!-- Activities -->
        <div class="mb-4">
            <label class="font-semibold">Activities</label>
            <textarea name="activities" rows="3" class="form-textarea w-full"></textarea>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Starting Date</label>
                <input type="date" name="start_date" class="form-input w-full">
            </div>

            <div>
                <label class="font-semibold">Ending Date</label>
                <input type="date" name="end_date" class="form-input w-full">
            </div>
        </div>

        <!-- Reporting -->
        <div class="mt-4">
            <label class="font-semibold">Reporting</label>
            <textarea name="reporting" rows="2" class="form-textarea w-full"></textarea>
        </div>

        <!-- Message -->
        <div class="mt-4">
            <label class="font-semibold">Message</label>
            <textarea name="message" rows="2" class="form-textarea w-full"></textarea>
        </div>

        <div class="mt-6">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Save Task</button>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\tasks\create.blade.php ENDPATH**/ ?>