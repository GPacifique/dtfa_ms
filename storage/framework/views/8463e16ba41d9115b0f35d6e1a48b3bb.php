<?php $title = 'Edit Office Equipment'; ?>


<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Edit Office Equipment</h1>
                <p class="text-slate-600 mt-1"><?php echo e($office_equipment->name); ?></p>
            </div>
            <a href="<?php echo e(route('admin.office-equipment.index')); ?>" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                ← Back to List
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
            <form action="<?php echo e(route('admin.office-equipment.update', $office_equipment)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="space-y-6">
                    <?php echo $__env->make('admin.office-equipment._form', ['office_equipment' => $office_equipment], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        ✅Save
                    </button>
                    <a href="<?php echo e(route('admin.office-equipment.show', $office_equipment)); ?>" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\office-equipment\edit.blade.php ENDPATH**/ ?>