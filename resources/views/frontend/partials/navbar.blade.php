<nav class="bg-surface/90 backdrop-blur-md fixed top-0 w-full z-50 border-b border-outline-variant/30 shadow-sm">
    <div class="max-w-container-max mx-auto px-gutter flex justify-between items-center py-4">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-[#ff6b00] text-white flex items-center justify-center font-bold text-xl leading-none">{{ substr($siteName, 0, 1) }}</div>
            <span class="font-headline-md text-headline-md font-extrabold text-slate-800 tracking-tight">{{ $siteName }}</span>
        </a>

        {{-- Desktop Nav Links --}}
        <div class="hidden md:flex items-center gap-2" id="desktop-nav">
            @php
                $navClass = "nav-link px-3 py-2 font-body-md transition-all font-medium";
                $activeClass = "text-[#ff6b00]";
                $inactiveClass = "text-slate-500 hover:text-[#ff6b00]";
            @endphp
            
            <a href="{{ route('home') }}" class="{{ $navClass }} {{ request()->routeIs('home') ? $activeClass : $inactiveClass }}">
                {{ __('Beranda') }}
            </a>
            
            {{-- Dropdown Kategori --}}
            <div class="relative group">
                <a href="{{ route('produk') }}" class="flex items-center gap-1 {{ $navClass }} {{ request()->routeIs('produk') ? $activeClass : $inactiveClass }} cursor-pointer">
                    {{ __('Kategori') }}
                    <span class="material-symbols-outlined text-[18px] transition-transform duration-200 group-hover:rotate-180">expand_more</span>
                </a>
                
                {{-- Dropdown Menu (Hover) --}}
                <div class="absolute left-0 top-full mt-2 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left scale-95 group-hover:scale-100 pt-2 z-50">
                    <div class="bg-surface border border-outline-variant/20 rounded-xl shadow-xl overflow-hidden p-2 flex flex-col gap-1">
                        @forelse($navCategories as $category)
                        <a href="{{ route('produk') }}?category={{ $category->slug }}" class="block px-4 py-3 rounded-lg hover:bg-surface-container-low text-on-surface-variant hover:text-primary transition-colors">
                            <div class="font-label-md font-bold text-on-surface mb-0.5">{{ __($category->name) }}</div>
                            @if($category->description)
                            <div class="text-xs opacity-80">{{ __(Str::limit($category->description, 40)) }}</div>
                            @endif
                        </a>
                        @empty
                        <a href="{{ route('produk') }}" class="block px-4 py-3 rounded-lg hover:bg-surface-container-low text-on-surface-variant hover:text-primary transition-colors">
                            <div class="font-label-md font-bold text-on-surface mb-0.5">{{ __('Semua Produk') }}</div>
                        </a>
                        @endforelse
                    </div>
                </div>
            </div>

            <a href="{{ route('produk') }}" class="{{ $navClass }} {{ request()->routeIs('produk') ? $activeClass : $inactiveClass }}">
                {{ __('Produk') }}
            </a>
            <a href="{{ route('portofolio') }}" class="{{ $navClass }} {{ request()->routeIs('portofolio') ? $activeClass : $inactiveClass }}">
                {{ __('Portofolio') }}
            </a>
            <a href="{{ route('about') }}" class="{{ $navClass }} {{ request()->routeIs('about') ? $activeClass : $inactiveClass }}">
                {{ __('Tentang Kami') }}
            </a>
        </div>

        {{-- Desktop Auth Buttons --}}
        <div class="hidden md:flex items-center gap-md">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactPhone ?: '6281234567890') }}" target="_blank" class="bg-[#ff6b00] text-white font-semibold px-6 py-2.5 rounded-full hover:bg-[#e66000] transition-colors shadow-[0_8px_20px_-6px_rgba(255,107,0,0.6)] transform hover:-translate-y-0.5 flex items-center gap-2 text-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                Hubungi Kami
            </a>
            
            {{-- Language Switcher --}}
            <div class="relative group">
                <button class="flex items-center gap-1 text-on-surface-variant hover:text-primary transition-colors font-body-md font-medium px-2 py-2">
                    <span class="material-symbols-outlined text-[20px]">language</span>
                    <span class="uppercase">{{ app()->getLocale() }}</span>
                </button>
                <div class="absolute right-0 top-full mt-2 w-32 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 pt-2 z-50">
                    <div class="bg-surface border border-outline-variant/20 rounded-xl shadow-xl overflow-hidden p-2 flex flex-col gap-1">
                        <a href="{{ route('lang.switch', 'id') }}" class="px-3 py-2 rounded-lg hover:bg-surface-container-low text-sm font-medium {{ app()->getLocale() == 'id' ? 'text-primary bg-primary/5' : 'text-on-surface-variant' }}">🇮🇩 Indonesia</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-2 rounded-lg hover:bg-surface-container-low text-sm font-medium {{ app()->getLocale() == 'en' ? 'text-primary bg-primary/5' : 'text-on-surface-variant' }}">🇬🇧 English</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile Hamburger --}}
        <button type="button" id="mobile-menu-btn" class="md:hidden text-on-surface p-2 rounded-lg hover:bg-surface-variant transition-colors">
            <span class="material-symbols-outlined" id="menu-icon">menu</span>
        </button>

    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden bg-surface border-t border-outline-variant/30 px-gutter py-md">
        <div class="flex flex-col gap-sm">
            @php
                $mobClass = "px-3 py-2 rounded-lg transition-all font-body-md";
                $mobActive = "text-primary font-bold bg-primary-container/10";
                $mobInactive = "text-on-surface-variant hover:text-primary hover:bg-primary-container/10";
            @endphp
            <a href="{{ route('home') }}" class="{{ $mobClass }} {{ request()->routeIs('home') ? $mobActive : $mobInactive }}">{{ __('Beranda') }}</a>
            
            {{-- Mobile Dropdown Kategori --}}
            <div class="flex flex-col">
                <div class="flex items-center justify-between {{ $mobClass }} {{ request()->routeIs('produk') ? $mobActive : $mobInactive }}">
                    <a href="{{ route('produk') }}" class="flex-1">{{ __('Kategori') }}</a>
                    <button type="button" onclick="document.getElementById('mobile-layanan').classList.toggle('hidden')" class="px-2">
                        <span class="material-symbols-outlined text-[18px]">expand_more</span>
                    </button>
                </div>
                <div id="mobile-layanan" class="hidden flex-col pl-4 mt-1 gap-1 border-l-2 border-outline-variant/20 ml-3">
                    @forelse($navCategories as $category)
                    <a href="{{ route('produk') }}?category={{ $category->slug }}" class="text-on-surface-variant hover:text-primary px-3 py-2 rounded-lg hover:bg-surface-container-low transition-all font-body-md text-sm">{{ __($category->name) }}</a>
                    @empty
                    <a href="{{ route('produk') }}" class="text-on-surface-variant hover:text-primary px-3 py-2 rounded-lg hover:bg-surface-container-low transition-all font-body-md text-sm">{{ __('Semua Produk') }}</a>
                    @endforelse
                </div>
            </div>

            <a href="{{ route('produk') }}" class="{{ $mobClass }} {{ request()->routeIs('produk') ? $mobActive : $mobInactive }}">{{ __('Produk') }}</a>
            <a href="{{ route('portofolio') }}" class="{{ $mobClass }} {{ request()->routeIs('portofolio') ? $mobActive : $mobInactive }}">{{ __('Portofolio') }}</a>
            <a href="{{ route('about') }}" class="{{ $mobClass }} {{ request()->routeIs('about') ? $mobActive : $mobInactive }}">{{ __('Tentang Kami') }}</a>
            
            {{-- 
            <div class="flex gap-sm pt-sm border-t border-outline-variant/20 mt-sm">
                <a href="{{ route('login') }}" class="flex-1 text-on-surface font-label-md text-label-md hover:bg-surface-variant px-4 py-2 rounded-lg transition-colors text-center border border-outline-variant/30">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="flex-1 bg-primary-container text-on-secondary font-label-md text-label-md px-4 py-2 rounded-lg hover:bg-primary transition-colors text-center shadow-md">{{ __('Daftar') }}</a>
            </div>
            --}}
            
            <div class="flex items-center gap-2 mt-4 px-2">
                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">language</span>
                <a href="{{ route('lang.switch', 'id') }}" class="text-sm font-medium {{ app()->getLocale() == 'id' ? 'text-primary' : 'text-on-surface-variant' }}">ID</a>
                <span class="text-on-surface-variant">|</span>
                <a href="{{ route('lang.switch', 'en') }}" class="text-sm font-medium {{ app()->getLocale() == 'en' ? 'text-primary' : 'text-on-surface-variant' }}">EN</a>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu    = document.getElementById('mobile-menu');
    const menuIcon      = document.getElementById('menu-icon');

    mobileMenuBtn.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden', isOpen);
        menuIcon.textContent = isOpen ? 'menu' : 'close';
    });


</script>
@endpush
