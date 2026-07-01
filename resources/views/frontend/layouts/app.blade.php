<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    @include('frontend.partials.seo-meta')

    {{-- ====================================================== --}}
    {{-- PERFORMANCE: Preconnect & DNS-Prefetch --}}
    {{-- ====================================================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com"/>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    @include('frontend.partials.tailwind-config')

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .icon-filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: #f8f9ff;
        }
    </style>

    {{-- ====================================================== --}}
    {{-- JSON-LD STRUCTURED DATA (per-page override via @push) --}}
    {{-- ====================================================== --}}
    @stack('schema')

    {{-- ====================================================== --}}
    {{-- GOOGLE ADSENSE --}}
    {{-- ====================================================== --}}
    @stack('adsense')

    {{-- Google Analytics (injected from Settings) --}}
    @php $gaId = \App\Models\Setting::get('google_analytics_id', ''); @endphp
    @if(!empty($gaId))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}');
    </script>
    @endif

    @stack('styles')
</head>
<body class="font-body-md text-on-surface antialiased bg-surface">

    @include('frontend.partials.navbar')

    <main class="pt-[80px]">
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
