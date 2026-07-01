@extends('frontend.layouts.app')

@section('title', 'Terms of Service — ' . $siteName)
@section('meta_description', 'Syarat dan ketentuan penggunaan layanan Ozan Project. Baca ketentuan ini sebelum menggunakan website dan layanan kami.')
@section('robots', 'index, follow')

@section('content')
<div class="max-w-[800px] mx-auto px-gutter py-xxl">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-xs font-label-sm text-label-sm text-on-surface-variant mb-xl">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-on-surface">Terms of Service</span>
    </nav>

    <h1 class="font-headline-lg-mobile md:font-headline-lg text-on-surface mb-sm">Terms of Service</h1>
    <p class="font-body-md text-on-surface-variant mb-xl">Terakhir diperbarui: {{ date('d F Y') }}</p>

    <div class="space-y-xl prose max-w-none">
        @if(!empty($content))
            {!! $content !!}
        @else
            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">1. Penerimaan Syarat</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Dengan mengakses dan menggunakan website Ozan Project (<strong>ozanproject.com</strong>), Anda menyetujui untuk terikat oleh syarat dan ketentuan penggunaan ini. Jika Anda tidak menyetujui syarat-syarat ini, harap tidak menggunakan layanan kami.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">2. Layanan yang Disediakan</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed mb-md">
                    Ozan Project menyediakan layanan pengembangan digital yang meliputi:
                </p>
                <ul class="list-disc list-inside space-y-sm font-body-md text-on-surface-variant pl-md">
                    <li>Pembuatan website profesional dan responsif</li>
                    <li>Pengembangan aplikasi mobile (Android dan iOS)</li>
                    <li>Pengembangan sistem informasi dan manajemen bisnis kustom</li>
                    <li>Konsultasi strategi digital</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">3. Hak Kekayaan Intelektual</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Seluruh konten pada website ini, termasuk namun tidak terbatas pada teks, gambar, logo, dan desain, adalah milik Ozan Project atau pemberi lisensi kami dan dilindungi oleh hukum hak cipta yang berlaku. Anda tidak diperkenankan mereproduksi, mendistribusikan, atau membuat karya turunan tanpa izin tertulis dari kami.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">4. Pembatasan Tanggung Jawab</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Ozan Project tidak bertanggung jawab atas kerugian langsung, tidak langsung, insidental, atau konsekuensial yang timbul dari penggunaan atau ketidakmampuan untuk menggunakan layanan kami. Kami berupaya memastikan keakuratan informasi, namun tidak memberikan jaminan atas kelengkapan atau keandalan konten.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">5. Tautan Pihak Ketiga</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Website kami dapat berisi tautan ke website pihak ketiga. Tautan ini disediakan untuk kemudahan dan informasi Anda. Ozan Project tidak memiliki kontrol atas isi website tersebut dan tidak bertanggung jawab atas konten atau kebijakan privasi mereka.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">6. Perubahan Layanan</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Kami berhak untuk mengubah, menangguhkan, atau menghentikan layanan kapan saja tanpa pemberitahuan sebelumnya. Kami juga berhak memperbarui Syarat dan Ketentuan ini sewaktu-waktu. Perubahan akan berlaku segera setelah dipublikasikan di halaman ini.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">7. Hukum yang Berlaku</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Syarat dan Ketentuan ini diatur oleh dan ditafsirkan sesuai dengan hukum yang berlaku di Republik Indonesia. Setiap sengketa yang timbul akan diselesaikan melalui musyawarah mufakat atau jalur hukum yang berlaku di Indonesia.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">8. Hubungi Kami</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Pertanyaan mengenai Syarat dan Ketentuan ini dapat dikirimkan ke:
                    <a href="mailto:{{ $contactEmail ?: 'hello@ozanproject.com' }}" class="text-primary-container hover:underline">{{ $contactEmail ?: 'hello@ozanproject.com' }}</a>
                    atau melalui <a href="{{ route('contact') }}" class="text-primary-container hover:underline">halaman kontak</a>.
                </p>
            </section>
        @endif
    </div>
</div>
@endsection
