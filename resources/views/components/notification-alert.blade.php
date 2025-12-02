{{-- Notification Alert Component --}}
<div x-data="{
    notifications: [],
    addNotification(type, message) {
        const id = Date.now();
        this.notifications.push({ id, type, message });
        setTimeout(() => this.removeNotification(id), 5000);
    },
    removeNotification(id) {
        this.notifications = this.notifications.filter(n => n.id !== id);
    },
    init() {
        // Check for Laravel session flash messages
        @if(session('success'))
            this.addNotification('success', '{{ session('success') }}');
        @endif
        @if(session('error'))
            this.addNotification('error', '{{ session('error') }}');
        @endif
        @if(session('warning'))
            this.addNotification('warning', '{{ session('warning') }}');
        @endif
        @if(session('info'))
            this.addNotification('info', '{{ session('info') }}');
        @endif
        @if(session('status'))
            this.addNotification('success', '{{ session('status') }}');
        @endif
        @if(session('attendance_success'))
            this.addNotification('success', '{{ session('attendance_success') }}');
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                this.addNotification('error', '{{ $error }}');
            @endforeach
        @endif

        // Listen for custom events
        window.addEventListener('notify', (event) => {
            this.addNotification(event.detail.type || 'info', event.detail.message);
        });
    }
}"
class="fixed top-4 right-4 z-50 space-y-2 max-w-sm w-full pointer-events-none">
    <template x-for="notification in notifications" :key="notification.id">
        <div
            x-show="notification"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transform ease-in duration-200 transition"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="pointer-events-auto rounded-lg shadow-lg overflow-hidden"
            :class="{
                'bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500': notification.type === 'success',
                'bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500': notification.type === 'error',
                'bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-500': notification.type === 'warning',
                'bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500': notification.type === 'info'
            }"
        >
            <div class="p-4 flex items-start gap-3">
                <!-- Icon -->
                <div class="flex-shrink-0">
                    <template x-if="notification.type === 'success'">
                        <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                    <template x-if="notification.type === 'error'">
                        <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                    <template x-if="notification.type === 'warning'">
                        <svg class="h-6 w-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </template>
                    <template x-if="notification.type === 'info'">
                        <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                </div>

                <!-- Message -->
                <div class="flex-1 pt-0.5">
                    <p class="text-sm font-medium"
                       :class="{
                           'text-green-800 dark:text-green-200': notification.type === 'success',
                           'text-red-800 dark:text-red-200': notification.type === 'error',
                           'text-yellow-800 dark:text-yellow-200': notification.type === 'warning',
                           'text-blue-800 dark:text-blue-200': notification.type === 'info'
                       }"
                       x-text="notification.message">
                    </p>
                </div>

                <!-- Close Button -->
                <button
                    @click="removeNotification(notification.id)"
                    class="flex-shrink-0 inline-flex text-gray-400 hover:text-gray-500 focus:outline-none"
                >
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>
