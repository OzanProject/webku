<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-display font-bold text-gray-900 mb-2">Buat Akun Baru</h2>
        <p class="text-sm text-gray-500">Bergabunglah dengan kami untuk memulai proyek digital Anda.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-semibold text-gray-700" />
            <x-text-input id="name" class="block mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#f97316] focus:ring-[#f97316] shadow-sm transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold text-gray-700" />
            <x-text-input id="email" class="block mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#f97316] focus:ring-[#f97316] shadow-sm transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" class="font-semibold text-gray-700" />
            <x-text-input id="password" class="block mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#f97316] focus:ring-[#f97316] shadow-sm transition-colors"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Sandi')" class="font-semibold text-gray-700" />
            <x-text-input id="password_confirmation" class="block mt-1.5 w-full rounded-xl border-gray-200 focus:border-[#f97316] focus:ring-[#f97316] shadow-sm transition-colors"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button>
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>
        
        <div class="text-center pt-4 border-t border-gray-100 mt-6">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-semibold text-orange-600 hover:text-orange-500 transition-colors">Masuk di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
