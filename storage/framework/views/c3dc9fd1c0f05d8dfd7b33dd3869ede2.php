<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-slate-50 p-6">
    <div class="max-w-2xl w-full text-center">
        <div class="inline-flex items-center justify-center w-28 h-28 rounded-full bg-red-100 mx-auto">
            <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 9.75l4.5 4.5M14.25 9.75l-4.5 4.5"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12A9 9 0 113 12a9 9 0 0118 0z"></path></svg>
        </div>

        <h1 class="mt-6 text-4xl font-extrabold text-slate-900">404 — Page Not Found</h1>
        <p class="mt-3 text-slate-600">Sorry, we couldn't find the page you were looking for. It may have been moved, deleted, or the URL is incorrect.</p>

        <div class="mt-6 flex items-center justify-center gap-3">
            <button onclick="history.back()" class="inline-flex items-center px-4 py-2 bg-slate-800 text-white rounded shadow hover:bg-slate-700">Go Back</button>

            <?php if(Route::has('dashboard')): ?>
                <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded hover:bg-slate-50">Go to Dashboard</a>
            <?php else: ?>
                <a href="/" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded hover:bg-slate-50">Home</a>
            <?php endif; ?>
        </div>

        <div class="mt-6 text-sm text-slate-500">
            <span>If you think this is an error, <a href="mailto:<?php echo e(config('mail.from.address')); ?>" class="text-indigo-600 hover:underline">contact support</a> or try searching for what you need.</span>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/errors/404.blade.php ENDPATH**/ ?>