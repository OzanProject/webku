@extends('admin.layouts.app')

@push('styles')
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/{{ \App\Models\Setting::get('tinymce_api_key', 'no-api-key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full" x-data="{ tab: 'hero' }">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Halaman About Us</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola seluruh teks dan konten di halaman Tentang Kami.</p>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-lg p-md bg-[#10b981]/10 border border-[#10b981]/20 rounded-lg flex items-start gap-sm text-[#047857] animate-fade-in-up">
        <span class="material-symbols-outlined text-[20px]">check_circle</span>
        <p class="text-body-md font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-lg">
        
        <!-- Sidebar Tabs -->
        <div class="lg:col-span-1">
            <div class="bg-surface border border-outline-variant rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <button @click="tab = 'hero'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'hero', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'hero' }" class="flex items-center gap-md px-lg py-md text-left transition-colors">
                    <span class="material-symbols-outlined text-[24px]">view_day</span>
                    Hero (Atas)
                </button>
                
                <button @click="tab = 'story'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'story', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'story' }" class="flex items-center gap-md px-lg py-md text-left transition-colors border-t border-outline-variant">
                    <span class="material-symbols-outlined text-[24px]">history_edu</span>
                    Cerita Kami
                </button>

                <button @click="tab = 'stats'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'stats', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'stats' }" class="flex items-center gap-md px-lg py-md text-left transition-colors border-t border-outline-variant">
                    <span class="material-symbols-outlined text-[24px]">query_stats</span>
                    Statistik
                </button>

                <button @click="tab = 'cta'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'cta', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'cta' }" class="flex items-center gap-md px-lg py-md text-left transition-colors border-t border-outline-variant">
                    <span class="material-symbols-outlined text-[24px]">call_to_action</span>
                    Call to Action
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <form action="{{ route('admin.about.update') }}" method="POST" class="bg-surface border border-outline-variant rounded-2xl shadow-sm overflow-hidden">
                @csrf
                
                <!-- Hero Tab -->
                <div x-show="tab === 'hero'" class="p-lg md:p-xl flex flex-col gap-lg">
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">view_day</span>
                            Hero Section
                        </h3>
                    </div>

                    <div>
                        <label class="block text-label-md font-bold text-on-surface mb-xs">Judul Utama</label>
                        <textarea name="about_hero_title" rows="2" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary px-lg py-3 shadow-sm" placeholder="Contoh: Kami Membangun Digital, Anda Membangun Bisnis">{{ $settings['about_hero_title'] ?? 'Kami Membangun Digital, <br class="hidden md:block"/>Anda Membangun Bisnis' }}</textarea>
                        <p class="text-xs text-on-surface-variant mt-1">Boleh menggunakan tag &lt;br&gt; untuk baris baru.</p>
                    </div>

                    <div>
                        <label class="block text-label-md font-bold text-on-surface mb-xs">Subjudul (Deskripsi)</label>
                        <textarea name="about_hero_subtitle" rows="3" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary px-lg py-3 shadow-sm" placeholder="Contoh: Ozan Project adalah agency digital...">{{ $settings['about_hero_subtitle'] ?? 'Ozan Project adalah agency digital profesional yang berdedikasi membantu UMKM dan perusahaan Indonesia tumbuh melalui solusi teknologi modern, terukur, dan elegan.' }}</textarea>
                    </div>
                </div>

                <!-- Story Tab -->
                <div x-show="tab === 'story'" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">history_edu</span>
                            Cerita Kami
                        </h3>
                    </div>

                    <div>
                        <label class="block text-label-md font-bold text-on-surface mb-xs">Judul Bagian</label>
                        <input type="text" name="about_story_title" value="{{ $settings['about_story_title'] ?? 'Cerita Kami' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary px-lg py-3 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-label-md font-bold text-on-surface mb-xs">Isi Cerita</label>
                        <textarea name="about_story_content" class="tinymce-editor">{{ $settings['about_story_content'] ?? '<p>Ozan Project lahir dari keyakinan bahwa setiap bisnis — besar maupun kecil — berhak mendapatkan solusi digital berkualitas tinggi yang benar-benar bekerja untuk pertumbuhan mereka.</p><p>Kami memulai perjalanan ini dengan membantu UMKM lokal yang ingin masuk ke dunia digital namun tidak tahu harus mulai dari mana. Dari sana, kami berkembang menjadi tim ahli yang berpengalaman dalam membangun website, aplikasi mobile, dan sistem kustom yang tidak hanya tampil mewah, tapi juga menghasilkan konversi nyata.</p>' }}</textarea>
                    </div>
                </div>

                <!-- Stats Tab -->
                <div x-show="tab === 'stats'" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">query_stats</span>
                            Angka Statistik
                        </h3>
                    </div>

                    <div class="grid grid-cols-2 gap-md border border-outline-variant rounded-xl p-md bg-surface-container-lowest">
                        <div>
                            <label class="block text-label-sm font-bold text-on-surface mb-xs">Statistik 1 - Angka</label>
                            <input type="text" name="about_stat_1_value" value="{{ $settings['about_stat_1_value'] ?? '500+' }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-label-sm font-bold text-on-surface mb-xs">Statistik 1 - Label</label>
                            <input type="text" name="about_stat_1_label" value="{{ $settings['about_stat_1_label'] ?? 'Proyek Selesai' }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary px-3 py-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-md border border-outline-variant rounded-xl p-md bg-surface-container-lowest">
                        <div>
                            <label class="block text-label-sm font-bold text-on-surface mb-xs">Statistik 2 - Angka</label>
                            <input type="text" name="about_stat_2_value" value="{{ $settings['about_stat_2_value'] ?? '120+' }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-label-sm font-bold text-on-surface mb-xs">Statistik 2 - Label</label>
                            <input type="text" name="about_stat_2_label" value="{{ $settings['about_stat_2_label'] ?? 'Produk Digital' }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary px-3 py-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-md border border-outline-variant rounded-xl p-md bg-surface-container-lowest">
                        <div>
                            <label class="block text-label-sm font-bold text-on-surface mb-xs">Statistik 3 - Angka</label>
                            <input type="text" name="about_stat_3_value" value="{{ $settings['about_stat_3_value'] ?? '98%' }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-label-sm font-bold text-on-surface mb-xs">Statistik 3 - Label</label>
                            <input type="text" name="about_stat_3_label" value="{{ $settings['about_stat_3_label'] ?? 'Kepuasan Klien' }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary px-3 py-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-md border border-outline-variant rounded-xl p-md bg-surface-container-lowest">
                        <div>
                            <label class="block text-label-sm font-bold text-on-surface mb-xs">Statistik 4 - Angka</label>
                            <input type="text" name="about_stat_4_value" value="{{ $settings['about_stat_4_value'] ?? '1 Th' }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-label-sm font-bold text-on-surface mb-xs">Statistik 4 - Label</label>
                            <input type="text" name="about_stat_4_label" value="{{ $settings['about_stat_4_label'] ?? 'Garansi Sistem' }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary px-3 py-2">
                        </div>
                    </div>
                </div>

                <!-- CTA Tab -->
                <div x-show="tab === 'cta'" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">call_to_action</span>
                            Call to Action (Bawah)
                        </h3>
                    </div>

                    <div>
                        <label class="block text-label-md font-bold text-on-surface mb-xs">Judul CTA</label>
                        <input type="text" name="about_cta_title" value="{{ $settings['about_cta_title'] ?? 'Siap Mengubah Visi Menjadi Aksi?' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary px-lg py-3 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-label-md font-bold text-on-surface mb-xs">Subjudul (Deskripsi)</label>
                        <textarea name="about_cta_subtitle" rows="3" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary px-lg py-3 shadow-sm">{{ $settings['about_cta_subtitle'] ?? 'Jangan biarkan bisnis Anda tertinggal. Mari berdiskusi tentang bagaimana kami bisa membantu Anda mendominasi pasar digital.' }}</textarea>
                    </div>
                </div>

                <!-- Submit Button Area -->
                <div class="p-lg md:p-xl bg-surface-bright border-t border-outline-variant flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center gap-sm bg-primary text-on-primary px-xl py-3 rounded-xl hover:bg-primary/90 transition-all font-bold text-label-lg shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined">save</span>
                        Simpan Perubahan
                    </button>
                </div>
                
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if(typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '.tinymce-editor',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'preview',
                    'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                'bold italic | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        }
    });
</script>
@endpush
