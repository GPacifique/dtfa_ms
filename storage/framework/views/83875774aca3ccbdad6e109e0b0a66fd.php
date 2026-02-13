<footer class="bg-slate-900 text-slate-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-8 items-start">
            <div class="space-y-3">
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3">
                    <img src="<?php echo e(asset('logo.jpeg')); ?>" alt="DTFA logo" class="w-8 h-8 rounded-md">
                    <div>
                        <div class="font-semibold text-white">DTFA — Sport Academy</div>
                        <div class="text-slate-400 text-sm">Developing talent since <?php echo e(date('Y', strtotime('-3 years'))); ?></div>
                    </div>
                </a>

                <div class="flex items-center gap-3 mt-3">
                    <a href="#" class="text-slate-400 hover:text-white" aria-label="Twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0016 3a4.48 4.48 0 00-4.47 4.47c0 .35.04.69.11 1.02A12.94 12.94 0 013 4.67s-4 9 5 13a13 13 0 01-8 2c9 5 20 0 20-11.5v-.5A7 7 0 0023 3z"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-white" aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-3h2v-2.2c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.3l-.4 3h-1.9v7A10 10 0 0022 12z"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-white" aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm5 6.3A3.7 3.7 0 1015.7 12 3.7 3.7 0 0012 8.3zM18.5 6a1.5 1.5 0 11-1.5-1.5A1.5 1.5 0 0118.5 6z"/></svg>
                    </a>
                </div>
            </div>

            <div class="text-sm">
                <div class="font-semibold text-white mb-2">Quick Links</div>
                <ul class="space-y-1">
                    <li><a href="#" onclick="showPrivacyModal(event)" class="text-slate-400 hover:text-white">Privacy Policy</a></li>
                    <li><a href="#" onclick="showTermsModal(event)" class="text-slate-400 hover:text-white">Terms of Service</a></li>
                    <li><a href="#" onclick="showHelpModal(event)" class="text-slate-400 hover:text-white">Help & Support</a></li>
                </ul>
            </div>

            <div class="text-sm">
                <div class="font-semibold text-white mb-2">Contact</div>
                <div class="text-slate-400">Phone: <a href="tel:0786163963" class="text-slate-200">0786 163 963</a></div>
                <div class="text-slate-400">Email: <a href="mailto:info@sportacademyms.com" class="text-slate-200">info@sportacademyms.com</a></div>
                <div class="text-slate-400 mt-2">Kigali, Rwanda</div>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-4 pb-8 flex flex-col md:flex-row items-center justify-between gap-3">
            <div class="text-slate-500 text-sm">&copy; <?php echo e(date('Y')); ?> Sport Academy MS — All rights reserved.</div>
            <div class="text-slate-400 text-xs">Built with ❤️ — Data & tools for coaches and admins</div>
        </div>
    </div>
</footer>

<!-- Simple modals (privacy / terms / help) -->
<?php if (! $__env->hasRenderedOnce('4add8c92-058e-438b-a3e3-35fe1d3fa2f2')): $__env->markAsRenderedOnce('4add8c92-058e-438b-a3e3-35fe1d3fa2f2'); ?>
    <?php $__env->startPush('footer-scripts'); ?>
        <script>
            function showModal(id){
                const m = document.getElementById(id);
                if(!m) return;
                m.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            function closeModal(id){
                const m = document.getElementById(id);
                if(!m) return;
                m.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
            document.addEventListener('keydown', function(e){ if(e.key === 'Escape'){ ['modal-privacy','modal-terms','modal-help'].forEach(id=>closeModal(id)); } });
        </script>
    <?php $__env->stopPush(); ?>

    <div id="modal-privacy" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 px-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold">Privacy Policy</h3>
                <button onclick="closeModal('modal-privacy')" class="text-slate-600">Close</button>
            </div>
            <p class="text-sm text-slate-700">We collect and store only the data necessary to run academy operations. Last updated: <?php echo e(date('F Y')); ?>.</p>
        </div>
    </div>

    <div id="modal-terms" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 px-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold">Terms of Service</h3>
                <button onclick="closeModal('modal-terms')" class="text-slate-600">Close</button>
            </div>
            <p class="text-sm text-slate-700">By using our services you agree to our terms. Please contact support for details.</p>
        </div>
    </div>

    <div id="modal-help" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 px-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold">Help & Support</h3>
                <button onclick="closeModal('modal-help')" class="text-slate-600">Close</button>
            </div>
            <p class="text-sm text-slate-700">Contact us at <a href="mailto:info@sportacademyms.com" class="text-slate-900 font-semibold">info@sportacademyms.com</a> or call <a href="tel:0786163963" class="text-slate-900 font-semibold">0786 163 963</a>.</p>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/components/app-footer.blade.php ENDPATH**/ ?>