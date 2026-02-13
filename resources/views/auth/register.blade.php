<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-300 via-blue-400 to-pink-400 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white/90 rounded-2xl shadow-2xl p-8 border-4 border-pink-200">
        <div class="flex flex-col items-center">
            <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-500 via-blue-500 to-pink-400 mb-2 drop-shadow-lg">
                {{ __('Register') }}
            </h2>
            <p class="text-lg font-medium text-blue-700 mb-4 animate-pulse">
                {{ __('Create your account') }}
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-green-600 font-semibold" />
                <x-text-input id="name" class="block mt-1 w-full rounded-lg border-2 border-pink-200 focus:border-green-400 focus:ring-2 focus:ring-green-200 bg-green-50/60 text-green-900 placeholder-pink-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-pink-600" />
            </div>
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-green-600 font-semibold" />
                <x-text-input id="email" class="block mt-1 w-full rounded-lg border-2 border-pink-200 focus:border-green-400 focus:ring-2 focus:ring-green-200 bg-green-50/60 text-green-900 placeholder-pink-400" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@email.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-600" />
            </div>
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-green-600 font-semibold" />
                <div class="relative">
                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-2 border-pink-200 focus:border-green-400 focus:ring-2 focus:ring-green-200 bg-green-50/60 text-green-900 placeholder-pink-400 pr-12" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <button type="button" id="togglePassword" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex items-center px-3 text-pink-500 hover:text-green-500 focus:outline-none">
                        <i id="eyeIcon" class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-600" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-green-600 font-semibold" />
                <div class="relative">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-2 border-pink-200 focus:border-green-400 focus:ring-2 focus:ring-green-200 bg-green-50/60 text-green-900 placeholder-pink-400 pr-12" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    <button type="button" id="togglePasswordConfirm" onclick="togglePasswordConfirmVisibility()" class="absolute inset-y-0 right-0 flex items-center px-3 text-pink-500 hover:text-green-500 focus:outline-none">
                        <i id="eyeIconConfirm" class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-pink-600" />
            </div>
            <div class="flex items-center justify-between mt-6">
                <a class="text-base text-pink-600 hover:text-green-500 underline font-semibold" href="{{ route('login') }}">
                    {{ __('Already registered? Login') }}
                </a>
                <button type="submit" class="py-3 px-6 border border-transparent rounded-lg shadow-lg text-lg font-bold text-white bg-gradient-to-r from-green-500 via-blue-500 to-pink-400 hover:from-pink-400 hover:to-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition-all duration-300">
                    <i class="fa-solid fa-user-plus mr-2"></i> {{ __('Register') }}
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
    function togglePasswordConfirmVisibility() {
        const field = document.getElementById('password_confirmation');
        const icon = document.getElementById('eyeIconConfirm');
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



