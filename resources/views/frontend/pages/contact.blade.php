@extends('frontend.layouts.app')

@section('title', 'Hubungi Kami — ' . $siteName)
@section('meta_description', 'Konsultasikan kebutuhan digital Anda bersama tim ahli kami. Kami siap membantu mewujudkan solusi website, aplikasi, dan sistem untuk bisnis Anda.')
@section('robots', 'index, follow')

@push('styles')
<style>
    /* Premium Background with Glow */
    .contact-hero-wrap {
        background: linear-gradient(180deg, var(--surface) 0%, var(--surface-container-lowest) 100%);
        position: relative;
        overflow: hidden;
    }
    
    .contact-glow-1 {
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, var(--primary-container) 0%, rgba(255,255,255,0) 70%);
        top: -200px;
        right: -100px;
        opacity: 0.15;
        border-radius: 50%;
        filter: blur(60px);
        z-index: 0;
        pointer-events: none;
    }

    .contact-glow-2 {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, var(--tertiary-container) 0%, rgba(255,255,255,0) 70%);
        bottom: 10%;
        left: -150px;
        opacity: 0.1;
        border-radius: 50%;
        filter: blur(50px);
        z-index: 0;
        pointer-events: none;
    }

    /* Glassmorphism Cards */
    .contact-glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--outline-variant);
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02), inset 0 1px 0 rgba(255,255,255,0.6);
        position: relative;
        z-index: 10;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .contact-glass-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.04), inset 0 1px 0 rgba(255,255,255,0.8);
        border-color: var(--primary-container);
    }

    /* Info Items */
    .contact-info-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--surface-container-lowest);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid var(--outline-variant);
        transition: all 0.3s ease;
    }

    .contact-info-item:hover .contact-info-icon {
        background: var(--primary);
        color: var(--on-primary);
        transform: scale(1.05) rotate(-5deg);
        box-shadow: 0 8px 20px var(--primary-container);
        border-color: var(--primary);
    }

    /* Custom Form Elements */
    .contact-input {
        background: var(--surface-container-lowest);
        border: 1.5px solid var(--outline-variant);
        border-radius: 12px;
        transition: all 0.2s ease;
    }
    
    .contact-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-container);
        background: var(--surface);
    }

    .contact-label {
        font-weight: 700;
        letter-spacing: 0.02em;
        margin-bottom: 8px;
        display: block;
        color: var(--on-surface);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-fixed) 100%);
        position: relative;
        overflow: hidden;
    }
    
    .btn-submit::after {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-20deg);
        transition: left 0.5s ease;
    }
    
    .btn-submit:hover::after {
        left: 150%;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(var(--primary-rgb), 0.3);
    }
    
    /* Social Orbit Animation */
    .social-orbit {
        animation: float-slow 6s ease-in-out infinite;
    }
    @keyframes float-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>
@endpush

@section('content')
<div class="contact-hero-wrap min-h-[80vh] flex flex-col pt-32 pb-24">
    <!-- Glowing Orbs -->
    <div class="contact-glow-1"></div>
    <div class="contact-glow-2"></div>

    <div class="max-w-[1200px] mx-auto w-full px-8 md:px-12 relative z-10 flex-1">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 font-semibold text-sm text-on-surface-variant mb-12">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Beranda
            </a>
            <span class="material-symbols-outlined text-sm opacity-50">chevron_right</span>
            <span class="text-primary">Kontak</span>
        </nav>

        <div class="grid lg:grid-cols-5 gap-16 lg:gap-24 items-start">
            
            <!-- Left Side: Information -->
            <div class="lg:col-span-2 flex flex-col pt-4">
                <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full font-bold text-xs uppercase tracking-widest mb-6 w-max border border-primary/20">
                    <span class="material-symbols-outlined text-[16px]">support_agent</span>
                    Hubungi Kami
                </div>
                
                <h1 class="text-4xl md:text-5xl font-extrabold text-on-surface leading-[1.1] tracking-tight mb-6">
                    {{ $contactTitle ?? 'Ayo Bicara!' }}
                </h1>
                
                <p class="text-lg text-on-surface-variant leading-relaxed mb-12 max-w-md">
                    {{ $contactSubtitle ?? 'Ceritakan kebutuhan digital Anda dan tim kami akan merespons dalam 1x24 jam kerja.' }}
                </p>

                <div class="flex flex-col gap-8">
                    
                    <!-- Email Item -->
                    <a href="mailto:{{ $contactEmail ?: 'hello@example.com' }}" class="contact-info-item group flex gap-5 items-start text-decoration-none">
                        <div class="contact-info-icon">
                            <span class="material-symbols-outlined text-[24px]">mail</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface-variant text-sm uppercase tracking-wider mb-1">Email Resmi</h3>
                            <p class="text-lg font-bold text-on-surface group-hover:text-primary transition-colors">{{ $contactEmail ?: 'Belum diatur' }}</p>
                        </div>
                    </a>

                    <!-- Phone Item -->
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactPhone ?: '6281234567890') }}" target="_blank" class="contact-info-item group flex gap-5 items-start text-decoration-none">
                        <div class="contact-info-icon">
                            <span class="material-symbols-outlined text-[24px]">chat</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface-variant text-sm uppercase tracking-wider mb-1">WhatsApp / Telepon</h3>
                            <p class="text-lg font-bold text-on-surface group-hover:text-primary transition-colors">{{ $contactPhone ?: 'Belum diatur' }}</p>
                        </div>
                    </a>

                    <!-- Address Item -->
                    @if($contactAddress)
                    <div class="contact-info-item group flex gap-5 items-start">
                        <div class="contact-info-icon">
                            <span class="material-symbols-outlined text-[24px]">location_on</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface-variant text-sm uppercase tracking-wider mb-1">Alamat Kantor</h3>
                            <p class="text-[15px] font-medium text-on-surface leading-relaxed max-w-[280px]">{{ $contactAddress }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Working Hours Item -->
                    <div class="contact-info-item group flex gap-5 items-start">
                        <div class="contact-info-icon">
                            <span class="material-symbols-outlined text-[24px]">schedule</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface-variant text-sm uppercase tracking-wider mb-1">Jam Kerja</h3>
                            <p class="text-[15px] font-medium text-on-surface leading-relaxed">{{ $contactWorkingHours ?? 'Senin - Jumat: 09.00 - 17.00' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                @if($socialInstagram || $socialFacebook || $socialLinkedin)
                <div class="mt-16 pt-10 border-t border-outline-variant/50">
                    <h3 class="font-bold text-on-surface-variant text-sm uppercase tracking-wider mb-6">Terhubung di Sosial Media</h3>
                    <div class="flex gap-4">
                        @if($socialInstagram)
                        <a href="{{ $socialInstagram }}" target="_blank" class="w-12 h-12 rounded-full bg-surface-container-lowest border border-outline-variant flex items-center justify-center text-on-surface hover:bg-[#E1306C] hover:text-white hover:border-[#E1306C] transition-all social-orbit" style="animation-delay: 0s;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" alt="Instagram" class="w-5 h-5 filter grayscale group-hover:grayscale-0 transition-all">
                        </a>
                        @endif
                        
                        @if($socialLinkedin)
                        <a href="{{ $socialLinkedin }}" target="_blank" class="w-12 h-12 rounded-full bg-surface-container-lowest border border-outline-variant flex items-center justify-center text-on-surface hover:bg-[#0077b5] hover:text-white hover:border-[#0077b5] transition-all social-orbit" style="animation-delay: 0.2s;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="LinkedIn" class="w-5 h-5 filter grayscale group-hover:grayscale-0 transition-all">
                        </a>
                        @endif
                        
                        @if($socialFacebook)
                        <a href="{{ $socialFacebook }}" target="_blank" class="w-12 h-12 rounded-full bg-surface-container-lowest border border-outline-variant flex items-center justify-center text-on-surface hover:bg-[#1877F2] hover:text-white hover:border-[#1877F2] transition-all social-orbit" style="animation-delay: 0.4s;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" class="w-5 h-5 filter grayscale group-hover:grayscale-0 transition-all">
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Side: Form Card -->
            <div class="lg:col-span-3">
                <div class="contact-glass-card p-8 md:p-12">
                    
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-on-surface mb-2">Kirim Pesan Langsung</h2>
                        <p class="text-on-surface-variant text-sm">Isi form di bawah ini dan kami akan segera membalas ke email Anda.</p>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                    <div class="bg-[#10b981]/10 border border-[#10b981]/30 text-[#047857] rounded-xl p-5 mb-8 flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-[#10b981]/20 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-[18px]">done</span>
                        </div>
                        <div>
                            <h4 class="font-bold mb-1">Pesan Terkirim!</h4>
                            <p class="text-sm opacity-90">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="flex flex-col gap-6">
                        @csrf

                        {{-- Honeypot field for bot protection (visually hidden) --}}
                        <div style="display:none;" aria-hidden="true">
                            <label for="website_url">Website</label>
                            <input type="text" name="website_url" id="website_url" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="contact-label text-sm">Nama Lengkap <span class="text-error">*</span></label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-[20px]">person</span>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" class="contact-input w-full pl-11 pr-4 py-3.5 text-base outline-none {{ $errors->has('name') ? 'border-error' : '' }}" required>
                                </div>
                                @error('name')<p class="text-xs text-error mt-2 font-medium">{{ $message }}</p>@enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="contact-label text-sm">Alamat Email <span class="text-error">*</span></label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-[20px]">alternate_email</span>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="hello@johndoe.com" class="contact-input w-full pl-11 pr-4 py-3.5 text-base outline-none {{ $errors->has('email') ? 'border-error' : '' }}" required>
                                </div>
                                @error('email')<p class="text-xs text-error mt-2 font-medium">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="contact-label text-sm">Topik Diskusi</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-[20px]">topic</span>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Misal: Pembuatan Website E-Commerce" class="contact-input w-full pl-11 pr-4 py-3.5 text-base outline-none">
                            </div>
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="contact-label text-sm">Pesan Anda <span class="text-error">*</span></label>
                            <textarea id="message" name="message" rows="5" placeholder="Jelaskan kebutuhan atau kendala Anda secara detail..." class="contact-input w-full p-4 text-base outline-none resize-none {{ $errors->has('message') ? 'border-error' : '' }}" required>{{ old('message') }}</textarea>
                            @error('message')<p class="text-xs text-error mt-2 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn-submit w-full text-on-primary font-bold text-base py-4 rounded-xl flex items-center justify-center gap-3 transition-all">
                                <span>Kirim Pesan Sekarang</span>
                                <span class="material-symbols-outlined text-[20px]">send</span>
                            </button>
                            <p class="text-center text-xs text-on-surface-variant mt-4 font-medium">
                                Informasi Anda aman dan tidak akan dibagikan ke pihak ketiga.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
