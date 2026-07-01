@extends('frontend.layouts.app')

@section('title', 'Privacy Policy — ' . $siteName)
@section('meta_description', 'Kebijakan privasi Ozan Project menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi data dan informasi pengunjung website.')
@section('robots', 'index, follow')

@section('content')
<div class="max-w-[800px] mx-auto px-gutter py-xxl">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-xs font-label-sm text-label-sm text-on-surface-variant mb-xl">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-on-surface">Privacy Policy</span>
    </nav>

    <h1 class="font-headline-lg-mobile md:font-headline-lg text-on-surface mb-sm">Privacy Policy</h1>
    <p class="font-body-md text-on-surface-variant mb-xl">Terakhir diperbarui: {{ date('d F Y') }}</p>

    <div class="prose max-w-none space-y-xl">
        @if(!empty($content))
            {!! $content !!}
        @else
            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">1. Informasi yang Kami Kumpulkan</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed mb-md">
                    Ozan Project mengumpulkan informasi yang Anda berikan secara langsung kepada kami, seperti ketika Anda mengisi formulir kontak, memesan layanan, atau berinteraksi dengan website kami. Informasi yang dikumpulkan dapat mencakup:
                </p>
                <ul class="list-disc list-inside space-y-sm font-body-md text-on-surface-variant pl-md">
                    <li>Nama lengkap dan alamat email</li>
                    <li>Nomor telepon (jika diberikan)</li>
                    <li>Informasi pesan atau pertanyaan yang Anda kirimkan</li>
                    <li>Data teknis seperti alamat IP, jenis browser, dan halaman yang dikunjungi</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">2. Penggunaan Informasi</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed mb-md">Informasi yang kami kumpulkan digunakan untuk:</p>
                <ul class="list-disc list-inside space-y-sm font-body-md text-on-surface-variant pl-md">
                    <li>Merespons pertanyaan dan permintaan layanan Anda</li>
                    <li>Meningkatkan kualitas website dan layanan kami</li>
                    <li>Mengirimkan informasi yang relevan dengan permintaan Anda</li>
                    <li>Memenuhi kewajiban hukum yang berlaku</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">3. Cookies</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Website kami menggunakan <em>cookies</em> untuk meningkatkan pengalaman pengguna. Cookies adalah file kecil yang disimpan di perangkat Anda untuk mengingat preferensi dan aktivitas Anda. Anda dapat mengatur browser untuk menolak cookies, namun hal ini dapat mempengaruhi fungsionalitas website.
                </p>
                <p class="font-body-md text-on-surface-variant leading-relaxed mt-md">
                    Website ini menggunakan layanan <strong>Google AdSense</strong> yang dapat menggunakan cookies untuk menampilkan iklan yang relevan berdasarkan kunjungan Anda ke website ini dan website lain. Anda dapat memilih keluar dari iklan yang dipersonalisasi dengan mengunjungi <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener" class="text-primary-container hover:underline">Pengaturan Iklan Google</a>.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">4. Google AdSense & Iklan Pihak Ketiga</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Kami bekerja sama dengan Google AdSense sebagai mitra iklan. Pihak ketiga ini mungkin menggunakan cookies dan web beacon untuk mengumpulkan data guna menampilkan iklan berdasarkan minat Anda. Google menggunakan cookie DART untuk menampilkan iklan berdasarkan kunjungan ke website ini. Pengguna dapat menonaktifkan cookie DART melalui <a href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener" class="text-primary-container hover:underline">Kebijakan Privasi Google untuk Jaringan Konten dan Iklan</a>.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">5. Keamanan Data</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Kami berkomitmen untuk melindungi informasi Anda. Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi data pribadi Anda dari akses tidak sah, perubahan, pengungkapan, atau penghancuran.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">6. Perubahan Kebijakan</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Kami berhak memperbarui Privacy Policy ini sewaktu-waktu. Perubahan akan diumumkan di halaman ini dengan memperbarui tanggal "Terakhir diperbarui" di bagian atas. Kami menyarankan Anda untuk meninjau kebijakan ini secara berkala.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-on-surface mb-md text-2xl">7. Hubungi Kami</h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    Jika Anda memiliki pertanyaan tentang Privacy Policy ini, silakan hubungi kami melalui:
                </p>
                <div class="mt-md p-lg bg-surface-container-low rounded-xl border border-outline-variant/30">
                    <p class="font-body-md text-on-surface"><strong>{{ $siteName }}</strong></p>
                    <p class="font-body-md text-on-surface-variant">Email: <a href="mailto:{{ $contactEmail ?: 'hello@ozanproject.com' }}" class="text-primary-container hover:underline">{{ $contactEmail ?: 'hello@ozanproject.com' }}</a></p>
                    <p class="font-body-md text-on-surface-variant mt-xs">
                        Atau melalui <a href="{{ route('contact') }}" class="text-primary-container hover:underline">halaman kontak kami</a>.
                    </p>
                </div>
            </section>
        @endif
    </div>
</div>
@endsection
