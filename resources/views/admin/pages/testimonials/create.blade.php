@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <div class="flex items-center gap-sm mb-xs text-on-surface-variant">
                <a href="{{ route('admin.testimonials.index') }}" class="hover:text-primary transition-colors">Manajemen Testimoni</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-on-surface">Tambah Baru</span>
            </div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Tambah Testimoni</h2>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center gap-sm bg-surface-container-high text-on-surface px-md py-sm rounded-lg hover:bg-surface-container-highest transition-colors font-label-md border border-outline-variant">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-lg p-md bg-error/10 border border-error/20 rounded-lg text-error">
        <div class="flex items-center gap-sm mb-xs">
            <span class="material-symbols-outlined">error</span>
            <h4 class="font-bold">Terdapat Kesalahan</h4>
        </div>
        <ul class="list-disc list-inside text-sm ml-md">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form Section -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="p-md md:p-lg">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-xl">
                <!-- Left Column (Main Info) -->
                <div class="lg:col-span-2 space-y-lg">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-label-md font-label-md text-on-surface mb-xs">Nama Klien <span class="text-error">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                        </div>
                        
                        <!-- Position/Company -->
                        <div>
                            <label for="position" class="block text-label-md font-label-md text-on-surface mb-xs">Posisi / Perusahaan</label>
                            <input type="text" id="position" name="position" value="{{ old('position') }}" placeholder="Contoh: CEO PT Sukses Makmur" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                        </div>
                    </div>

                    <!-- Quote -->
                    <div>
                        <label for="quote" class="block text-label-md font-label-md text-on-surface mb-xs">Kutipan Testimoni <span class="text-error">*</span></label>
                        <textarea id="quote" name="quote" required rows="5" placeholder="Tuliskan testimoni yang diberikan oleh klien..." class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors resize-y">{{ old('quote') }}</textarea>
                    </div>

                    <!-- Rating -->
                    <div>
                        <label class="block text-label-md font-label-md text-on-surface mb-sm">Rating <span class="text-error">*</span></label>
                        <div class="flex items-center gap-md">
                            @for($i = 5; $i >= 1; $i--)
                            <label class="cursor-pointer group flex flex-col-reverse items-center">
                                <input type="radio" name="rating" value="{{ $i }}" class="peer sr-only" {{ old('rating', '5') == $i ? 'checked' : '' }} required>
                                <span class="material-symbols-outlined text-[32px] text-outline-variant peer-checked:text-[#f59e0b] group-hover:text-[#f59e0b]/70 transition-colors" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-xs font-bold text-on-surface-variant peer-checked:text-primary mb-1">{{ $i }}</span>
                            </label>
                            @endfor
                        </div>
                        <p class="text-xs text-on-surface-variant mt-2">Pilih rating dari 1 hingga 5 bintang.</p>
                    </div>
                </div>

                <!-- Right Column (Meta & Media) -->
                <div class="space-y-lg">
                    <!-- Status -->
                    <div class="bg-surface-container-low p-md rounded-lg border border-outline-variant/50">
                        <h3 class="font-bold text-on-surface mb-md">Status & Visibilitas</h3>
                        
                        <label class="flex items-center gap-sm cursor-pointer mb-md">
                            <div class="relative">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-surface-container-highest rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </div>
                            <span class="text-body-md text-on-surface">Tampilkan Testimoni</span>
                        </label>
                        
                        <div>
                            <label for="sort_order" class="block text-label-md font-label-md text-on-surface mb-xs">Urutan Tampil (Sort Order)</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                            <p class="text-xs text-on-surface-variant mt-1">Angka lebih kecil akan tampil lebih dulu.</p>
                        </div>
                    </div>

                    <!-- Avatar Upload -->
                    <div class="bg-surface-container-low p-md rounded-lg border border-outline-variant/50">
                        <h3 class="font-bold text-on-surface mb-md">Foto Profil (Opsional)</h3>
                        
                        <div class="w-full relative flex justify-center">
                            <div class="w-32 h-32 relative">
                                <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 rounded-full" onchange="previewImage(this)">
                                <div id="image-preview-container" class="w-full h-full bg-surface border-2 border-dashed border-outline-variant rounded-full flex flex-col items-center justify-center text-on-surface-variant overflow-hidden relative transition-colors">
                                    <span class="material-symbols-outlined text-[32px] mb-1">face</span>
                                    <span class="text-[10px] uppercase font-bold tracking-wider">Upload</span>
                                    
                                    <img id="image-preview" src="#" alt="Preview" class="absolute inset-0 w-full h-full object-cover hidden z-0">
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-center text-on-surface-variant mt-3">Format: JPG, PNG, WEBP (Max 2MB).<br>Rasio 1:1 direkomendasikan.</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-xl pt-lg border-t border-outline-variant flex justify-end gap-md">
                <button type="reset" class="px-lg py-sm rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors">Reset</button>
                <button type="submit" class="px-lg py-sm rounded-lg font-label-md bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Testimoni
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const container = document.getElementById('image-preview-container');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                container.classList.remove('border-dashed');
                container.classList.add('border-primary', 'border-solid');
                
                // Hide text elements
                Array.from(container.children).forEach(child => {
                    if(child !== preview) child.style.opacity = '0';
                });
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
