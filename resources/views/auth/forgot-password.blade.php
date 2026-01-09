<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white mb-2">
            {{ __('app.forgot_password') }}
        </h2>
        <p class="text-sm text-slate-600 dark:text-slate-400">
            {{ __('app.forgot_password_description') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('app.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="{{ __('app.enter_email') }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 underline">
                &larr; {{ __('app.back_to_login') }}
            </a>
            <x-primary-button>
                {{ __('app.send_reset_link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
