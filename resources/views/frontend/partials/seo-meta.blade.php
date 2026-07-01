{{-- ====================================================== --}}
{{-- PRIMARY SEO META TAGS --}}
{{-- ====================================================== --}}
<title>@yield('title', $siteName . ' - Solusi Digital Profesional')</title>
<meta name="description" content="@yield('meta_description', ($siteDescription ?: $siteName . ' membangun website, aplikasi mobile & sistem kustom untuk UMKM dan perusahaan Indonesia.'))"/>
<meta name="keywords" content="@yield('meta_keywords', 'jasa pembuatan website, aplikasi mobile, sistem kustom, UMKM digital, agency digital Indonesia')"/>
<meta name="author" content="{{ $siteName }}"/>
<meta name="robots" content="@yield('robots', 'index, follow')"/>
<link rel="canonical" href="{{ url()->current() }}"/>

@if(!empty($siteLogo))
<link rel="icon" type="image/x-icon" href="{{ $siteLogo }}">
@endif

{{-- ====================================================== --}}
{{-- OPEN GRAPH (Facebook, WhatsApp, LinkedIn) --}}
{{-- ====================================================== --}}
<meta property="og:type" content="@yield('og_type', 'website')"/>
<meta property="og:site_name" content="{{ $siteName }}"/>
<meta property="og:title" content="@hasSection('og_title')@yield('og_title')@else@yield('title', $siteName . ' - Solusi Digital Profesional')@endif"/>
<meta property="og:description" content="@hasSection('og_description')@yield('og_description')@else@yield('meta_description', $siteName . ' membangun website, aplikasi mobile & sistem kustom untuk UMKM dan perusahaan Indonesia.')@endif"/>
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))"/>
<meta property="og:image:width" content="1200"/>
<meta property="og:image:height" content="630"/>
<meta property="og:locale" content="id_ID"/>

{{-- ====================================================== --}}
{{-- TWITTER CARD --}}
{{-- ====================================================== --}}
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:title" content="@hasSection('og_title')@yield('og_title')@else@yield('title', $siteName . ' - Solusi Digital Profesional')@endif"/>
<meta name="twitter:description" content="@hasSection('og_description')@yield('og_description')@else@yield('meta_description', $siteName . ' membangun website, aplikasi mobile & sistem kustom untuk UMKM dan perusahaan Indonesia.')@endif"/>
<meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))"/>
