<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => 'Invoice Management','subtitle' => 'Track and manage student invoices']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Invoice Management','subtitle' => 'Track and manage student invoices']); ?>
        <a href="<?php echo e(route('accountant.invoices.create')); ?>" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-violet-600 to-violet-700 hover:from-violet-700 hover:to-violet-800 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">Create Invoice</a>
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
<div class="container mx-auto px-4 py-8">


    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-violet-100 text-sm font-medium uppercase tracking-wide">Total Invoices</p>
                    <p class="text-4xl font-bold mt-2"><?php echo e($invoices->total()); ?></p>
                    <p class="text-xs text-violet-100 mt-1">Records</p>
                </div>
                <div class="bg-violet-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium uppercase tracking-wide">Total Amount</p>
                    <p class="text-4xl font-bold mt-2"><?php echo e(number_format($invoices->sum(fn($i) => $i->amount_cents), 0)); ?></p>
                    <p class="text-xs text-emerald-100 mt-1">RWF</p>
                </div>
                <div class="bg-emerald-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm font-medium uppercase tracking-wide">Pending</p>
                    <p class="text-4xl font-bold mt-2"><?php echo e($invoices->where('status', 'pending')->count()); ?></p>
                    <p class="text-xs text-amber-100 mt-1">Awaiting payment</p>
                </div>
                <div class="bg-amber-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium uppercase tracking-wide">Overdue</p>
                    <p class="text-4xl font-bold mt-2"><?php echo e($invoices->where('status', 'overdue')->count()); ?></p>
                    <p class="text-xs text-red-100 mt-1">Requires attention</p>
                </div>
                <div class="bg-red-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <form method="GET" action="<?php echo e(route('accountant.invoices.index')); ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">📅 Filter by Month</label>
                <select name="month" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition" onchange="this.form.submit()">
                    <option value="all" <?php echo e(request('month') === 'all' ? 'selected' : ''); ?>>🌍 All Time</option>
                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m['value']); ?>" <?php echo e(request('month', now()->format('Y-m')) === $m['value'] ? 'selected' : ''); ?>>
                            <?php echo e($m['label']); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">🔍 Search Student</label>
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Student name..." class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2.5 bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-lg transition">
                    Apply Filters
                </button>
            </div>
            <div class="flex items-end">
                <a href="<?php echo e(route('accountant.invoices.index')); ?>" class="w-full px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition text-center">
                    🔄 Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Due Date</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Subscription</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Paid</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Balance</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-violet-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                <?php echo e($inv->due_date->format('M d, Y')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700 font-medium">
                                <?php echo e($inv->subscription->student->first_name); ?> <?php echo e($inv->subscription->student->second_name); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    <?php echo e($inv->subscription->plan->name); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-right text-slate-900">
                                <?php echo e(number_format($inv->amount_cents, 0)); ?> <span class="text-xs text-slate-500"><?php echo e($inv->currency); ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-emerald-600 font-semibold">
                                <?php echo e(number_format($inv->total_paid, 0)); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold <?php echo e($inv->outstanding_balance > 0 ? 'text-red-600' : 'text-slate-400'); ?>">
                                <?php echo e(number_format($inv->outstanding_balance, 0)); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($inv->status === 'paid'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                        ✓ Paid
                                    </span>
                                <?php elseif($inv->status === 'overdue'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                        ⚠ Overdue
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                        ⏳ Pending
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a class="text-indigo-600 hover:text-indigo-900 mr-3 transition" href="<?php echo e(route('accountant.invoices.edit', $inv)); ?>">Edit</a>
                                <form class="inline" method="POST" action="<?php echo e(route('accountant.invoices.destroy', $inv)); ?>" onsubmit="return confirm('Delete this invoice?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="text-red-600 hover:text-red-900 transition" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-4 text-lg font-medium">No invoices found</p>
                                <p class="mt-1 text-sm">Try adjusting your filters or create a new invoice</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4"><?php echo e($invoices->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\accountant\invoices\index.blade.php ENDPATH**/ ?>