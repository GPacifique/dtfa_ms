<?php $__env->startSection('hero'); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['title' => $user->name,'subtitle' => $user->email]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->name),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->email)]); ?>
        <div class="mt-4 flex items-center gap-2">
            <a href="<?php echo e(route('user.profile.show', $user)); ?>" class="btn-outline">👤 View Profile</a>
            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="btn-primary">Edit User</a>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn-secondary">Back to Users</a>
        </div>
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
<div class="max-w-6xl mx-auto p-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Details -->
        <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">User Details</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Name</p>
                    <p class="font-medium"><?php echo e($user->name); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                    <p class="font-medium break-all"><?php echo e($user->email); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Branch</p>
                    <p class="font-medium"><?php echo e($user->branch?->name ?? '—'); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Group</p>
                    <p class="font-medium"><?php echo e($user->group?->name ?? '—'); ?></p>
                </div>
            </div>
        </div>

        <!-- Roles & Permissions -->
        <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Roles</h2>
            <div class="space-y-2">
                <?php if($user->roles->count() > 0): ?>
                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="inline-block px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-sm font-medium">
                            <?php echo e(ucfirst($role->name)); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="text-gray-500 dark:text-gray-400">No roles assigned</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 flex flex-col">
            <h2 class="text-lg font-semibold mb-4">Actions</h2>
            <div class="flex-1 overflow-y-auto space-y-2 max-h-64">
                <form method="POST" action="<?php echo e(route('admin.users.sendReset', $user)); ?>" class="block">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                        Send Password Reset
                    </button>
                </form>

                <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-center text-sm">
                    Edit User
                </a>

                <?php if($user->id !== auth()->id()): ?>
                    <form method="POST" action="<?php echo e(route('admin.users.destroy', $user)); ?>" onsubmit="return confirm('Are you sure you want to delete this user?')" class="block">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                            Delete User
                        </button>
                    </form>
                <?php endif; ?>

                <a href="<?php echo e(route('admin.users.index')); ?>" class="block px-4 py-2 border rounded hover:bg-gray-100 dark:hover:bg-neutral-800 text-center text-sm">
                    Back to Users
                </a>
            </div>
        </div>
    </div>

    <!-- Activity Section (Optional) -->
    <?php if(method_exists($user, 'auditLogs')): ?>
        <div class="mt-6 bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b dark:border-neutral-700">
                        <tr>
                            <th class="text-left py-2">Event</th>
                            <th class="text-left py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $user->auditLogs()->latest()->limit(10)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-b dark:border-neutral-700">
                                <td class="py-2"><?php echo e($log->event); ?></td>
                                <td class="py-2"><?php echo e($log->created_at->format('M d, Y H:i')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="2" class="py-2 text-gray-500 dark:text-gray-400">No activity recorded</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\users\show.blade.php ENDPATH**/ ?>