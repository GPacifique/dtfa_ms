<?php $__env->startSection('content'); ?>
<div class="container">

    <h2>Add Training</h2>

    <form action="<?php echo e(route('capacity_buildings.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Second Name</label>
                <input type="text" name="second_name" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Country</label>
                <select name="country" class="form-control">
                    <option>Rwanda</option>
                    <option>Tanzania</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>City</label>
                <select name="city" class="form-control">
                    <option>Kigali</option>
                    <option>Mwanza</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Discipline</label>
                <select name="discipline" class="form-control">
                    <option>Football</option>
                    <option>BasketBall</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Branch</label>
                <select name="branch_id" class="form-control">
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($b->id); ?>"><?php echo e($b->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Role</label>
                <select name="role_id" class="form-control">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($r->id); ?>"><?php echo e($r->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Training Name</label>
                <input type="text" name="training_name" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Start</label>
                <input type="datetime-local" name="start" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>End</label>
                <input type="datetime-local" name="end" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Cost</label>
                <select name="cost" class="form-control">
                    <option>Paid</option>
                    <option>Free</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Training Category</label>
                <select name="training_category" class="form-control">
                    <option>In house</option>
                    <option>Outside DTFA</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Venue</label>
                <input type="text" name="venue" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Location</label>
                <input type="text" name="location" class="form-control">
            </div>

        </div>

        <button class="btn btn-success mt-3">Save Training</button>

    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\capacity_buildings\create.blade.php ENDPATH**/ ?>