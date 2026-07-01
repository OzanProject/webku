@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full" x-data="{ tab: 'hero' }">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Pengaturan Beranda (Landing Page)</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Ubah teks dan gambar pada halaman utama website.</p>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-lg p-md bg-secondary/10 border border-secondary/20 rounded-lg flex items-start gap-sm text-secondary animate-fade-in-up">
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
                    Hero Section
                </button>
                
                <button @click="tab = 'why_us'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'why_us', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'why_us' }" class="flex items-center gap-md px-lg py-md text-left transition-colors border-t border-outline-variant">
                    <span class="material-symbols-outlined text-[24px]">verified</span>
                    Bagian Kenapa Kami
                </button>
                
                <button @click="tab = 'cta'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'cta', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'cta' }" class="flex items-center gap-md px-lg py-md text-left transition-colors border-t border-outline-variant">
                    <span class="material-symbols-outlined text-[24px]">ads_click</span>
                    Bagian Call to Action
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <form action="{{ route('admin.home-page.update') }}" method="POST" enctype="multipart/form-data" class="bg-surface border border-outline-variant rounded-2xl shadow-sm overflow-hidden">
                @csrf
                
                <!-- Hero Tab -->
                <div x-show="tab === 'hero'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">view_day</span>
                            Hero Section
                        </h3>
                        <p class="text-body-md text-on-surface-variant mt-1">Mengatur tampilan utama (paling atas) di halaman beranda.</p>
                    </div>

                    <div>
                        <label for="hero_trust_badge" class="block text-label-md font-bold text-on-surface mb-xs">Teks Trust Badge (Atas Judul)</label>
                        <input type="text" name="hero_trust_badge" id="hero_trust_badge" value="{{ $settings['hero_trust_badge'] ?? 'Dipercaya oleh 500+ UMKM di Indonesia' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm">
                    </div>

                    <div>
                        <label for="hero_title" class="block text-label-md font-bold text-on-surface mb-xs">Judul Besar (Hero Title)</label>
                        <textarea name="hero_title" id="hero_title" rows="2" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm">{{ $settings['hero_title'] ?? 'Website yang Bukan Cuma Tampil Keren, Tapi Bantu Bisnis Anda Dapat Customer' }}</textarea>
                    </div>

                    <div>
                        <label for="hero_subtitle" class="block text-label-md font-bold text-on-surface mb-xs">Subjudul (Hero Subtitle)</label>
                        <textarea name="hero_subtitle" id="hero_subtitle" rows="2" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm">{{ $settings['hero_subtitle'] ?? 'Tingkatkan kredibilitas dan penjualan Anda dengan solusi website dan sistem digital yang dirancang khusus untuk pertumbuhan bisnis.' }}</textarea>
                    </div>

                    <div>
                        <label for="hero_image" class="block text-label-md font-bold text-on-surface mb-xs">Gambar Background Hero</label>
                        <div class="flex items-end gap-md">
                            @if(isset($settings['hero_image_url']) && !empty($settings['hero_image_url']))
                                <div class="w-32 h-24 rounded-lg border border-outline-variant p-2 flex items-center justify-center bg-surface-container-lowest shrink-0 overflow-hidden">
                                    <img src="{{ $settings['hero_image_url'] }}" alt="Hero Image" class="w-full h-full object-cover rounded">
                                </div>
                            @endif
                            <div class="flex-1">
                                <input type="file" name="hero_image" id="hero_image" class="w-full text-body-md text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-md file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors cursor-pointer border border-outline-variant rounded-xl p-2 bg-surface">
                                <p class="text-body-sm text-on-surface-variant mt-2">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Why Us Tab -->
                <div x-show="tab === 'why_us'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">verified</span>
                            Bagian "Kenapa Memilih Kami"
                        </h3>
                    </div>

                    <div>
                        <label for="why_us_title" class="block text-label-md font-bold text-on-surface mb-xs">Judul Sesi (Title)</label>
                        <input type="text" name="why_us_title" id="why_us_title" value="{{ $settings['why_us_title'] ?? 'Kenapa Memilih Ozan Project?' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm">
                    </div>

                    <div>
                        <label for="why_us_subtitle" class="block text-label-md font-bold text-on-surface mb-xs">Subjudul Sesi (Subtitle)</label>
                        <textarea name="why_us_subtitle" id="why_us_subtitle" rows="2" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm">{{ $settings['why_us_subtitle'] ?? 'Kami bukan sekadar pembuat website, kami adalah partner digital untuk bisnis Anda.' }}</textarea>
                    </div>
                </div>

                <!-- CTA Tab -->
                <div x-show="tab === 'cta'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">ads_click</span>
                            Bagian Call to Action (Bawah)
                        </h3>
                    </div>

                    <div>
                        <label for="cta_title" class="block text-label-md font-bold text-on-surface mb-xs">Judul CTA</label>
                        <input type="text" name="cta_title" id="cta_title" value="{{ $settings['cta_title'] ?? 'Siap Mengembangkan Bisnis Anda?' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm">
                    </div>

                    <div>
                        <label for="cta_subtitle" class="block text-label-md font-bold text-on-surface mb-xs">Subjudul CTA</label>
                        <textarea name="cta_subtitle" id="cta_subtitle" rows="2" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm">{{ $settings['cta_subtitle'] ?? 'Diskusikan kebutuhan Anda dengan tim ahli kami sekarang juga.' }}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        <div>
                            <label for="cta_button_text" class="block text-label-md font-bold text-on-surface mb-xs">Teks Tombol CTA</label>
                            <input type="text" name="cta_button_text" id="cta_button_text" value="{{ $settings['cta_button_text'] ?? 'Mulai Konsultasi Gratis' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm">
                        </div>
                        <div>
                            <label for="cta_button_link" class="block text-label-md font-bold text-on-surface mb-xs">Link Tombol CTA</label>
                            <input type="text" name="cta_button_link" id="cta_button_link" value="{{ $settings['cta_button_link'] ?? route('contact') }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm" placeholder="Contoh: https://wa.me/...">
                        </div>
                    </div>
                </div>

                <!-- Submit Button Area (Always Visible) -->
                <div class="p-lg md:p-xl bg-surface-bright border-t border-outline-variant flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center gap-sm bg-primary text-on-primary px-xl py-3 rounded-xl hover:bg-primary/90 transition-all font-bold text-label-lg shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined">save</span>
                        Simpan Semua Pengaturan
                    </button>
                </div>
                
            </form>
        </div>

    </div>
</div>
@endsection
