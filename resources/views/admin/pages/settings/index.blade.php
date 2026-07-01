@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full" x-data="{ tab: 'general' }">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Konfigurasi Sistem</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola identitas website, informasi kontak, dan integrasi API.</p>
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
                <button @click="tab = 'general'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'general', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'general' }" class="flex items-center gap-md px-lg py-md text-left transition-colors">
                    <span class="material-symbols-outlined text-[24px]">storefront</span>
                    Identitas Website
                </button>
                
                <button @click="tab = 'contact'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'contact', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'contact' }" class="flex items-center gap-md px-lg py-md text-left transition-colors border-t border-outline-variant">
                    <span class="material-symbols-outlined text-[24px]">contact_phone</span>
                    Kontak & Sosial
                </button>
                
                <button @click="tab = 'integration'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'integration', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'integration' }" class="flex items-center gap-md px-lg py-md text-left transition-colors border-t border-outline-variant">
                    <span class="material-symbols-outlined text-[24px]">extension</span>
                    Integrasi API
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-surface border border-outline-variant rounded-2xl shadow-sm overflow-hidden">
                @csrf
                
                <!-- General Tab -->
                <div x-show="tab === 'general'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">storefront</span>
                            Identitas Utama
                        </h3>
                        <p class="text-body-md text-on-surface-variant mt-1">Nama yang akan tampil di browser dan deskripsi utama website.</p>
                    </div>

                    <div>
                        <label for="site_title" class="block text-label-md font-bold text-on-surface mb-xs">Nama Website</label>
                        <input type="text" name="site_title" id="site_title" value="{{ $settings['site_title'] ?? 'Ozan Project' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm" placeholder="Contoh: Ozan Project Digital">
                    </div>

                    <div>
                        <label for="site_description" class="block text-label-md font-bold text-on-surface mb-xs">Deskripsi Website (SEO)</label>
                        <textarea name="site_description" id="site_description" rows="3" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm" placeholder="Tuliskan deskripsi singkat tentang website untuk pencarian Google...">{{ $settings['site_description'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label for="site_logo" class="block text-label-md font-bold text-on-surface mb-xs">Logo Utama</label>
                        <div class="flex items-end gap-md">
                            @if(isset($settings['site_logo']) && !empty($settings['site_logo']))
                                <div class="w-24 h-24 rounded-lg border border-outline-variant p-2 flex items-center justify-center bg-surface-container-lowest shrink-0">
                                    <img src="{{ $settings['site_logo'] }}" alt="Logo" class="max-w-full max-h-full object-contain">
                                </div>
                            @endif
                            <div class="flex-1">
                                <input type="file" name="site_logo" id="site_logo" class="w-full text-body-md text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-md file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors cursor-pointer border border-outline-variant rounded-xl p-2 bg-surface">
                                <p class="text-body-sm text-on-surface-variant mt-2">Format: JPG, PNG, SVG. Maks 2MB.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Contact Tab -->
                <div x-show="tab === 'contact'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">contact_phone</span>
                            Kontak Resmi
                        </h3>
                        <p class="text-body-md text-on-surface-variant mt-1">Informasi yang akan ditampilkan di bagian footer website.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        <div>
                            <label for="contact_phone" class="block text-label-md font-bold text-on-surface mb-xs">Nomor WhatsApp</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">call</span>
                                <input type="text" name="contact_phone" id="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary shadow-sm" placeholder="Contoh: 08123456789">
                            </div>
                        </div>

                        <div>
                            <label for="contact_email" class="block text-label-md font-bold text-on-surface mb-xs">Email Resmi</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">mail</span>
                                <input type="email" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary shadow-sm" placeholder="cs@ozanproject.com">
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label for="contact_title" class="block text-label-md font-bold text-on-surface mb-xs">Judul Halaman Kontak</label>
                            <input type="text" name="contact_title" id="contact_title" value="{{ $settings['contact_title'] ?? 'Ayo Bicara!' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm" placeholder="Contoh: Ayo Bicara!">
                        </div>

                        <div class="md:col-span-2">
                            <label for="contact_subtitle" class="block text-label-md font-bold text-on-surface mb-xs">Subjudul Halaman Kontak</label>
                            <input type="text" name="contact_subtitle" id="contact_subtitle" value="{{ $settings['contact_subtitle'] ?? 'Ceritakan kebutuhan digital Anda dan tim kami akan merespons dalam 1x24 jam kerja.' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm" placeholder="Contoh: Ceritakan kebutuhan digital Anda...">
                        </div>

                        <div class="md:col-span-2">
                            <label for="contact_address" class="block text-label-md font-bold text-on-surface mb-xs">Alamat Kantor</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-4 text-on-surface-variant text-[20px]">location_on</span>
                                <textarea name="contact_address" id="contact_address" rows="2" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary shadow-sm" placeholder="Jl. Raya No. 123, Jakarta">{{ $settings['contact_address'] ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label for="contact_working_hours" class="block text-label-md font-bold text-on-surface mb-xs">Jam Kerja</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">schedule</span>
                                <input type="text" name="contact_working_hours" id="contact_working_hours" value="{{ $settings['contact_working_hours'] ?? 'Senin - Jumat: 09.00 - 17.00 WIB' }}" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary shadow-sm" placeholder="Contoh: Senin - Jumat: 09.00 - 17.00 WIB">
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-outline-variant pb-md mb-sm mt-md">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">public</span>
                            Sosial Media
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        <div>
                            <label for="social_instagram" class="block text-label-md font-bold text-on-surface mb-xs">Link Instagram</label>
                            <input type="url" name="social_instagram" id="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm" placeholder="https://instagram.com/ozanproject">
                        </div>
                        <div>
                            <label for="social_facebook" class="block text-label-md font-bold text-on-surface mb-xs">Link Facebook</label>
                            <input type="url" name="social_facebook" id="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm" placeholder="https://facebook.com/ozanproject">
                        </div>
                        <div class="md:col-span-2">
                            <label for="social_linkedin" class="block text-label-md font-bold text-on-surface mb-xs">Link LinkedIn</label>
                            <input type="url" name="social_linkedin" id="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}" class="w-full border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary px-lg py-3 shadow-sm" placeholder="https://linkedin.com/company/ozanproject">
                        </div>
                    </div>

                </div>

                <!-- Integration Tab -->
                <div x-show="tab === 'integration'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">extension</span>
                            Integrasi Eksternal
                        </h3>
                        <p class="text-body-md text-on-surface-variant mt-1">Sambungkan website dengan layanan pihak ketiga melalui API Key.</p>
                    </div>

                    <div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant/50">
                        <label for="tinymce_api_key" class="block text-label-lg font-bold text-on-surface mb-xs flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">draw</span>
                            TinyMCE API Key (Rich Text Editor)
                        </label>
                        <p class="text-body-sm text-on-surface-variant mb-md">Dibutuhkan agar editor teks di halaman Produk & Layanan berjalan tanpa peringatan limitasi domain. Daftar di <a href="https://www.tiny.cloud/" target="_blank" class="text-primary hover:underline font-bold">tiny.cloud</a>.</p>
                        
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">key</span>
                            <input type="text" name="tinymce_api_key" id="tinymce_api_key" value="{{ $settings['tinymce_api_key'] ?? '' }}" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary shadow-sm" placeholder="Paste API Key TinyMCE Anda di sini...">
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant/50 mt-sm">
                        <label for="google_analytics_id" class="block text-label-lg font-bold text-on-surface mb-xs flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#EA4335] text-[20px]">bar_chart</span>
                            Google Analytics (G-TAG)
                        </label>
                        <p class="text-body-sm text-on-surface-variant mb-md">Masukkan ID Pelacakan (Tracking ID) Google Analytics Anda untuk memantau pengunjung. Format biasanya dimulai dengan `G-`.</p>
                        
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">monitoring</span>
                            <input type="text" name="google_analytics_id" id="google_analytics_id" value="{{ $settings['google_analytics_id'] ?? '' }}" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary shadow-sm" placeholder="Contoh: G-XXXXXXXXXX">
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
