<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Record Income','subtitle' => 'Add a new income entry']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Record Income','subtitle' => 'Add a new income entry']); ?>
        <a href="<?php echo e(route('admin.incomes.index')); ?>"
           class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg transition">
            ← Back to Incomes
        </a>
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
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-md p-6">

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Record Income</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Capture a new income entry with category, source, and timing.
            </p>
        </div>

        <?php if($errors->any()): ?>
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-300">
                <ul class="list-disc list-inside space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.incomes.store')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                
                <div>
                    <label class="label">Branch</label>
                    <select name="branch_id" class="input">
                        <option value="">Select branch</option>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($b->id); ?>" <?php if(old('branch_id') == $b->id): echo 'selected'; endif; ?>>
                                <?php echo e($b->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label class="label">Amount <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input id="amount" name="amount" type="text"
                               value="<?php echo e(old('amount')); ?>"
                               class="input pr-16"
                               placeholder="250,000" required>
                        <span class="absolute right-3 top-2.5 text-sm text-slate-500">RWF</span>
                    </div>
                </div>

                
                <div>
                    <label class="label">Currency</label>
                    <input name="currency" value="<?php echo e(old('currency', 'RWF')); ?>" class="input uppercase">
                </div>

                
                <div>
                    <label class="label">Category</label>
                    <input list="categoryOptions" name="category" value="<?php echo e(old('category')); ?>" class="input">
                    <datalist id="categoryOptions">
                        <option value="fees"></option>
                        <option value="donation"></option>
                        <option value="sponsorship"></option>
                        <option value="ticket_sales"></option>
                        <option value="other"></option>
                    </datalist>
                </div>

                
                <div>
                    <label class="label">Source</label>
                    <input list="sourceOptions" name="source" value="<?php echo e(old('source')); ?>" class="input">
                    <datalist id="sourceOptions">
                        <option value="cash"></option>
                        <option value="mobile_money"></option>
                        <option value="bank_transfer"></option>
                    </datalist>
                </div>

                
                <div>
                    <label class="label">Received At</label>
                    <input type="datetime-local" name="received_at" value="<?php echo e(old('received_at')); ?>" class="input">
                </div>

                
                <div class="md:col-span-2">
                    <label class="label">Notes</label>
                    <textarea name="notes" rows="3" class="input"></textarea>
                </div>

            </div>

            
            <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="<?php echo e(route('admin.incomes.index')); ?>"
                   class="px-4 py-2 border rounded-lg text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg shadow transition">
                    Save Income
                </button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Documents\GitHub\dtfa_ms\resources\views/admin/incomes/create.blade.php ENDPATH**/ ?>