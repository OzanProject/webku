<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $siteName ?? config('app.name') }} Admin Dashboard</title>
    
    @if(!empty($siteLogo))
    <link rel="icon" type="image/x-icon" href="{{ $siteLogo }}">
    @endif
    
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    
    <style>
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }
        
        /* Transition for mobile sidebar */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="bg-surface text-on-surface font-body-md min-h-screen flex flex-col md:pl-64 overflow-x-hidden">

<!-- Mobile Sidebar Backdrop -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-on-surface/50 z-20 hidden transition-opacity opacity-0 md:hidden"></div>

<!-- SideNavBar -->
<nav id="sidebar" class="bg-surface-container-low dark:bg-inverse-surface border-r border-outline-variant shadow-sm h-screen w-64 fixed left-0 top-0 flex flex-col py-lg px-md z-30 sidebar-transition -translate-x-full md:translate-x-0">
    <div class="mb-xl flex items-center justify-between">
        <div class="flex items-center gap-sm">
            @if(!empty($siteLogo))
                <img src="{{ $siteLogo }}" alt="{{ $siteName ?? config('app.name') }}" class="h-10 w-10 rounded-lg object-contain bg-white p-1 border border-outline-variant">
                <div>
                    <h1 class="text-headline-md font-headline-md font-extrabold text-primary dark:text-primary-fixed-dim leading-none">{{ $siteName ?? config('app.name') }}</h1>
                    <p class="text-label-sm font-label-sm text-on-surface-variant dark:text-on-secondary-fixed-variant mt-xs">Admin Console</p>
                </div>
            @else
                <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-on-primary font-bold text-xl">{{ substr($siteName ?? config('app.name'), 0, 1) }}</div>
                <div>
                    <h1 class="text-headline-md font-headline-md font-extrabold text-primary dark:text-primary-fixed-dim leading-none">{{ $siteName ?? config('app.name') }}</h1>
                    <p class="text-label-sm font-label-sm text-on-surface-variant dark:text-on-secondary-fixed-variant mt-xs">Admin Console</p>
                </div>
            @endif
        </div>
        <button id="close-sidebar-btn" type="button" class="md:hidden text-on-surface-variant p-1 rounded-md hover:bg-surface-container-high transition-colors">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
    <div class="flex flex-col gap-sm flex-1 font-label-md text-label-md overflow-y-auto">
        <!-- Dashboard Link -->
        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.dashboard') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.dashboard') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>dashboard</span>
            Dashboard
        </a>
        
        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.products.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.products.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.products.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>inventory_2</span>
            Products
        </a>
        
        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.categories.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.categories.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.categories.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>category</span>
            Kategori
        </a>
        
        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.services.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.services.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.services.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>design_services</span>
            Services
        </a>
        
        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.testimonials.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.testimonials.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>rate_review</span>
            Testimonials
        </a>

        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.portfolios.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.portfolios.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.portfolios.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>photo_library</span>
            Portofolio
        </a>

        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.processes.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.processes.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.processes.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>list_alt</span>
            Proses Kerja
        </a>

        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.features.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.features.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.features.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>stars</span>
            Keunggulan
        </a>

        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.orders.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.orders.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.orders.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>shopping_cart</span>
            Orders
        </a>
        <a class="flex items-center justify-between px-md py-sm rounded-lg {{ request()->routeIs('admin.messages.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.messages.index') }}">
            <div class="flex items-center gap-md">
                <span class="material-symbols-outlined" {!! request()->routeIs('admin.messages.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>mail</span>
                Pesan Masuk
            </div>
            @php $unreadCount = \App\Models\ContactSubmission::unread()->count(); @endphp
            @if($unreadCount > 0)
                <span class="bg-error text-on-error text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
            @endif
        </a>
        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.users.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.users.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.users.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>group</span>
            Users
        </a>
        <!-- Section: Halaman -->
        <div class="mb-sm">
            <h3 class="px-md text-label-sm font-bold text-on-surface-variant uppercase tracking-wider mb-xs">Halaman</h3>
            <a href="{{ route('admin.home-page.index') }}" class="flex items-center gap-md px-md py-sm rounded-lg mb-xs transition-colors {{ request()->routeIs('admin.home-page.*') ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface hover:bg-surface-container hover:text-primary' }}">
                <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.home-page.*') ? 'icon-filled' : '' }}">view_day</span>
                Beranda (Hero)
            </a>
            <a href="{{ route('admin.about.index') }}" class="flex items-center gap-md px-md py-sm rounded-lg mb-xs transition-colors {{ request()->routeIs('admin.about.*') ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface hover:bg-surface-container hover:text-primary' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.about.*') ? 'icon-filled' : '' }}">info</span>
                <span class="font-label-md">Halaman About</span>
            </a>
            <a href="{{ route('admin.legals.index') }}" class="flex items-center gap-md px-md py-sm rounded-lg mb-xs transition-colors {{ request()->routeIs('admin.legals.*') ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface hover:bg-surface-container hover:text-primary' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.legals.*') ? 'icon-filled' : '' }}">policy</span>
                <span class="font-label-md">Halaman Legal</span>
            </a>
        </div>
        <a class="flex items-center gap-md px-md py-sm rounded-lg {{ request()->routeIs('admin.settings.*') ? 'text-primary dark:text-primary-fixed-dim font-bold border-r-4 border-primary bg-surface-container-high dark:bg-secondary-fixed-variant' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant' }} transition-colors" href="{{ route('admin.settings.index') }}">
            <span class="material-symbols-outlined" {!! request()->routeIs('admin.settings.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>settings</span>
            Settings
        </a>
        
        <!-- Go back to Frontend -->
        <a class="flex items-center gap-md px-md py-sm rounded-lg text-on-surface-variant dark:text-on-secondary-fixed-variant hover:text-primary hover:bg-surface-container-high dark:hover:bg-secondary-fixed-variant transition-colors mt-4 border-t border-outline-variant pt-4" href="{{ route('home') }}" target="_blank">
            <span class="material-symbols-outlined">open_in_new</span>
            View Website
        </a>
    </div>
    
    <!-- Logout Form -->
    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button type="submit" class="w-full bg-error-container text-on-error-container font-label-md py-sm px-md rounded-lg flex items-center justify-center gap-sm hover:brightness-110 transition-all shadow-sm active:scale-95 duration-150">
            <span class="material-symbols-outlined text-[20px]">logout</span>
            Logout
        </button>
    </form>
</nav>

<!-- Main Content Wrapper -->
<main class="flex flex-col min-h-screen w-full bg-background transition-all">
    <!-- TopAppBar -->
    <header class="bg-surface-container-lowest dark:bg-surface-dim border-b border-outline-variant shadow-sm fixed top-0 right-0 w-full md:w-[calc(100%-16rem)] h-16 flex items-center justify-between px-md md:px-xl z-10 transition-all">
        <div class="flex items-center gap-md w-full max-w-md">
            <button id="open-sidebar-btn" type="button" class="md:hidden text-on-surface-variant p-sm rounded-full hover:bg-surface-container-high">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="relative w-full group hidden sm:block">
                <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">search</span>
                <input class="w-full bg-surface text-on-surface pl-xl pr-sm py-sm rounded-full border border-outline-variant/50 focus:border-primary focus:ring-2 focus:ring-primary focus-within:ring-2 focus-within:ring-primary text-body-md font-body-md placeholder:text-on-surface-variant transition-all outline-none" placeholder="Search..." type="text"/>
            </div>
        </div>
        <div class="flex items-center gap-sm md:gap-md">
            <button type="button" class="p-sm rounded-full text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-colors relative">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-1 right-1 w-2 h-2 bg-error rounded-full border border-surface-container-lowest"></span>
            </button>
            <button type="button" class="p-sm rounded-full text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-colors hidden sm:block">
                <span class="material-symbols-outlined">help</span>
            </button>
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false" type="button" class="flex items-center gap-sm p-xs pr-2 rounded-full hover:bg-surface-container-high transition-colors focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <img alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border border-outline-variant" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f97316&color=fff"/>
                    <span class="hidden md:block text-sm font-medium text-on-surface">{{ auth()->user()->name }}</span>
                    <span class="material-symbols-outlined text-[20px] text-on-surface-variant hidden md:block">expand_more</span>
                </button>
                
                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-56 rounded-xl bg-surface border border-outline-variant py-1 shadow-lg focus:outline-none z-50" style="display: none;">
                    <div class="px-4 py-3 border-b border-outline-variant/50">
                        <p class="text-sm font-bold text-on-surface truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-on-surface-variant truncate mt-0.5">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="py-1">
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 text-sm text-on-surface hover:bg-surface-container flex items-center gap-3 transition-colors">
                            <span class="material-symbols-outlined text-[18px] text-on-surface-variant">person</span> Profil Saya
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 text-sm text-on-surface hover:bg-surface-container flex items-center gap-3 transition-colors">
                            <span class="material-symbols-outlined text-[18px] text-on-surface-variant">settings</span> Pengaturan Web
                        </a>
                    </div>
                    <div class="border-t border-outline-variant/50 py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-error hover:bg-error/10 flex items-center gap-3 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">logout</span> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    @yield('content')

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('open-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');
        const backdrop = document.getElementById('sidebar-backdrop');

        function toggleSidebar(show) {
            if (show) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                // Allow browser to render display block before changing opacity
                setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('opacity-0');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
            }
        }

        openBtn.addEventListener('click', () => toggleSidebar(true));
        closeBtn.addEventListener('click', () => toggleSidebar(false));
        backdrop.addEventListener('click', () => toggleSidebar(false));
    });
</script>

@stack('scripts')

</body>
</html>
