<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-display font-bold text-gray-900 mb-2">Selamat Datang Kembali</h2>
        <p class="text-sm text-gray-500">Silakan masuk ke akun Anda untuk melanjutkan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold text-gray-700" />
            <x-text-input id="email" class="block mt-1.5 w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500 shadow-sm transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Kata Sandi')" class="font-semibold text-gray-700" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-orange-600 hover:text-orange-500 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Lupa sandi?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block mt-1.5 w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500 shadow-sm transition-colors"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500 focus:ring-offset-0" name="remember">
                <span class="ms-2 text-sm text-gray-600 select-none">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button>
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>
        
        <div class="text-center pt-4 border-t border-gray-100 mt-6">
            <p class="text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-semibold text-orange-600 hover:text-orange-500 transition-colors">Daftar di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
