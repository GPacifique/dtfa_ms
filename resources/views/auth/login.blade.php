<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-300 via-blue-400 to-green-400 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/90 rounded-2xl shadow-2xl p-8 border-4 border-blue-200">
            <div class="flex flex-col items-center">
                <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 via-blue-600 to-green-500 mb-2 drop-shadow-lg">
                    {{ __('app.login') }}
                </h2>
                <p class="text-lg font-medium text-green-700 mb-4 animate-pulse">
                    {{ __('app.welcome_back') }}
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('app.email')" class="text-blue-600 font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-2 border-blue-200 focus:border-green-400 focus:ring-2 focus:ring-green-200 bg-blue-50/60 text-blue-900 placeholder-blue-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-600" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('app.password')" class="text-blue-600 font-semibold" />
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full rounded-lg border-2 border-blue-200 focus:border-green-400 focus:ring-2 focus:ring-green-200 bg-blue-50/60 text-blue-900 placeholder-blue-400 pr-12" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                        <button type="button" id="togglePassword" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex items-center px-3 text-blue-500 hover:text-green-500 focus:outline-none">
                            <i id="eyeIcon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-600" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-blue-200 text-green-600 focus:ring-green-400" name="remember">
                        <span class="ms-2 text-blue-700 font-medium text-sm">{{ __('app.remember_me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-600 hover:text-green-700 underline font-semibold" href="{{ route('password.request') }}">
                            {{ __('app.forgot_password') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('register'))
                        <a class="text-base text-pink-600 hover:text-green-500 underline font-semibold" href="{{ route('register') }}">
                            {{ __("Don't have an account? Register") }}
                        </a>
                    @endif
                    <button type="submit" class="py-3 px-6 border border-transparent rounded-lg shadow-lg text-lg font-bold text-white bg-gradient-to-r from-green-500 via-blue-500 to-pink-400 hover:from-pink-400 hover:to-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition-all duration-300">
                        <i class="fa-solid fa-sign-in-alt mr-2"></i> {{ __('app.login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const field = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
