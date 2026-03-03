<?php $title = __('app.parent_dashboard'; ?>)


<?php $__env->startSection('content'); ?>
<div class="container-page">
    <h1 class="page-title mb-6"><?php echo e(__('app.my_children')); ?></h1>

    <?php if($children->isEmpty()): ?>
        <div class="card">
            <div class="card-body text-center py-8 text-slate-500">
                <?php echo e(__('app.no_children_associated')); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-xl font-semibold text-slate-900 mb-4">
                            <?php echo e($child->first_name); ?> <?php echo e($child->second_name); ?>

                        </h2>

                        <?php if($child->subscriptions->isEmpty()): ?>
                            <div class="text-sm text-slate-500 mb-4"><?php echo e(__('app.no_active_subscription')); ?></div>
                        <?php else: ?>
                            <?php $subscription = $child->subscriptions->first(; ?>)
                            <div class="space-y-3 mb-4">
                                <div>
                                    <div class="text-sm text-slate-600"><?php echo e(__('app.plan')); ?></div>
                                    <div class="font-medium text-slate-900"><?php echo e($subscription->plan->name); ?></div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-600"><?php echo e(__('app.status')); ?></div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        <?php if($subscription->status === 'active'): ?> bg-green-100 text-green-800
                                        <?php elseif($subscription->status === 'paused'): ?> bg-yellow-100 text-yellow-800
                                        <?php elseif($subscription->status === 'expired'): ?> bg-red-100 text-red-800
                                        <?php else: ?> bg-slate-100 text-slate-800
                                        <?php endif; ?>">
                                        <?php echo e(ucfirst($subscription->status)); ?>

                                    </span>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-600"><?php echo e(__('app.outstanding_balance')); ?></div>
                                    <div class="font-semibold
                                        <?php if($subscription->outstanding_balance > 0): ?> text-red-600
                                        <?php else: ?> text-green-600
                                        <?php endif; ?>">
                                        <?php echo e(number_format($subscription->outstanding_balance, 0)); ?> RWF
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-600"><?php echo e(__('app.total_invoiced')); ?></div>
                                    <div class="text-slate-900"><?php echo e(number_format($subscription->total_invoiced, 0)); ?> RWF</div>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-600"><?php echo e(__('app.total_paid')); ?></div>
                                    <div class="text-slate-900"><?php echo e(number_format($subscription->total_paid, 0)); ?> RWF</div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => route('parent.child-payments', $child),'variant' => 'primary','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('parent.child-payments', $child)),'variant' => 'primary','class' => 'w-full']); ?>
                            <?php echo e(__('app.view_payment_history')); ?>

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
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\parent\dashboard.blade.php ENDPATH**/ ?>