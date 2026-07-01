<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrontendContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Settings ---
        $settings = [
            // Hero
            ['group' => 'hero', 'key' => 'hero_title', 'value' => 'Website yang Bukan Cuma Tampil Keren, Tapi Bantu Bisnis Anda Dapat Customer'],
            ['group' => 'hero', 'key' => 'hero_subtitle', 'value' => 'Kami membantu UMKM dan perusahaan membangun sistem digital modern, efisien, dan berorientasi pada konversi.'],
            ['group' => 'hero', 'key' => 'hero_btn1_text', 'value' => 'Jelajahi Produk'],
            ['group' => 'hero', 'key' => 'hero_btn2_text', 'value' => 'Lihat Portofolio'],
            ['group' => 'hero', 'key' => 'hero_trust_badge', 'value' => 'Dipercaya oleh 500+ UMKM di Indonesia'],
            ['group' => 'hero', 'key' => 'hero_image_url', 'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAgoyaneOQhoHeoDTaWzZDFeB4s-dSnHDalpGRAlK_T6E8TR3NvhjDItF961t3QJd6Ee7QLLyb3YbohWK21ursLhO7MdeTJyOeHR2a0hwg44FnYXDnTuod4fQAwBxZ-08vtBwZAOKlYz5b1CuLAzlkSfU_yD2yGC0PoVhJwAUE_o4kGSn_wWpSnlnzkNXNpp3bS0HIS5Dl-U0T8YuZZoR_o412QRqemCeofYkc6rHxW59xG-9-nb7q8KESdB-lBiRHqe7U26_9FynI'],
            
            // Why Us
            ['group' => 'why_us', 'key' => 'why_us_title', 'value' => 'Kenapa Memilih Kami?'],
            ['group' => 'why_us', 'key' => 'why_us_subtitle', 'value' => 'Lebih dari sekadar pembuat website, kami adalah partner teknologi untuk pertumbuhan bisnis Anda.'],
            
            // CTA
            ['group' => 'cta', 'key' => 'cta_title', 'value' => 'Siap Go Digital Bersama Kami?'],
            ['group' => 'cta', 'key' => 'cta_subtitle', 'value' => 'Tingkatkan profit bisnis Anda dengan sistem yang tepat sasaran.'],
            ['group' => 'cta', 'key' => 'cta_btn_text', 'value' => 'Konsultasi Gratis Sekarang'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // --- Stats ---
        if (\App\Models\Stat::count() === 0) {
            \App\Models\Stat::insert([
                ['value' => '120+', 'label' => 'Produk Digital', 'sort_order' => 1],
                ['value' => '98%', 'label' => 'Klien Puas', 'sort_order' => 2],
                ['value' => '50M+', 'label' => 'Total Transaksi', 'sort_order' => 3],
                ['value' => '24/7', 'label' => 'Support Aktif', 'sort_order' => 4],
            ]);
        }

        // --- Services ---
        if (\App\Models\Service::count() === 0) {
            \App\Models\Service::insert([
                ['icon' => 'language', 'title' => 'Website Company Profile', 'description' => 'Tingkatkan kredibilitas bisnis Anda dengan website profesional yang meyakinkan calon pelanggan.', 'sort_order' => 1],
                ['icon' => 'shopping_cart', 'title' => 'Toko Online (E-Commerce)', 'description' => 'Jual produk Anda 24 jam non-stop dengan sistem e-commerce terintegrasi payment gateway.', 'sort_order' => 2],
                ['icon' => 'smartphone', 'title' => 'Aplikasi Mobile', 'description' => 'Berikan kemudahan akses bagi pelanggan dengan aplikasi Android dan iOS yang user-friendly.', 'sort_order' => 3],
                ['icon' => 'database', 'title' => 'Sistem Kustom', 'description' => 'Otomatisasi proses bisnis Anda dengan ERP, CRM, atau sistem kasir (POS) yang dirancang khusus.', 'sort_order' => 4],
            ]);
        }

        // --- Products ---
        if (\App\Models\Product::count() === 0) {
            $dummyContent = <<<HTML
    <h2 class="text-3xl font-bold mb-4 text-gray-900">
        Website Sistem Informasi Perpustakaan Sekolah
    </h2>

    <p class="mb-6">
        Website Sistem Informasi Perpustakaan Sekolah merupakan platform digital yang
        dirancang untuk memudahkan pengelolaan koleksi buku, proses peminjaman,
        pengembalian, serta pencarian referensi oleh siswa dan guru dalam satu sistem
        yang terintegrasi. Aplikasi ini menghadirkan katalog buku online, pengajuan
        peminjaman, dashboard administrasi, serta laporan perpustakaan secara real-time
        sehingga aktivitas perpustakaan menjadi lebih cepat, tertata, dan efisien.
    </p>

    <h3 class="text-2xl font-semibold mt-10 mb-3 text-orange-500">
        Alur Sistem
    </h3>

    <ol class="list-decimal pl-6 space-y-2 mb-6">
        <li>Siswa atau guru mengakses website perpustakaan melalui desktop maupun smartphone.</li>
        <li>Pengguna mencari buku berdasarkan judul, penulis, ISBN, atau kategori.</li>
        <li>Sistem menampilkan daftar buku lengkap dengan informasi stok dan lokasi.</li>
        <li>Pengguna membuka halaman detail buku untuk melihat deskripsi serta status ketersediaan.</li>
        <li>Siswa mengajukan peminjaman buku secara online.</li>
        <li>Admin perpustakaan menerima pengajuan peminjaman.</li>
        <li>Admin melakukan verifikasi dan menyetujui atau menolak pengajuan.</li>
        <li>Buku dipinjam dan sistem mencatat tanggal pinjam serta tanggal jatuh tempo.</li>
        <li>Pengguna mengembalikan buku sesuai jadwal yang ditentukan.</li>
        <li>Admin melakukan proses pengembalian dan stok buku otomatis diperbarui.</li>
    </ol>

    <h3 class="text-2xl font-semibold mt-10 mb-3 text-orange-500">
        Fitur Utama
    </h3>

    <ul class="list-disc pl-6 space-y-2 mb-6">
        <li>Katalog buku digital lengkap dengan cover dan informasi detail.</li>
        <li>Pencarian buku berdasarkan judul, penulis, ISBN, atau kata kunci.</li>
        <li>Filter buku berdasarkan kategori.</li>
        <li>Halaman detail buku dengan sinopsis, penerbit, tahun terbit, dan lokasi rak.</li>
        <li>Informasi stok buku secara real-time.</li>
        <li>Pengajuan peminjaman buku secara online.</li>
        <li>Persetujuan peminjaman oleh admin perpustakaan.</li>
        <li>Manajemen data buku dan kategori.</li>
        <li>Manajemen data anggota perpustakaan.</li>
        <li>Pencatatan peminjaman dan pengembalian buku.</li>
        <li>Monitoring buku yang sedang dipinjam.</li>
        <li>Riwayat transaksi peminjaman setiap anggota.</li>
        <li>Dashboard statistik koleksi, anggota, dan aktivitas perpustakaan.</li>
        <li>Laporan peminjaman, pengembalian, serta buku terpopuler.</li>
        <li>Manajemen akun administrator dan petugas perpustakaan.</li>
        <li>Desain modern, responsif, dan mudah digunakan pada berbagai perangkat.</li>
    </ul>

    <h3 class="text-2xl font-semibold mt-10 mb-3 text-orange-500">
        Manfaat Implementasi
    </h3>

    <ul class="list-disc pl-6 space-y-2 mb-6">
        <li>Mempermudah siswa menemukan buku yang dibutuhkan.</li>
        <li>Mengurangi antrean peminjaman secara manual.</li>
        <li>Meningkatkan efisiensi pengelolaan koleksi perpustakaan.</li>
        <li>Mempermudah petugas dalam memantau stok buku.</li>
        <li>Mengurangi risiko kehilangan data transaksi.</li>
        <li>Menyediakan laporan perpustakaan secara otomatis.</li>
        <li>Meningkatkan kualitas pelayanan perpustakaan sekolah.</li>
        <li>Mendukung transformasi digital lingkungan pendidikan.</li>
    </ul>
HTML;

            \App\Models\Product::insert([
                ['title' => 'WebPOS Pro', 'slug' => 'webpos-pro', 'category_label' => 'Sistem Kasir', 'description' => 'Aplikasi kasir berbasis cloud dengan manajemen stok dan laporan lengkap.', 'content' => '<p>Konten detail WebPOS Pro.</p>', 'price' => 1500000, 'sort_order' => 1, 'image' => null],
                ['title' => 'EduSchool', 'slug' => 'eduschool', 'category_label' => 'Sistem Sekolah', 'description' => 'Manajemen akademik, absensi online, dan e-learning terpadu.', 'content' => '<p>Konten detail EduSchool.</p>', 'price' => 3500000, 'sort_order' => 2, 'image' => null],
                ['title' => 'Website Sistem Informasi Perpustakaan Sekolah', 'slug' => 'website-sistem-informasi-perpustakaan-sekolah', 'category_label' => 'Website Application', 'description' => 'Sistem informasi manajemen perpustakaan modern dengan fitur peminjaman online.', 'content' => $dummyContent, 'price' => 5000000, 'sort_order' => 3, 'image' => null],
            ]);
        }

        // --- Features (Why Us) ---
        if (\App\Models\Feature::count() === 0) {
            \App\Models\Feature::insert([
                ['icon' => 'speed', 'title' => 'Performa Tinggi', 'description' => 'Website memuat dalam hitungan detik. Kami pastikan skor Core Web Vitals Anda optimal.', 'sort_order' => 1],
                ['icon' => 'security', 'title' => 'Keamanan Maksimal', 'description' => 'Proteksi anti-DDoS, SSL standar industri, dan backup rutin untuk menjaga data bisnis Anda.', 'sort_order' => 2],
                ['icon' => 'trending_up', 'title' => 'SEO & Konversi', 'description' => 'Tidak cuma online, tapi mudah ditemukan di Google dan dirancang untuk mengubah pengunjung menjadi pembeli.', 'sort_order' => 3],
            ]);
        }

        // --- Processes ---
        if (\App\Models\Process::count() === 0) {
            \App\Models\Process::insert([
                ['step_number' => 1, 'title' => 'Konsultasi & Riset', 'description' => 'Kami mendengarkan masalah Anda, menganalisis kompetitor, dan merumuskan solusi.', 'sort_order' => 1],
                ['step_number' => 2, 'title' => 'Desain & Prototyping', 'description' => 'Membuat rancangan visual (UI/UX) agar Anda punya bayangan jelas sebelum coding dimulai.', 'sort_order' => 2],
                ['step_number' => 3, 'title' => 'Development', 'description' => 'Proses koding yang bersih dan terstruktur. Anda bisa memantau progresnya secara berkala.', 'sort_order' => 3],
                ['step_number' => 4, 'title' => 'Testing & Launch', 'description' => 'Uji coba ketat untuk memastikan tidak ada bug, lalu sistem siap di-launching ke publik.', 'sort_order' => 4],
            ]);
        }

        // --- Testimonials ---
        if (\App\Models\Testimonial::count() === 0) {
            \App\Models\Testimonial::insert([
                ['name' => 'Budi Santoso', 'position' => 'Owner Kedai Kopi', 'quote' => 'Sejak pakai WebPOS dari tim ini, manajemen stok jadi gampang banget. Nggak pusing lagi ngitung manual.', 'rating' => 5, 'sort_order' => 1, 'avatar' => null],
                ['name' => 'Siti Aminah', 'position' => 'Direktur CV Maju Jaya', 'quote' => 'Website company profile yang dibuat sangat profesional. Traffic dari Google naik 200% dalam 2 bulan.', 'rating' => 5, 'sort_order' => 2, 'avatar' => null],
                ['name' => 'Andi Pratama', 'position' => 'Kepala Sekolah', 'quote' => 'Sistem EduSchool bantu banget waktu ujian online kemarin. Servernya stabil walau diakses ratusan siswa.', 'rating' => 4, 'sort_order' => 3, 'avatar' => null],
            ]);
        }
    }
}
