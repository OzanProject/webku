@extends('frontend.layouts.app')
@section('title', 'Produk Digital - ' . $siteName)
@section('meta_description', 'Berbagai solusi digital berkualitas untuk mendukung bisnis Anda.')

@push('styles')
@include('frontend.partials.produk-css')
@endpush

@section('content')
<!-- ===== HERO ===== -->
<section class="pr-hero" style="background-image: url('https://khalimzone.com/assets/images/hero-products.png');">
    <div class="pr-hero-inner">
        <div>
            <p class="pr-hero-label">{{ __('Produk Digital') }} {{ config('app.name') }}</p>
            <h1 class="pr-hero-title">{!! __('Temukan Produk Digital<br>Sesuai Kebutuhan Anda') !!}</h1>
            <p class="pr-hero-sub">{{ __('Berbagai solusi digital berkualitas untuk mendukung bisnis Anda lebih profesional, efisien, dan berkembang.') }}</p>
            <form method="get" action="{{ route('produk') }}" class="pr-hero-search">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Cari produk digital yang Anda butuhkan...') }}">
                @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <button type="submit">{{ __('Cari') }}</button>
            </form>
            <div class="pr-hero-badges">
                <span class="pr-hero-badge">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    {{ \App\Models\Product::count() }}+ Produk
                </span>
                <span class="pr-hero-badge">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    {{ __('Berkualitas Tinggi') }}
                </span>
                <span class="pr-hero-badge">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    {{ __('Support Terbaik') }}
                </span>
            </div>
        </div>
    </div>
</section>

<!-- ===== CATEGORY TABS ===== -->
<div class="pr-tabs-wrap">
    <div class="pr-tabs-inner">
        <a href="{{ route('produk') }}" class="pr-tab {{ !request('category') || request('category') == 'semua' ? 'active' : '' }}">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            {{ __('Semua Produk') }}
        </a>
        @foreach($navCategories as $category)
        <a href="{{ route('produk', ['category' => $category->slug]) }}" class="pr-tab {{ request('category') == $category->slug ? 'active' : '' }}">
            {{ __($category->name) }}
        </a>
        @endforeach
    </div>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div style="background: var(--gray-50); min-height: 500px; padding-bottom: 80px;">
<form method="get" action="{{ route('produk') }}" id="filterForm">
    <input type="hidden" name="q" value="{{ request('q') }}">
    
    <div class="pr-main">

        <!-- SIDEBAR -->
        <aside class="pr-sidebar">
            <!-- Kategori -->
            <div class="pr-sidebar-section">
                <div class="pr-sidebar-title">{{ __('Kategori') }}</div>
                @php
                    $currentCategory = request('category', 'semua');
                @endphp
                
                <div class="pr-sidebar-item">
                    <label>
                        <input type="radio" name="category" value="semua" onchange="this.form.submit()" {{ $currentCategory == 'semua' ? 'checked' : '' }}>
                        {{ __('Semua Kategori') }}
                    </label>
                </div>
                
                @foreach($navCategories as $category)
                <div class="pr-sidebar-item">
                    <label>
                        <input type="radio" name="category" value="{{ $category->slug }}" onchange="this.form.submit()" {{ $currentCategory == $category->slug ? 'checked' : '' }}>
                        {{ __($category->name) }}
                    </label>
                </div>
                @endforeach
            </div>
        </aside>

        <!-- PRODUCT GRID -->
        <div>
            <div class="pr-topbar">
                <div class="pr-topbar-info">
                    {{ __('Menampilkan') }} <strong>{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</strong> {{ __('dari') }} <strong>{{ $products->total() }}</strong> {{ __('produk dalam') }} <strong>{{ $categoryName ? __($categoryName) : __('Semua Kategori') }}</strong>
                    @if(request('q'))
                        {{ __('untuk pencarian') }} "<strong>{{ request('q') }}</strong>"
                    @endif
                </div>
                
                <div class="pr-sort">
                    <label for="sort" class="hidden md:inline-block">{{ __('Urutkan:') }}</label>
                    <select name="sort" id="sort" onchange="this.form.submit()">
                        <option value="">{{ __('Rekomendasi (Standar)') }}</option>
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>{{ __('Terbaru') }}</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>{{ __('Terlama') }}</option>
                    </select>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="pr-grid">
                    @foreach($products as $product)
                    <div class="pr-card" onclick="window.location.href='{{ route('produk.detail', $product->slug) }}'">
                        <div class="pr-card-img">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400x250' }}" alt="{{ $product->title }}">
                            <div class="pr-card-cat">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            <div class="pr-card-overlay">
                                <a href="{{ route('produk.detail', $product->slug) }}" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                        <div class="pr-card-body">
                            <div class="pr-card-name">{{ $product->title }}</div>
                            <div class="pr-card-desc">{{ $product->description }}</div>
                            <div class="pr-card-footer">
                                <span class="pr-card-price-cta">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                <a href="{{ route('produk.detail', $product->slug) }}" class="pr-card-cta-mini">Detail <span class="material-symbols-outlined text-[14px]">arrow_forward</span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="pr-pagination">
                    {{ $products->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="pr-empty">
                    <div class="pr-empty-icon">
                        <span class="material-symbols-outlined text-[28px] text-gray-400">search_off</span>
                    </div>
                    <div class="pr-empty-title">{{ __('Produk tidak ditemukan') }}</div>
                    <div class="pr-empty-sub">{{ __('Coba ubah kata kunci pencarian atau pilih kategori lain.') }}</div>
                </div>
            @endif

        </div>

    </div>
</form>
</div>
@endsection
