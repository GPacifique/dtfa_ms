<?php $title = __('app.subscriptions'; ?>)


<?php $__env->startSection('content'); ?>
<div class="container-page space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="page-title"><?php echo e(__('app.subscriptions')); ?></h1>
        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => route('accountant.subscriptions.create'),'variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('accountant.subscriptions.create')),'variant' => 'primary']); ?><?php echo e(__('app.assign_subscription')); ?> <?php echo $__env->renderComponent(); ?>
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
    <div class="card overflow-hidden">
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo e(__('app.student')); ?></th>
                    <th><?php echo e(__('app.plan')); ?></th>
                    <th><?php echo e(__('app.status')); ?></th>
                    <th><?php echo e(__('app.start')); ?></th>
                    <th><?php echo e(__('app.next_billing')); ?></th>
                    <th class="text-right"><?php echo e(__('app.actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-4 py-3"><?php echo e($s->student->first_name); ?> <?php echo e($s->student->second_name); ?></td>
                        <td class="px-4 py-3"><?php echo e($s->plan->name); ?></td>
                        <td class="px-4 py-3">
                            <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => ''.e($s->status === 'active' ? 'green' : 'slate').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => ''.e($s->status === 'active' ? 'green' : 'slate').'']); ?><?php echo e(ucfirst($s->status)); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                        </td>
                        <td class="px-4 py-3"><?php echo e(optional($s->start_date)->format('Y-m-d')); ?></td>
                        <td class="px-4 py-3"><?php echo e(optional($s->next_billing_date)->format('Y-m-d')); ?></td>
                        <td class="px-4 py-3 text-right">
                            <a class="text-indigo-700 hover:underline px-2" href="<?php echo e(route('accountant.subscriptions.edit', $s)); ?>"><?php echo e(__('app.edit')); ?></a>
                            <form class="inline" method="POST" action="<?php echo e(route('accountant.subscriptions.destroy', $s)); ?>" onsubmit="return confirm('<?php echo e(__('app.confirm_delete')); ?>');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="text-red-700 hover:underline px-2" type="submit"><?php echo e(__('app.delete')); ?></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($subs->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\accountant\subscriptions\index.blade.php ENDPATH**/ ?>