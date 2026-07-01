@extends('frontend.layouts.app')

@section('title', 'About Us — ' . $siteName)
@section('meta_description', 'Kenali Ozan Project lebih dekat. Kami adalah agency digital profesional yang membantu UMKM dan perusahaan Indonesia berkembang di era digital.')
@section('robots', 'index, follow')

@push('styles')
<style>
    /* Premium Background with Glow */
    .about-hero-wrap {
        background: linear-gradient(180deg, var(--surface) 0%, var(--surface-container-lowest) 100%);
        position: relative;
        overflow: hidden;
    }
    
    .about-glow-1 {
        position: absolute;
        width: 700px;
        height: 700px;
        background: radial-gradient(circle, var(--primary-container) 0%, rgba(255,255,255,0) 70%);
        top: -250px;
        left: -150px;
        opacity: 0.15;
        border-radius: 50%;
        filter: blur(80px);
        z-index: 0;
        pointer-events: none;
    }

    .about-glow-2 {
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, var(--tertiary-container) 0%, rgba(255,255,255,0) 70%);
        bottom: -100px;
        right: -150px;
        opacity: 0.1;
        border-radius: 50%;
        filter: blur(60px);
        z-index: 0;
        pointer-events: none;
    }

    /* Glassmorphism Cards */
    .glass-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02), inset 0 1px 0 rgba(255,255,255,0.7);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 10;
        overflow: hidden;
    }
    
    .glass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.06), inset 0 1px 0 rgba(255,255,255,0.9);
        border-color: rgba(var(--primary-rgb), 0.3);
    }

    .glass-card::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-20deg);
        transition: left 0.7s ease;
    }
    
    .glass-card:hover::before {
        left: 150%;
    }

    /* Stat Cards */
    .stat-card {
        background: var(--surface-bright);
        border: 1px solid var(--outline-variant);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        border-color: rgba(var(--primary-rgb), 1);
        box-shadow: 0 10px 25px rgba(var(--primary-rgb), 0.1);
    }

    /* Icon Box */
    .icon-box {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.1) 0%, rgba(var(--primary-rgb), 0.05) 100%);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(var(--primary-rgb), 0.2);
        transition: all 0.3s ease;
    }

    .glass-card:hover .icon-box {
        background: var(--primary);
        color: var(--on-primary);
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 10px 20px rgba(var(--primary-rgb), 0.3);
    }

    /* CTA Premium */
    .premium-cta {
        background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 100%);
        border-radius: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(var(--primary-rgb), 0.4);
    }

    .cta-orb {
        position: absolute;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        filter: blur(40px);
    }

    .btn-premium {
        background: rgba(255,255,255,0.9);
        color: var(--primary);
        font-weight: 800;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-premium:hover {
        background: #ffffff;
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
</style>
@endpush

@section('content')

    {{-- Hero About --}}
    <section class="about-hero-wrap min-h-[60vh] flex flex-col justify-center pt-32 pb-24">
        <div class="about-glow-1"></div>
        <div class="about-glow-2"></div>

        <div class="max-w-[1200px] mx-auto px-8 md:px-12 relative z-10 w-full text-center">
            
            <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full font-bold text-xs uppercase tracking-widest mb-8 border border-primary/20 mx-auto">
                <span class="material-symbols-outlined text-[16px]">info</span>
                Tentang Ozan Project
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-on-surface leading-[1.1] tracking-tight mb-8 max-w-4xl mx-auto">
                {!! $settings['about_hero_title'] ?? __('Kami Membangun Digital, <br class="hidden md:block"/>Anda Membangun Bisnis') !!}
            </h1>
            
            <p class="text-lg md:text-xl text-on-surface-variant max-w-3xl mx-auto leading-relaxed">
                {{ $settings['about_hero_subtitle'] ?? __('Ozan Project adalah agency digital profesional yang berdedikasi membantu UMKM dan perusahaan Indonesia tumbuh melalui solusi teknologi modern, terukur, dan elegan.') }}
            </p>
        </div>
    </section>

    {{-- Our Story & Stats --}}
    <section class="max-w-[1200px] mx-auto px-8 md:px-12 py-24">
        <div class="grid lg:grid-cols-12 gap-16 items-center">
            
            <!-- Story Text -->
            <div class="lg:col-span-6 space-y-6">
                <h2 class="text-3xl md:text-4xl font-extrabold text-on-surface mb-6">{{ $settings['about_story_title'] ?? __('Cerita Kami') }}</h2>
                <div class="prose max-w-none text-on-surface-variant text-lg leading-relaxed space-y-4">
                    @if(isset($settings['about_story_content']))
                        {!! $settings['about_story_content'] !!}
                    @else
                        <p>
                            {{ __('Ozan Project lahir dari keyakinan bahwa setiap bisnis — besar maupun kecil — berhak mendapatkan solusi digital berkualitas tinggi yang benar-benar bekerja untuk pertumbuhan mereka.') }}
                        </p>
                        <p>
                            {{ __('Kami memulai perjalanan ini dengan membantu UMKM lokal yang ingin masuk ke dunia digital namun tidak tahu harus mulai dari mana. Dari sana, kami berkembang menjadi tim ahli yang berpengalaman dalam membangun website, aplikasi mobile, dan sistem kustom yang tidak hanya tampil mewah, tapi juga menghasilkan konversi nyata.') }}
                        </p>
                        <p class="font-medium text-on-surface border-l-4 border-primary pl-4 py-1 mt-6">
                            {{ __('Saat ini, kami telah menyelesaikan lebih dari') }} <strong>500 {{ __('proyek') }}</strong> {{ __('dan dipercaya oleh ratusan klien dari berbagai industri di seluruh Indonesia.') }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="lg:col-span-6 grid grid-cols-2 gap-6 relative">
                <!-- Decorative element -->
                <div class="absolute inset-0 bg-primary/5 rounded-3xl -rotate-3 scale-105 -z-10"></div>
                
                <div class="stat-card">
                    <span class="stat-number text-primary text-5xl md:text-6xl font-black block mb-2">{{ $settings['about_stat_1_value'] ?? '500+' }}</span>
                    <span class="font-bold text-sm text-on-surface-variant uppercase tracking-widest">{{ $settings['about_stat_1_label'] ?? __('Proyek Selesai') }}</span>
                </div>
                
                <div class="stat-card translate-y-8">
                    <span class="stat-number text-primary text-5xl md:text-6xl font-black block mb-2">{{ $settings['about_stat_2_value'] ?? '120+' }}</span>
                    <span class="font-bold text-sm text-on-surface-variant uppercase tracking-widest">{{ $settings['about_stat_2_label'] ?? __('Produk Digital') }}</span>
                </div>
                
                <div class="stat-card">
                    <span class="stat-number text-primary text-5xl md:text-6xl font-black block mb-2">{{ $settings['about_stat_3_value'] ?? '98%' }}</span>
                    <span class="font-bold text-sm text-on-surface-variant uppercase tracking-widest">{{ $settings['about_stat_3_label'] ?? __('Kepuasan Klien') }}</span>
                </div>
                
                <div class="stat-card translate-y-8">
                    <span class="stat-number text-primary text-5xl md:text-6xl font-black block mb-2">{{ $settings['about_stat_4_value'] ?? '1 Th' }}</span>
                    <span class="font-bold text-sm text-on-surface-variant uppercase tracking-widest">{{ $settings['about_stat_4_label'] ?? __('Garansi Sistem') }}</span>
                </div>
            </div>

        </div>
    </section>

    {{-- Our Values --}}
    <section class="bg-surface-container-lowest py-24 relative overflow-hidden border-y border-outline-variant/30">
        <div class="max-w-[1200px] mx-auto px-8 md:px-12 relative z-10">
            
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-on-surface mb-4">{{ __('Nilai-Nilai Kami') }}</h2>
                <p class="text-lg text-on-surface-variant max-w-2xl mx-auto">{{ __('Prinsip kuat yang memandu setiap baris kode, setiap piksel desain, dan setiap keputusan strategis yang kami buat.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="glass-card p-8 md:p-10">
                    <div class="icon-box">
                        <span class="material-symbols-outlined text-[32px]">favorite</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-on-surface mb-3">{{ __('Klien Selalu Utama') }}</h3>
                    <p class="text-on-surface-variant leading-relaxed">{{ __('Kesuksesan bisnis Anda adalah tolak ukur keberhasilan kami. Setiap fitur yang kami kembangkan berorientasi pada nilai nyata dan ROI untuk klien.') }}</p>
                </div>
                
                <div class="glass-card p-8 md:p-10">
                    <div class="icon-box">
                        <span class="material-symbols-outlined text-[32px]">workspace_premium</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-on-surface mb-3">{{ __('Kualitas Tanpa Kompromi') }}</h3>
                    <p class="text-on-surface-variant leading-relaxed">{{ __('Kami tidak merilis produk setengah jadi. Standar kualitas tinggi (Premium Quality) diterapkan di setiap baris kode dan detail UI/UX.') }}</p>
                </div>
                
                <div class="glass-card p-8 md:p-10">
                    <div class="icon-box">
                        <span class="material-symbols-outlined text-[32px]">lightbulb</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-on-surface mb-3">{{ __('Inovasi Berkelanjutan') }}</h3>
                    <p class="text-on-surface-variant leading-relaxed">{{ __('Dunia digital bergerak cepat. Kami selalu belajar dan bereksperimen untuk memastikan solusi Anda menggunakan teknologi mutakhir yang aman & cepat.') }}</p>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA Premium --}}
    <section class="max-w-[1200px] mx-auto px-8 md:px-12 py-24">
        <div class="bg-primary-container p-12 md:p-20 text-center text-on-primary-container relative overflow-hidden rounded-[32px]">
            
            <!-- CTA Background Effects -->
            <div class="cta-orb w-[400px] h-[400px] top-[-200px] right-[-100px] bg-primary/20"></div>
            <div class="cta-orb w-[300px] h-[300px] bottom-[-150px] left-[-50px] bg-primary/10"></div>

            <div class="relative z-10">
                <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight">{{ $settings['about_cta_title'] ?? __('Siap Mengubah Visi Menjadi Aksi?') }}</h2>
                <p class="text-xl mb-10 max-w-2xl mx-auto opacity-90 font-medium leading-relaxed">
                    {{ $settings['about_cta_subtitle'] ?? __('Jangan biarkan bisnis Anda tertinggal. Mari berdiskusi tentang bagaimana kami bisa membantu Anda mendominasi pasar digital.') }}
                </p>
                
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 bg-primary text-on-primary px-10 py-5 rounded-full text-lg font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                    <span>{{ __('Mulai Konsultasi Gratis') }}</span>
                    <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

@endsection
