<?php $title = $student->first_name . ' - Payment History'; ?>


<?php $__env->startSection('content'); ?>
<div class="container-page">
    <div class="mb-6">
        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => route('parent.dashboard'),'variant' => 'secondary','class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('parent.dashboard')),'variant' => 'secondary','class' => 'mb-4']); ?>
            ← Back to Children
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
        <h1 class="page-title"><?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?> - Payment History</h1>
    </div>

    <?php if($student->subscriptions->isEmpty()): ?>
        <div class="card">
            <div class="card-body text-center py-8 text-slate-500">
                No subscription found for this child.
            </div>
        </div>
    <?php else: ?>
        <?php $subscription = $student->subscriptions->first(; ?>)

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-sm text-slate-600 mb-1">Plan</div>
                    <div class="text-lg font-semibold text-slate-900"><?php echo e($subscription->plan->name); ?></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-sm text-slate-600 mb-1">Outstanding Balance</div>
                    <div class="text-lg font-semibold
                        <?php if($subscription->outstanding_balance > 0): ?> text-red-600
                        <?php else: ?> text-green-600
                        <?php endif; ?>">
                        <?php echo e(number_format($subscription->outstanding_balance, 0)); ?> RWF
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-sm text-slate-600 mb-1">Total Paid</div>
                    <div class="text-lg font-semibold text-green-600">
                        <?php echo e(number_format($subscription->total_paid, 0)); ?> RWF
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="text-lg font-semibold">Invoices</h2>
            </div>
            <div class="card-body p-0">
                <?php if($subscription->invoices->isEmpty()): ?>
                    <div class="text-center py-8 text-slate-500">No invoices yet.</div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $subscription->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($invoice->due_date->format('M d, Y')); ?></td>
                                        <td><?php echo e(number_format($invoice->amount_cents, 0)); ?> <?php echo e($invoice->currency); ?></td>
                                        <td><?php echo e(number_format($invoice->total_paid, 0)); ?> <?php echo e($invoice->currency); ?></td>
                                        <td class="font-semibold
                                            <?php if($invoice->outstanding_balance > 0): ?> text-red-600
                                            <?php else: ?> text-green-600
                                            <?php endif; ?>">
                                            <?php echo e(number_format($invoice->outstanding_balance, 0)); ?> <?php echo e($invoice->currency); ?>

                                        </td>
                                        <td>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                <?php if($invoice->status === 'paid'): ?> bg-green-100 text-green-800
                                                <?php elseif($invoice->status === 'overdue'): ?> bg-red-100 text-red-800
                                                <?php elseif($invoice->status === 'cancelled'): ?> bg-slate-100 text-slate-800
                                                <?php else: ?> bg-yellow-100 text-yellow-800
                                                <?php endif; ?>">
                                                <?php echo e(ucfirst($invoice->status)); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card mt-6">
            <div class="card-header">
                <h2 class="text-lg font-semibold">Payments</h2>
            </div>
            <div class="card-body p-0">
                <?php $payments = $subscription->payments; ?>
                <?php if($payments->isEmpty()): ?>
                    <div class="text-center py-8 text-slate-500">No payments yet.</div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Reference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($payment->payment_date->format('M d, Y')); ?></td>
                                        <td><?php echo e(number_format($payment->amount_cents, 0)); ?> <?php echo e($payment->currency); ?></td>
                                        <td><?php echo e(ucfirst(str_replace('_', ' ', $payment->payment_method))); ?></td>
                                        <td>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                <?php if($payment->status === 'succeeded'): ?> bg-green-100 text-green-800
                                                <?php elseif($payment->status === 'failed'): ?> bg-red-100 text-red-800
                                                <?php else: ?> bg-yellow-100 text-yellow-800
                                                <?php endif; ?>">
                                                <?php echo e(ucfirst($payment->status)); ?>

                                            </span>
                                        </td>
                                        <td class="text-sm text-slate-600"><?php echo e($payment->reference ?? '—'); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\parent\child-payments.blade.php ENDPATH**/ ?>