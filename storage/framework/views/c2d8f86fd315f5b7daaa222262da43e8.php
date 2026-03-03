<?php
    $locales = \App\Http\Controllers\LanguageController::$locales;
    $currentLocale = app()->getLocale();
?>

<div class="relative" x-data="{ open: false }">
    <!-- Current Language Button -->
    <button
        @click="open = !open"
        @click.away="open = false"
        type="button"
        class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-600 rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200"
    >
        <span class="text-lg"><?php echo e($locales[$currentLocale]['flag'] ?? '🌐'); ?></span>
        <span class="hidden sm:inline"><?php echo e($locales[$currentLocale]['native'] ?? 'Language'); ?></span>
        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Dropdown Menu -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-xl bg-white dark:bg-neutral-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none overflow-hidden"
        style="display: none;"
    >
        <div class="py-1">
            <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a
                    href="<?php echo e(route('language.switch', $code)); ?>"
                    class="flex items-center gap-3 px-4 py-2.5 text-sm <?php echo e($currentLocale === $code ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-neutral-700'); ?> transition-colors duration-150"
                >
                    <span class="text-xl"><?php echo e($locale['flag']); ?></span>
                    <div class="flex flex-col">
                        <span class="font-medium"><?php echo e($locale['native']); ?></span>
                        <span class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($locale['name']); ?></span>
                    </div>
                    <?php if($currentLocale === $code): ?>
                        <svg class="w-4 h-4 ml-auto text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/components/language-switcher.blade.php ENDPATH**/ ?>