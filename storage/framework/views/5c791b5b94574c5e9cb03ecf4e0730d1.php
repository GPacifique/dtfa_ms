<?php $__env->startPush('hero'); ?>
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
        <a href="<?php echo e(route('admin.incomes.index')); ?>" class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Incomes</a>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto">
    <div class="card p-6">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-1">Record Income</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Capture a new income entry with category, source, and timing.</p>

        <?php if($errors->any()): ?>
            <div class="mb-6 rounded-lg border border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-300">
                <div class="font-semibold mb-1">Please fix the following:</div>
                <ul class="list-disc list-inside space-y-0.5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.incomes.store')); ?>" class="space-y-8">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Branch -->
                <div class="col-span-1">
                    <label for="branch_id" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Branch</label>
                    <select id="branch_id" name="branch_id" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">-- Select branch --</option>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($b->id); ?>" <?php if(old('branch_id')==$b->id): echo 'selected'; endif; ?>><?php echo e($b->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['branch_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Amount -->
                <div class="col-span-1">
                    <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Amount <span class="text-red-600">*</span></label>
                    <div class="relative">
                        <input id="amount" name="amount" type="text" inputmode="numeric" autocomplete="off" placeholder="e.g. 250,000" value="<?php echo e(old('amount')); ?>" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 pr-16 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500" required>
                        <span class="absolute inset-y-0 right-3 inline-flex items-center text-xs text-slate-500">RWF</span>
                    </div>
                    <p class="mt-1 text-xs text-slate-500">Enter whole amount; commas allowed.</p>
                    <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Currency -->
                <div class="col-span-1">
                    <label for="currency" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Currency</label>
                    <input id="currency" name="currency" type="text" value="<?php echo e(old('currency', 'RWF')); ?>" class="w-full uppercase rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                    <p class="mt-1 text-xs text-slate-500">ISO code (e.g., RWF, USD, EUR)</p>
                    <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Category -->
                <div class="col-span-1">
                    <label for="category" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Category</label>
                    <input list="categoryOptions" id="category" name="category" type="text" value="<?php echo e(old('category')); ?>" placeholder="e.g. sponsorship" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                    <datalist id="categoryOptions">
                        <option value="fees" />
                        <option value="donation" />
                        <option value="sponsorship" />
                        <option value="ticket_sales" />
                        <option value="merchandise" />
                        <option value="other" />
                    </datalist>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Source -->
                <div class="col-span-1">
                    <label for="source" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Source</label>
                    <input list="sourceOptions" id="source" name="source" type="text" value="<?php echo e(old('source')); ?>" placeholder="e.g. mobile_money" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                    <datalist id="sourceOptions">
                        <option value="cash" />
                        <option value="mobile_money" />
                        <option value="bank_transfer" />
                        <option value="cheque" />
                        <option value="other" />
                    </datalist>
                    <?php $__errorArgs = ['source'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Received at -->
                <div class="col-span-1">
                    <label for="received_at" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Received At</label>
                    <input id="received_at" name="received_at" type="datetime-local" value="<?php echo e(old('received_at')); ?>" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                    <p class="mt-1 text-xs text-slate-500">Leave blank to default to now.</p>
                    <?php $__errorArgs = ['received_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Notes</label>
                    <textarea id="notes" name="notes" rows="3" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Optional notes or references"><?php echo e(old('notes')); ?></textarea>
                    <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="<?php echo e(route('admin.incomes.index')); ?>" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">Cancel</a>
                <button class="btn-primary">Save Income</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Simple currency formatting for amount (allows digits and commas)
    (function() {
        const el = document.getElementById('amount');
        if (!el) return;
        const format = (val) => {
            const digits = (val || '').toString().replace(/[^0-9]/g, '');
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        };
        // Initial format if prefilled
        el.value = format(el.value);
        el.addEventListener('input', () => { el.value = format(el.value); });
        el.addEventListener('blur', () => { el.value = format(el.value); });
    })();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/incomes/create.blade.php ENDPATH**/ ?>