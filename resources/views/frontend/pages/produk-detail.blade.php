@extends('frontend.layouts.app')

@section('title', $product->title . ' - ' . $siteName)
@section('og_title', $product->title)
@section('meta_description')
{{ Str::limit(strip_tags($product->description), 150) }}
@endsection
@section('og_type', 'product')
@section('og_image', $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/800x450')


@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org/",
  "@@type": "Product",
  "name": "{{ $product->title }}",
  "image": "{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/800x450' }}",
  "description": "{{ strip_tags($product->description) }}",
  "brand": {
    "@@type": "Brand",
    "name": "{{ $siteName }}"
  },
  "offers": {
    "@@type": "Offer",
    "url": "{{ route('produk.detail', $product->slug) }}",
    "priceCurrency": "IDR",
    "price": "{{ $product->price }}",
    "availability": "https://schema.org/InStock"
  }
}
</script>
@endpush

@push('styles')
<style>
/* ============================================================
   RESET & VARIABLES (sama persis dengan products/index)
   ============================================================ */
:root {
    --orange:        #f97316;
    --orange-dark:   #ea6d0e;
    --orange-light:  #fff7ed;
    --orange-border: #fed7aa;
    --gray-900:      #111827;
    --gray-700:      #374151;
    --gray-500:      #6b7280;
    --gray-400:      #9ca3af;
    --gray-100:      #f3f4f6;
    --gray-50:       #f9fafb;
    --white:         #ffffff;
    --radius-sm:     8px;
    --radius-md:     12px;
    --radius-lg:     16px;
    --radius-xl:     20px;
    --radius-full:   100px;
    --shadow-sm:     0 1px 4px rgba(0,0,0,0.06);
    --shadow-md:     0 4px 16px rgba(0,0,0,0.08);
    --shadow-orange: 0 8px 30px rgba(249,115,22,0.2);
    --transition:    all 0.2s ease;
    --container:     1280px;
}

/* ============================================================
   BREADCRUMB
   ============================================================ */
.pd-breadcrumb {
    background: var(--white);
    border-bottom: 1.5px solid var(--gray-100);
    padding: 14px 0;
}
.pd-breadcrumb-inner {
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 64px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--gray-400);
    flex-wrap: wrap;
}
.pd-breadcrumb a {
    color: var(--gray-500);
    text-decoration: none;
    transition: var(--transition);
}
.pd-breadcrumb a:hover { color: var(--orange); }
.pd-breadcrumb-sep {
    color: var(--gray-400);
    font-size: 11px;
}
.pd-breadcrumb-current {
    color: var(--gray-900);
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 260px;
}

/* ============================================================
   MAIN LAYOUT
   ============================================================ */
.pd-wrap {
    background: var(--gray-50);
    min-height: 60vh;
    padding: 40px 0;
}
.pd-inner {
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 64px;
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 40px;
    align-items: start;
}

/* ============================================================
   GALLERY (kiri atas)
   ============================================================ */
.pd-gallery {
    background: var(--white);
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-lg);
    overflow: hidden;
}
.pd-gallery-main {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: var(--gray-100);
    position: relative;
}
.pd-gallery-main img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
    cursor: zoom-in;
}
.pd-gallery-main img:hover { transform: scale(1.03); }
.pd-gallery-thumbs {
    display: flex;
    gap: 10px;
    padding: 14px;
    overflow-x: auto;
    scrollbar-width: none;
}
.pd-gallery-thumbs::-webkit-scrollbar { display: none; }
.pd-gallery-thumb {
    flex-shrink: 0;
    width: 72px; height: 52px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 2px solid var(--gray-100);
    cursor: pointer;
    transition: var(--transition);
}
.pd-gallery-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
}
.pd-gallery-thumb:hover,
.pd-gallery-thumb.active {
    border-color: var(--orange);
}

/* ============================================================
   PRODUCT INFO (kiri bawah)
   ============================================================ */
.pd-info .pd-content h2 {
    font-size: 20px;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: 12px;
}
.pd-info-title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--orange);
    margin-bottom: 16px;
    margin-top: 32px;
}
.pd-desc {
    font-size: 14px;
    color: var(--gray-700);
    line-height: 1.8;
}
.pd-desc p { margin-bottom: 12px; }
.pd-desc p:last-child { margin-bottom: 0; }

/* ============================================================
   SIDEBAR (kanan)
   ============================================================ */
.pd-sidebar {
    position: sticky;
    top: 100px; /* Adjust top so it clears navbar */
    display: flex;
    flex-direction: column;
    gap: 16px;
}

/* Card Harga & Aksi */
.pd-buy-card {
    background: var(--white);
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-lg);
    padding: 24px;
}
.pd-buy-cat {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--orange-light);
    color: var(--orange);
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: var(--radius-full);
    margin-bottom: 14px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}
.pd-buy-title {
    font-size: 20px;
    font-weight: 800;
    color: var(--gray-900);
    line-height: 1.3;
    margin-bottom: 6px;
}
.pd-buy-price {
    font-size: 32px;
    font-weight: 800;
    color: var(--orange);
    margin-bottom: 6px;
    letter-spacing: -0.02em;
}
.pd-buy-divider {
    border: none;
    border-top: 1.5px solid var(--gray-100);
    margin: 20px 0;
}
.pd-btn-wa {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 14px;
    background: var(--orange);
    color: var(--white);
    font-weight: 700;
    font-size: 14px;
    border-radius: var(--radius-md);
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    margin-bottom: 10px;
}
.pd-btn-wa:hover {
    background: var(--orange-dark);
    box-shadow: var(--shadow-orange);
    transform: translateY(-1px);
}
.pd-btn-demo {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 12px;
    background: var(--white);
    color: var(--gray-700);
    font-weight: 600;
    font-size: 14px;
    border-radius: var(--radius-md);
    text-decoration: none;
    border: 1.5px solid var(--gray-100);
    cursor: pointer;
    transition: var(--transition);
}
.pd-btn-demo:hover {
    border-color: var(--orange);
    color: var(--orange);
}
.pd-feature-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
.pd-feature-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-md);
    background: var(--white);
    transition: var(--transition);
}
.pd-feature-card:hover { border-color: var(--orange-border); box-shadow: var(--shadow-sm); }
.pd-feature-icon {
    width: 40px; height: 40px;
    border-radius: var(--radius-sm);
    background: var(--orange-light);
    color: var(--orange);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.pd-info-box {
    background: var(--white);
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-lg);
    padding: 24px;
    margin-top: 24px;
}
.pd-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
    padding: 12px 0;
    border-bottom: 1px dashed var(--gray-100);
}
.pd-info-row:last-child { border-bottom: none; padding-bottom: 0; }
.pd-info-label { color: var(--gray-500); }
.pd-info-value { color: var(--gray-900); font-weight: 600; text-align: right; }

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 1024px) {
    .pd-breadcrumb-inner { padding: 0 32px; }
    .pd-inner { padding: 0 32px; grid-template-columns: 1fr 320px; gap: 24px; }
}
@media (max-width: 768px) {
    .pd-breadcrumb-inner { padding: 0 20px; }
    .pd-inner { padding: 0 20px; grid-template-columns: 1fr; }
    .pd-sidebar { position: static; }
}
@media (max-width: 480px) {
    .pd-buy-price { font-size: 26px; }
}

/* ============================================================
   PRODUCT DESCRIPTION CONTENT
   ============================================================ */
.pd-info .pd-content { color: var(--gray-900); font-size: 14px; line-height: 1.8; }
.pd-info .pd-content h2 {
    font-size: 20px;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: 12px;
}
.pd-info .pd-content h3 {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--orange);
    margin-top: 28px;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1.5px solid var(--orange-border);
}
.pd-info .pd-content p { color: var(--gray-900); margin-bottom: 12px; }
.pd-info .pd-content p:last-child { margin-bottom: 0; }
.pd-info .pd-content ul, .pd-info .pd-content ol {
    padding-left: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.pd-info .pd-content ul li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: var(--gray-900);
}
.pd-info .pd-content ul li::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--orange);
    flex-shrink: 0;
    margin-top: 6px;
}
.pd-info .pd-content ol li {
    font-size: 13px;
    color: var(--gray-900);
    list-style-type: decimal;
    margin-left: 20px;
}
.pd-info .pd-content strong { color: var(--gray-900); font-weight: 700; }
</style>
@endpush

@section('content')
<!-- ===== BREADCRUMB ===== -->
<div class="pd-breadcrumb pt-[100px] md:pt-[100px]"> <!-- extra padding due to fixed navbar -->
    <div class="pd-breadcrumb-inner">
        <a href="{{ route('home') }}">{{ __('Beranda') }}</a>
        <span class="pd-breadcrumb-sep">›</span>
        <a href="{{ route('produk') }}">{{ __('Produk') }}</a>
        <span class="pd-breadcrumb-sep">›</span>
        <span class="pd-breadcrumb-current">{{ $product->title }}</span>
    </div>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="pd-wrap" x-data="{ orderModalOpen: false }">
    <div class="pd-inner">
        <!-- Alert Success -->
        @if(session('order_success'))
        <div class="col-span-1 md:col-span-2 mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3 text-green-700">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <p class="text-sm font-medium">{{ session('order_success') }}</p>
        </div>
        @endif

        <!-- KIRI: Gallery + Deskripsi -->
        <div>
            <!-- Gallery -->
            <div class="pd-gallery">
                <div class="pd-gallery-main">
                    <img id="galleryMain"
                         src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/hero-fallback.jpg') }}"
                         alt="{{ $product->title }}"
                         style="background-color: #f3f4f6;"
                         onerror="this.src='https://via.placeholder.com/800x450'; this.onerror=null;">
                </div>
            </div>

            <!-- Deskripsi & Spesifikasi -->
            <div class="pd-info">
                <div class="pd-info-title">{{ __('Deskripsi Produk') }}</div>
                <div class="pd-desc pd-content">
                    {!! $product->content ?? $product->description !!}
                </div>
            </div>

            <!-- Spesifikasi & Fitur -->
            <div class="mt-12">
                <div class="pd-info-title">{{ __('Spesifikasi & Fitur') }}</div>
                <div class="pd-feature-grid">
                    @php
                        $features = $product->features ?? [
                            ['icon' => 'monitor', 'name' => 'Tampilan', 'value' => 'Fully Responsive'],
                            ['icon' => 'description', 'name' => 'Dokumentasi', 'value' => 'Tersedia'],
                            ['icon' => 'download', 'name' => 'Source Code', 'value' => 'Termasuk'],
                            ['icon' => 'support_agent', 'name' => 'Support', 'value' => 'Via WhatsApp'],
                            ['icon' => 'sell', 'name' => 'Versi', 'value' => '1.0.0'],
                        ];
                    @endphp
                    @foreach($features as $feature)
                    <div class="pd-feature-card">
                        <div class="pd-feature-icon"><span class="material-symbols-outlined text-[20px]">{{ $feature['icon'] ?? 'check_circle' }}</span></div>
                        <div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ __($feature['name'] ?? '') }}</div>
                            <div class="text-sm font-bold text-gray-900">{{ __($feature['value'] ?? '') }}</div>
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- Kategori is always shown -->
                    <div class="pd-feature-card">
                        <div class="pd-feature-icon"><span class="material-symbols-outlined text-[20px]">category</span></div>
                        <div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ __('Kategori') }}</div>
                            <div class="text-sm font-bold text-gray-900">{{ __($product->category->name ?? 'Uncategorized') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KANAN: Sidebar -->
        <div class="pd-sidebar">
            <!-- Card Harga & Beli -->
            <div class="pd-buy-card">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-orange-500 text-sm">sell</span>
                    <span class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">{{ $product->category->name ?? 'Uncategorized' }}</span>
                </div>
                
                <h1 class="pd-buy-title text-[22px] mb-2">{{ $product->title }}</h1>
                <div class="text-xs font-semibold text-gray-400 mb-6">Versi {{ $product->version ?? '1.0.0' }}</div>
                
                <div class="bg-orange-50 rounded-xl p-5 mb-6 text-center border border-orange-100">
                    <div class="text-[11px] font-bold text-orange-500 uppercase tracking-widest mb-2">{{ __('Harga Terbaik Untuk Anda') }}</div>
                    <div class="text-[13px] text-orange-700 leading-relaxed">{{ __('Hubungi kami untuk mendapatkan penawaran harga yang transparan dan sesuai kebutuhan bisnis Anda.') }}</div>
                </div>

                <button type="button" @click="orderModalOpen = true" class="pd-btn-wa bg-primary hover:bg-primary/90 shadow-sm border-none text-white mb-3">
                    <span class="material-symbols-outlined text-[20px]">shopping_cart</span>
                    {{ __('Pesan Sekarang') }}
                </button>

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactPhone ?: '6281234567890') }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->title) }}" target="_blank" class="pd-btn-demo mb-3 text-orange-600 border-orange-200 hover:border-orange-500">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="w-5 h-5">
                    {{ __('Diskusi via WhatsApp') }}
                </a>
                
                @if($product->demo_link)
                <a href="{{ $product->demo_link }}" target="_blank" class="pd-btn-demo">
                    <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                    {{ __('Lihat Live Demo') }}
                </a>
                @endif
            </div>

            <!-- Informasi Produk -->
            <div class="pd-info-box">
                <div class="text-[11px] font-bold text-orange-500 uppercase tracking-widest mb-4">{{ __('Informasi Produk') }}</div>
                <div class="pd-info-row">
                    <span class="pd-info-label">{{ __('Kategori') }}</span>
                    <span class="pd-info-value">{{ __($product->category->name ?? 'Uncategorized') }}</span>
                </div>
                <div class="pd-info-row">
                    <span class="pd-info-label">{{ __('Versi') }}</span>
                    <span class="pd-info-value">{{ $product->version ?? '1.0.0' }}</span>
                </div>
                <div class="pd-info-row">
                    <span class="pd-info-label">{{ __('Tanggal Rilis') }}</span>
                    <span class="pd-info-value">{{ $product->release_date ? $product->release_date->format('d M Y') : ($product->created_at ? $product->created_at->format('d M Y') : '-') }}</span>
                </div>
                <div class="pd-info-row">
                    <span class="pd-info-label">{{ __('Update Terakhir') }}</span>
                    <span class="pd-info-value">{{ $product->updated_at ? $product->updated_at->format('d M Y') : '-' }}</span>
                </div>
            </div>

            <!-- Share Produk (SEO Best Practice: noopener noreferrer) -->
            <div class="pd-info-box" style="margin-top: 24px;">
                <div class="text-[11px] font-bold text-orange-500 uppercase tracking-widest mb-4">{{ __('Bagikan Produk') }}</div>
                <div class="flex flex-wrap gap-3">
                    @php
                        $shareUrl = urlencode(url()->current());
                        $shareTitle = urlencode($product->title);
                        $shareText = urlencode('Lihat produk keren ini: ' . $product->title);
                    @endphp
                    
                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:-translate-y-1 hover:shadow-lg transition-all" title="Bagikan ke WhatsApp">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:-translate-y-1 hover:shadow-lg transition-all" title="Bagikan ke Facebook">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <!-- X / Twitter -->
                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center hover:-translate-y-1 hover:shadow-lg transition-all" title="Bagikan ke X">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 24.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#0A66C2] text-white flex items-center justify-center hover:-translate-y-1 hover:shadow-lg transition-all" title="Bagikan ke LinkedIn">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <!-- Copy Link -->
                    <button type="button" 
                            x-data="{ copied: false }" 
                            @click="navigator.clipboard.writeText('{{ url()->current() }}').then(() => { copied = true; setTimeout(() => copied = false, 2000) })" 
                            class="relative w-10 h-10 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center hover:-translate-y-1 hover:bg-gray-200 transition-all border border-gray-200" 
                            title="Salin Tautan">
                        <span class="material-symbols-outlined text-[18px]" x-show="!copied">content_copy</span>
                        <span class="material-symbols-outlined text-[18px] text-green-600" x-show="copied" style="display: none;">check</span>
                        
                        <!-- Tooltip -->
                        <div x-show="copied" 
                             x-transition.opacity.duration.300ms
                             style="display: none;" 
                             class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[11px] font-bold px-2.5 py-1 rounded-md whitespace-nowrap z-10 shadow-lg">
                            Tersalin!
                            <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 border-[5px] border-transparent border-t-gray-900"></div>
                        </div>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== PRODUK TERKAIT ===== -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="max-w-[1280px] mx-auto px-[64px] mt-24 mb-8">
        <div class="text-[11px] font-bold text-orange-500 uppercase tracking-widest mb-1">{{ __('Mungkin Kamu Suka') }}</div>
        <h2 class="text-[28px] font-extrabold text-gray-900 mb-8">{{ __('Produk Terkait') }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <a href="{{ route('produk.detail', $related->slug) }}" class="group block bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:border-orange-200 transition-all duration-300">
                <div class="relative h-44 bg-gray-100 overflow-hidden">
                    <img src="{{ $related->image ? asset('storage/'.$related->image) : 'https://via.placeholder.com/400x250' }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                        <span class="bg-orange-500 text-white text-[12px] font-bold px-4 py-2 rounded-lg shadow-lg">{{ __('Lihat Detail') }}</span>
                    </div>
                    <div class="absolute top-3 left-3">
                        <span class="bg-orange-500 text-white text-[10px] font-bold px-2 py-1 rounded-md shadow-sm">{{ __($related->category->name ?? 'Uncategorized') }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-[15px] font-bold text-gray-900 mb-2 line-clamp-2 leading-snug group-hover:text-orange-500 transition-colors">{{ $related->title }}</h3>
                    <p class="text-[13px] text-gray-500 line-clamp-2 leading-relaxed">{{ $related->description }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- ===== ORDER MODAL ===== -->
    <div x-show="orderModalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="orderModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/75 transition-opacity backdrop-blur-sm"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="orderModalOpen" @click.away="orderModalOpen = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                
                <!-- Modal Header -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900" id="modal-title">{{ __('Form Pemesanan') }}</h3>
                    <button type="button" @click="orderModalOpen = false" class="text-gray-400 hover:text-gray-500">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <form action="{{ route('order.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_type" value="Produk">
                    <input type="hidden" name="item_name" value="{{ $product->title }}">

                    <!-- Modal Body -->
                    <div class="px-6 py-6 space-y-5">
                        
                        <!-- Alert Product Name -->
                        <div class="bg-orange-50 border border-orange-100 rounded-lg p-4 flex items-start gap-3">
                            <span class="material-symbols-outlined text-orange-500 mt-0.5">inventory_2</span>
                            <div>
                                <p class="text-xs text-orange-600 font-semibold uppercase tracking-wider mb-1">{{ __('Memesan Produk') }}</p>
                                <p class="text-sm font-bold text-gray-900">{{ $product->title }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nama Lengkap') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="customer_name" id="customer_name" required class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-orange-500 focus:ring-orange-500" placeholder="Masukkan nama lengkap Anda">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('No. WhatsApp') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="customer_phone" id="customer_phone" required class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-orange-500 focus:ring-orange-500" placeholder="0812...">
                            </div>
                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Email') }}</label>
                                <input type="email" name="customer_email" id="customer_email" class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-orange-500 focus:ring-orange-500" placeholder="opsional@email.com">
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Catatan Tambahan') }}</label>
                            <textarea name="notes" id="notes" rows="3" class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-orange-500 focus:ring-orange-500" placeholder="Ceritakan sedikit tentang kebutuhan Anda..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="orderModalOpen = false" class="rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Batal</button>
                        <button type="submit" class="inline-flex justify-center rounded-lg bg-orange-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">send</span>
                            Kirim Pesanan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
