@extends('frontend.layouts.app')
@section('title', 'Portofolio - ' . $siteName)
@section('meta_description', 'Kisah sukses dan portofolio proyek UMKM yang telah go-digital bersama kami.')

@push('styles')
<style>
    @include('frontend.layouts.portofolio-styles')
</style>
@endpush

@section('content')
<!-- ===== HERO ===== -->
<section class="pf-hero" style="background-image: url('{{ $portfolio_hero_image }}');">
    <div class="pf-hero-inner">
        <p class="pf-hero-label">{{ __('Our Work') }}</p>
        <h1 class="pf-hero-title">{!! __('Portofolio &<br>Karya Terbaik') !!}</h1>
        <p class="pf-hero-sub">{{ __('Kumpulan proyek yang telah kami kerjakan — dari web, mobile, hingga desain UI/UX untuk berbagai industri.') }}</p>

        <div class="pf-hero-stats">
            <span class="pf-hero-stat">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                {{ $counts['semua'] }}+ {{ __('Proyek Selesai') }}
            </span>
            <span class="pf-hero-stat">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                4 {{ __('Kategori') }}
            </span>
            <span class="pf-hero-stat">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ __('Klien Puas') }}
            </span>
        </div>
    </div>
</section>


<!-- ===== CATEGORY TABS ===== -->
<div class="pf-tabs-wrap">
    <div class="pf-tabs-inner">
        <a href="{{ route('portofolio') }}"
           class="pf-tab {{ !request('category') ? 'active' : '' }}">
            {{ __('Semua') }}
            <span class="pf-tab-count">{{ $counts['semua'] }}</span>
        </a>
        <a href="{{ route('portofolio') }}?category=landing-page" class="pf-tab {{ request('category') == 'landing-page' ? 'active' : '' }}">
            Landing Page
            <span class="pf-tab-count">{{ $counts['landing-page'] }}</span>
        </a>
        <a href="{{ route('portofolio') }}?category=mobile-app" class="pf-tab {{ request('category') == 'mobile-app' ? 'active' : '' }}">
            Mobile App
            <span class="pf-tab-count">{{ $counts['mobile-app'] }}</span>
        </a>
        <a href="{{ route('portofolio') }}?category=ui-ux-design" class="pf-tab {{ request('category') == 'ui-ux-design' ? 'active' : '' }}">
            UI/UX Design
            <span class="pf-tab-count">{{ $counts['ui-ux-design'] }}</span>
        </a>
        <a href="{{ route('portofolio') }}?category=website" class="pf-tab {{ request('category') == 'website' ? 'active' : '' }}">
            Website
            <span class="pf-tab-count">{{ $counts['website'] }}</span>
        </a>
    </div>
</div>


<!-- ===== MAIN ===== -->
<div class="pf-main">

    <!-- Topbar -->
    <div class="pf-topbar">
        <p class="pf-topbar-info">
            {{ __('Menampilkan') }} <strong>{{ $portfolios->count() }}</strong> {{ __('proyek') }}
        </p>
    </div>

    <!-- Grid -->
    <div class="pf-grid">
        @forelse($portfolios as $portfolio)
            <div class="pf-card">
                <div class="pf-card-img">
                    <span class="pf-card-cat">{{ $portfolio->category }}</span>
                    @if($portfolio->image)
                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                            <span class="material-symbols-outlined text-[40px]">image</span>
                        </div>
                    @endif
                    
                    @if($portfolio->link)
                    <div class="pf-card-overlay">
                        <a href="{{ $portfolio->link }}" target="_blank" class="pf-overlay-btn primary">{{ __('Kunjungi Proyek') }}</a>
                    </div>
                    @endif
                </div>
                <div class="pf-card-body">
                    <h3 class="pf-card-title">{{ $portfolio->title }}</h3>
                    <p class="pf-card-desc">{{ $portfolio->description }}</p>
                    
                    <div class="pf-card-footer mt-auto">
                        <div class="pf-card-meta">
                            <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            <span>{{ $portfolio->created_at->format('M Y') }}</span>
                        </div>
                        @if($portfolio->link)
                        <a href="{{ $portfolio->link }}" target="_blank" class="pf-card-link">
                            {{ __('Lihat') }} <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="pf-empty">
                <div class="pf-empty-icon">
                    <svg width="28" height="28" fill="none" stroke="var(--gray-400)" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div class="pf-empty-title">{{ __('Belum Ada Proyek') }}</div>
                <div class="pf-empty-sub">{{ __('Portofolio di kategori ini sedang dalam proses penambahan. Cek lagi nanti ya!') }}</div>
            </div>
        @endforelse
    </div>
    
</div>


<!-- ===== CTA BOTTOM ===== -->
<section class="pf-cta">
    <div class="pf-cta-inner">
        <div>
            <p class="pf-cta-label">{{ __('Wujudkan Ide Anda') }}</p>
            <h2 class="pf-cta-title">{{ __('Punya Project? Yuk Diskusi!') }}</h2>
            <p class="pf-cta-sub">{{ __('Kami siap membantu mewujudkan ide digital Anda menjadi produk nyata yang berdampak.') }}</p>
        </div>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactPhone ?: '6281234567890') }}" target="_blank" class="pf-cta-btn">
            <svg width="18" height="18" fill="var(--orange)" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            {{ __('Konsultasi Gratis via WhatsApp') }}
        </a>
    </div>
</section>
@endsection
