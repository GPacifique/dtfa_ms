<!-- Form Submission Component - Can be included in any view -->
<div class="fixed inset-0 bg-black/50 z-50 hidden modal-form-submission transition-opacity" id="formSubmissionModal">
    <div class="fixed inset-0 z-50 overflow-y-auto hidden modal-form-submission" id="formSubmissionModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="relative inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start mb-4">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white">Send Us a Message</h3>
                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">We'd love to hear from you. Fill out the form below.</p>
                        </div>
                    </div>

                    <form id="formSubmissionForm" class="space-y-4">
                        @csrf

                        <!-- Form Type -->
                        <div>
                            <label for="form_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Type <span class="text-red-500">*</span></label>
                            <select id="form_type" name="form_type" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                <option value="">Select a type</option>
                                <option value="contact">Contact Us</option>
                                <option value="complaint">Complaint</option>
                                <option value="feedback">Feedback</option>
                                <option value="incident">Incident Report</option>
                                <option value="suggestion">Suggestion</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="Brief subject" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Message <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="4" required placeholder="Tell us more..." class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                        </div>

                        <!-- Additional Fields Container (dynamic) -->
                        <div id="additionalFields"></div>

                        <!-- Submit Status -->
                        <div id="submitStatus" class="hidden p-3 rounded-lg"></div>
                    </form>
                </div>

                <div class="bg-slate-50 dark:bg-slate-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button type="button" onclick="document.getElementById('formSubmissionModal').classList.add('hidden')" class="w-full inline-flex justify-center rounded-lg border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 sm:ml-3 sm:w-auto sm:text-sm transition">
                        Cancel
                    </button>
                    <button type="button" onclick="submitFormSubmission()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focusring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openFormSubmissionModal() {
        document.getElementById('formSubmissionModal').classList.remove('hidden');
    }

    function closeFormSubmissionModal() {
        document.getElementById('formSubmissionModal').classList.add('hidden');
    }

    async function submitFormSubmission() {
        const form = document.getElementById('formSubmissionForm');
        const statusDiv = document.getElementById('submitStatus');

        try {
            const formData = new FormData(form);
            const response = await fetch('{{ route("api.form-submissions.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });

            const data = await response.json();

            if (response.ok) {
                statusDiv.className = 'p-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200';
                statusDiv.innerHTML = `
                    <p class="font-semibold">✓ Success!</p>
                    <p>${data.message}</p>
                `;
                statusDiv.classList.remove('hidden');
                form.reset();

                setTimeout(() => {
                    closeFormSubmissionModal();
                    statusDiv.classList.add('hidden');
                }, 3000);
            } else {
                statusDiv.className = 'p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200';
                statusDiv.innerHTML = `<p>${data.message || 'Something went wrong'}</p>`;
                statusDiv.classList.remove('hidden');
            }
        } catch (error) {
            statusDiv.className = 'p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200';
            statusDiv.innerHTML = `<p>${error.message}</p>`;
            statusDiv.classList.remove('hidden');
        }
    }
</script>

<!-- Button to trigger modal - Add this anywhere you want to show the form -->
<button onclick="openFormSubmissionModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
    ✉️ Send Message
</button>
