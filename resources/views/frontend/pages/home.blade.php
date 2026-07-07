@extends('frontend.layouts.app')

@section('title', 'Beranda - ' . $siteName . ' | Solusi Digital Profesional')
@section('meta_description', 'Kami membangun website, aplikasi mobile & sistem kustom untuk UMKM dan perusahaan Indonesia. Berorientasi konversi dan pertumbuhan bisnis.')
@section('meta_keywords', 'jasa website profesional, jasa aplikasi mobile, sistem informasi kustom, agency digital Indonesia, website UMKM')
@section('og_title', 'Ozan Project - Solusi Digital Profesional')
@section('og_description', 'Kami membangun website, aplikasi mobile & sistem kustom untuk UMKM dan perusahaan Indonesia. Berorientasi konversi dan pertumbuhan bisnis.')

@push('styles')
<style>
    /* Updated Styles v2 */
    @include('frontend.layouts.home-styles')
</style>
@endpush

@section('content')
<!-- ===== HERO SECTION ===== -->
<section class="hz-hero"
    role="banner"
    aria-label="Hero Background"
    style="background-image: url('{{ $hero['hero_image_url'] ?? asset('images/hero1.jpg') }}'); background-color: #f8fafc;">
    <div class="hz-hero-inner">
        <div class="hz-hero-content">
            <div class="hz-badge">
                <span class="hz-badge-dot"></span>
                {{ __($hero['hero_trust_badge'] ?? 'Dipercaya oleh 500+ UMKM di Indonesia') }}
            </div>

            <h1 class="hz-hero-title">
                {{ __($hero['hero_title'] ?? 'Website yang Bukan Cuma Tampil Keren, Tapi Bantu Bisnis Anda Dapat Customer') }}
            </h1>

            <p class="hz-hero-sub">
                {{ __($hero['hero_subtitle'] ?? 'Kami membantu UMKM dan perusahaan membangun sistem digital modern, efisien, dan berorientasi pada konversi.') }}
            </p>

            <div class="hz-ctas">
                <a href="{{ route('produk') }}" class="hz-btn-primary">
                    {{ __($hero['hero_btn1_text'] ?? 'Jelajahi Produk') }}
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
                <a href="{{ route('portofolio') }}" class="hz-btn-outline">
                    {{ __($hero['hero_btn2_text'] ?? 'Lihat Portofolio') }}
                    <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                </a>
            </div>

            <div class="hz-stats">
                @php
                    $defaultIcons = ['category', 'verified', 'monitoring', 'support_agent'];
                @endphp
                @foreach($stats as $index => $stat)
                <div class="hz-stat">
                    <div class="hz-stat-icon"><span class="material-symbols-outlined text-[20px] text-[var(--orange)]">{{ $stat->icon ?? $defaultIcons[$index % 4] }}</span></div>
                    <div><div class="hz-stat-num">{{ $stat->value }}</div><div class="hz-stat-lbl">{{ $stat->label }}</div></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ===== KENAPA KAMI ===== -->
<section class="hz-section" id="tentang">
    <div class="hz-container">
        <div class="hz-why-wrap">
            <h2 class="text-white text-[24px] font-bold text-center mb-10">{{ __($whyUs['why_us_title'] ?? 'Kenapa Memilih Kami?') }}</h2>
            <div class="hz-why-grid">
                @foreach($features as $feature)
                <div class="hz-why-item">
                    <div class="hz-why-icon">
                        <span class="material-symbols-outlined text-[var(--orange)]">{{ $feature->icon }}</span>
                    </div>
                    <div>
                        <h3 class="hz-why-title">{{ $feature->title }}</h3>
                        <p class="hz-why-desc">{{ $feature->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ===== PROSES KERJA ===== -->
<section class="hz-section">
    <div class="hz-container">
        <div class="hz-section-title-center">
            <h2 class="hz-section-title mb-2">{{ __('Proses Kerja Kami') }}</h2>
            <p class="text-[var(--gray-500)] max-w-2xl mx-auto text-[15px]">{{ __('Langkah mudah menuju transformasi digital bisnis Anda.') }}</p>
        </div>
        
        <div class="hz-steps-wrap">
            <div class="hz-steps-line"></div>
            <div class="hz-steps-grid">
                @foreach($processes as $process)
            <div class="hz-step">
                <div class="hz-step-icon">
                    <div class="hz-step-num">{{ $process->step_number }}</div>
                    <svg width="32" height="32" fill="none" stroke="var(--orange)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
                <div>
                    <h4 class="hz-step-title">{{ $process->title }}</h4>
                    <p class="hz-step-desc">{{ $process->description }}</p>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ===== KATEGORI PRODUK ===== -->
<section class="hz-section bg-[var(--gray-50)]">
    <div class="hz-container">
        <div class="hz-section-header">
            <div>
                <div class="hz-section-label">{{ __('Kategori Produk') }}</div>
                <h2 class="hz-section-title">{{ __('Pilih Solusi Digital yang') }}<br>{{ __('Sesuai Kebutuhan Anda') }}</h2>
            </div>
            <a href="{{ route('produk') }}" class="hz-link-more">
                {{ __('Lihat Semua Kategori') }} <span class="material-symbols-outlined text-[18px]">arrow_right_alt</span>
            </a>
        </div>
        
        <div class="hz-cat-grid">
            @php
                $catIcons = ['shopping_cart', 'smartphone', 'monitor', 'web', 'design_services', 'grid_view'];
            @endphp
            @foreach($navCategories->take(6) as $index => $category)
            <a href="{{ route('produk', ['category' => $category->slug]) }}" class="hz-cat-card">
                <div class="hz-cat-icon"><span class="material-symbols-outlined text-[24px] text-[var(--orange)]">{{ $catIcons[$index % count($catIcons)] }}</span></div>
                <div class="hz-cat-title">{{ $category->name }}</div>
                <div class="hz-cat-desc">{{ Str::limit($category->description, 50, '...') }}</div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== PRODUK TERPOPULER ===== -->
<section class="hz-section" id="produk">
    <div class="hz-container">
        <div class="hz-section-header">
            <div>
                <h2 class="hz-section-title mb-2">{{ __('Produk Populer') }}</h2>
                <p class="text-[var(--gray-500)] max-w-2xl text-[15px]">{{ __('Template dan solusi siap pakai untuk mempercepat digitalisasi bisnis.') }}</p>
            </div>
            <a href="{{ route('produk') }}" class="hz-link-more">
                {{ __('Lihat Semua Produk') }} <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        
        <div class="hz-prod-grid">
            @forelse($products as $product)
            <div class="hz-prod-card" onclick="window.location.href='{{ route('produk.detail', $product->slug) }}'">
                <div class="hz-prod-img">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400x250' }}" alt="{{ $product->title }}">
                    <div class="hz-prod-badge bg-[var(--orange)]">{{ $product->category->name ?? 'Uncategorized' }}</div>
                    <div class="hz-prod-overlay">
                        <a href="{{ route('produk.detail', $product->slug) }}" class="btn-detail">{{ __('Lihat Detail') }}</a>
                    </div>
                </div>
                <div class="hz-prod-body">
                    <div class="hz-prod-name" title="{{ $product->title }}">{{ Str::limit($product->title, 50) }}</div>
                    <div class="hz-prod-desc" title="{{ $product->description }}">{{ Str::limit($product->description, 100) }}</div>
                    <div class="hz-prod-footer">
                        <span class="font-bold text-[var(--gray-900)] text-[13px]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <a href="{{ route('produk.detail', $product->slug) }}" class="hz-prod-link">{{ __('Detail') }} <span class="material-symbols-outlined text-[14px]">arrow_forward</span></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">inventory_2</span>
                <p class="text-gray-500 font-medium">{{ __('Belum ada produk yang dipublikasikan.') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== TESTIMONIAL ===== -->
<section class="hz-section bg-[var(--gray-50)]" id="portofolio">
    <div class="hz-container">
        <div class="hz-section-title-center">
            <h2 class="hz-section-title mb-2">{{ __('Apa Kata Klien Kami') }}</h2>
            <p class="text-[var(--gray-500)] max-w-2xl mx-auto text-[15px]">{{ __('Kisah sukses UMKM yang telah go-digital bersama kami.') }}</p>
        </div>
        
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-6 hz-slider">
            @forelse($testimonials as $testimonial)
            <div class="flex-none w-[85%] md:w-[350px] snap-center">
                <div class="hz-testi-card">
                    <div class="hz-testi-quote-mark">"</div>
                    <div class="hz-testi-stars">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                        <span class="material-symbols-outlined text-[14px] text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                    </div>
                    <div class="hz-testi-msg" title="{{ $testimonial->quote }}">"{{ Str::limit($testimonial->quote, 150) }}"</div>
                    <div class="hz-testi-divider"></div>
                    <div class="hz-testi-user">
                        <div class="hz-testi-avatar">
                            {{ substr($testimonial->name, 0, 1) }}
                        </div>
                        <div>
                            <h5 class="hz-testi-name" title="{{ $testimonial->name }}">{{ Str::limit($testimonial->name, 25) }}</h5>
                            <div class="hz-testi-meta">
                                <span class="hz-testi-role" title="{{ $testimonial->position }}">{{ Str::limit($testimonial->position, 30) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="w-full text-center py-12">
                <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">forum</span>
                <p class="text-gray-500 font-medium">{{ __('Belum ada ulasan dari klien.') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section class="hz-cta-section mt-12">
    <div class="hz-cta-circle-1"></div>
    <div class="hz-cta-circle-2"></div>
    <div class="hz-container">
        <div class="hz-cta-inner">
            <div class="flex-1">
                <h2 class="hz-cta-title">{{ __($cta['cta_title'] ?? 'Siap Go Digital Bersama Kami?') }}</h2>
                <p class="hz-cta-sub">{{ __($cta['cta_subtitle'] ?? 'Tingkatkan profit bisnis Anda dengan sistem yang tepat sasaran.') }}</p>
            </div>
            <a href="{{ route('contact') }}" class="hz-btn-wa">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.7.45 3.3 1.25 4.7L2 22l5.44-1.14C8.75 21.57 10.33 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm4.33 14.15c-.2.57-1.15 1.1-1.6 1.16-.42.06-.97.16-3.08-.7-2.54-1.03-4.17-3.64-4.29-3.8-.13-.17-1.02-1.37-1.02-2.6 0-1.24.64-1.85.87-2.09.2-.21.46-.26.61-.26.16 0 .31 0 .44.02.16.02.37-.06.57.42.21.53.7 1.74.77 1.87.05.13.1.28.01.46-.08.18-.13.3-.26.44-.13.15-.28.32-.39.42-.13.13-.26.27-.12.51.15.24.66 1.08 1.42 1.76.98.87 1.8 1.15 2.05 1.28.25.13.39.11.53-.05.15-.17.61-.71.77-.96.15-.24.31-.2.53-.13.23.08 1.46.69 1.71.82.26.13.42.2.49.32.06.12.06.7-.14 1.27z"/></svg>
                {{ __($cta['cta_btn_text'] ?? 'Konsultasi Gratis Sekarang') }}
            </a>
        </div>
    </div>
</section>
@endsection
