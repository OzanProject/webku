<footer class="bg-on-surface text-surface py-xl">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-xl mb-xl">

            {{-- Brand --}}
            <div class="md:col-span-1">
                <a href="{{ route('home') }}">
                    <span class="font-headline-md text-headline-md font-bold text-inverse-primary">{!! $siteName !!}</span>
                </a>
                <p class="font-body-md text-surface-variant mt-sm max-w-xs">
                    {{ $siteDescription ?: 'Solusi digital profesional untuk UMKM dan perusahaan Indonesia yang ingin berkembang di era digital.' }}
                </p>
                {{-- Social Media Icons --}}
                <div class="flex items-center gap-sm mt-md">
                    @if(!empty($socialInstagram))
                    <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-surface/10 hover:bg-surface/20 flex items-center justify-center transition-colors" title="Instagram">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    @endif
                    @if(!empty($socialFacebook))
                    <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-surface/10 hover:bg-surface/20 flex items-center justify-center transition-colors" title="Facebook">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.312h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                    </a>
                    @endif
                    @if(!empty($socialLinkedin))
                    <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-surface/10 hover:bg-surface/20 flex items-center justify-center transition-colors" title="LinkedIn">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Layanan --}}
            <div>
                <h5 class="font-label-md text-label-md text-surface uppercase tracking-wider mb-md">{{ __('Layanan') }}</h5>
                <div class="flex flex-col gap-sm">
                    <a href="{{ route('layanan') }}" class="font-body-md text-surface-variant hover:text-surface transition-colors">{{ __('Pembuatan Website') }}</a>
                    <a href="{{ route('layanan') }}" class="font-body-md text-surface-variant hover:text-surface transition-colors">{{ __('Aplikasi Mobile') }}</a>
                    <a href="{{ route('layanan') }}" class="font-body-md text-surface-variant hover:text-surface transition-colors">{{ __('Sistem Kustom') }}</a>
                </div>
            </div>

            {{-- Kontak (Dynamic from Settings) --}}
            <div>
                <h5 class="font-label-md text-label-md text-surface uppercase tracking-wider mb-md">{{ __('Kontak') }}</h5>
                <div class="flex flex-col gap-sm">
                    @if(!empty($contactEmail))
                    <a href="mailto:{{ $contactEmail }}" class="font-body-md text-surface-variant hover:text-surface transition-colors flex items-center gap-xs">
                        <span class="material-symbols-outlined text-sm">mail</span>
                        {{ $contactEmail }}
                    </a>
                    @endif
                    @if(!empty($contactPhone))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactPhone) }}" target="_blank" class="font-body-md text-surface-variant hover:text-surface transition-colors flex items-center gap-xs">
                        <span class="material-symbols-outlined text-sm">chat</span>
                        {{ $contactPhone }}
                    </a>
                    @endif
                    @if(!empty($contactAddress))
                    <p class="font-body-md text-surface-variant flex items-start gap-xs">
                        <span class="material-symbols-outlined text-sm mt-0.5">location_on</span>
                        {{ $contactAddress }}
                    </p>
                    @endif
                    <a href="{{ route('contact') }}" class="font-body-md text-surface-variant hover:text-surface transition-colors flex items-center gap-xs">
                        <span class="material-symbols-outlined text-sm">send</span>
                        {{ __('Form Kontak') }}
                    </a>
                </div>
            </div>

            {{-- Legal --}}
            <div>
                <h5 class="font-label-md text-label-md text-surface uppercase tracking-wider mb-md">{{ __('Legal') }}</h5>
                <div class="flex flex-col gap-sm">
                    <a href="{{ route('about') }}" class="font-body-md text-surface-variant hover:text-surface transition-colors">About Us</a>
                    <a href="{{ route('privacy') }}" class="font-body-md text-surface-variant hover:text-surface transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="font-body-md text-surface-variant hover:text-surface transition-colors">Terms of Service</a>
                    <a href="{{ route('sitemap') }}" class="font-body-md text-surface-variant hover:text-surface transition-colors">Sitemap</a>
                </div>
            </div>

        </div>

        <div class="border-t border-surface-variant/20 pt-xl flex justify-center items-center">
            <p class="font-label-sm text-label-sm text-surface-variant">
                &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
            </p>
        </div>
    </div>
</footer>

