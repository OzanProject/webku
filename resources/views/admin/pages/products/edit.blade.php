@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <div class="flex items-center gap-sm mb-xs text-on-surface-variant">
                <a href="{{ route('admin.products.index') }}" class="hover:text-primary transition-colors">Manajemen Produk</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-on-surface">Edit Produk</span>
            </div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Edit: {{ $product->title }}</h2>
        </div>
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-sm bg-surface-container-high text-on-surface px-md py-sm rounded-lg hover:bg-surface-container-highest transition-colors font-label-md border border-outline-variant">
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
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-md md:p-lg">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-xl">
                <!-- Left Column (Main Info) -->
                <div class="lg:col-span-2 space-y-lg">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-label-md font-label-md text-on-surface mb-xs">Judul Produk <span class="text-error">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $product->title) }}" required class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-label-md font-label-md text-on-surface mb-xs">Kategori Produk <span class="text-error">*</span></label>
                            <select id="category_id" name="category_id" required class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Version -->
                        <div>
                            <label for="version" class="block text-label-md font-label-md text-on-surface mb-xs">Versi (Opsional)</label>
                            <input type="text" id="version" name="version" value="{{ old('version', $product->version ?? '1.0.0') }}" placeholder="Contoh: 1.0.0" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                        </div>
                        
                        <!-- Release Date -->
                        <div>
                            <label for="release_date" class="block text-label-md font-label-md text-on-surface mb-xs">Tanggal Rilis (Opsional)</label>
                            <input type="date" id="release_date" name="release_date" value="{{ old('release_date', $product->release_date ? $product->release_date->format('Y-m-d') : date('Y-m-d')) }}" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                        </div>
                        
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-label-md font-label-md text-on-surface mb-xs">Harga (Opsional)</label>
                            <div class="relative">
                                <span class="absolute left-md top-1/2 -translate-y-1/2 text-on-surface-variant text-body-md">Rp</span>
                                <input type="number" id="price" name="price" value="{{ old('price', (int)$product->price) }}" min="0" class="w-full pl-xl pr-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                            </div>
                        </div>

                        <!-- Demo Link -->
                        <div class="md:col-span-2">
                            <label for="demo_link" class="block text-label-md font-label-md text-on-surface mb-xs">Link Live Demo (Opsional)</label>
                            <input type="url" id="demo_link" name="demo_link" value="{{ old('demo_link', $product->demo_link) }}" placeholder="https://..." class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                        </div>
                    </div>

                    <!-- Description (Short) -->
                    <div>
                        <label for="description" class="block text-label-md font-label-md text-on-surface mb-xs">Deskripsi Singkat <span class="text-error">*</span></label>
                        <textarea id="description" name="description" required rows="3" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors resize-y">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Content (Long) -->
                    <div>
                        <label for="content" class="block text-label-md font-label-md text-on-surface mb-xs">Konten Lengkap</label>
                        <textarea id="content" name="content" rows="10" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors resize-y">{{ old('content', $product->content) }}</textarea>
                    </div>

                    <!-- Features (Repeater) -->
                    <div class="bg-surface-container-low p-md rounded-lg border border-outline-variant/50">
                        <div class="flex justify-between items-center mb-md">
                            <h3 class="font-bold text-on-surface">Spesifikasi & Fitur</h3>
                            <button type="button" onclick="addFeatureRow()" class="px-sm py-1 bg-primary/10 text-primary rounded text-sm hover:bg-primary/20 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">add</span> Tambah
                            </button>
                        </div>
                        <div id="features-container" class="space-y-sm">
                            <!-- Template row for JS -->
                        </div>
                    </div>
                </div>

                <!-- Right Column (Meta & Media) -->
                <div class="space-y-lg">
                    <!-- Status -->
                    <div class="bg-surface-container-low p-md rounded-lg border border-outline-variant/50">
                        <h3 class="font-bold text-on-surface mb-md">Status & Visibilitas</h3>
                        
                        <label class="flex items-center gap-sm cursor-pointer mb-md">
                            <div class="relative">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-surface-container-highest rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </div>
                            <span class="text-body-md text-on-surface">Aktifkan Produk</span>
                        </label>
                        
                        <div>
                            <label for="sort_order" class="block text-label-md font-label-md text-on-surface mb-xs">Urutan Tampil (Sort Order)</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order) }}" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                            <p class="text-xs text-on-surface-variant mt-1">Angka lebih kecil akan tampil lebih dulu.</p>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="bg-surface-container-low p-md rounded-lg border border-outline-variant/50">
                        <h3 class="font-bold text-on-surface mb-md">Gambar Utama</h3>
                        
                        <div class="w-full relative">
                            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                            
                            @if($product->image)
                            <div id="image-preview-container" class="w-full h-48 bg-surface border-2 border-primary border-solid rounded-lg flex flex-col items-center justify-center text-on-surface-variant overflow-hidden relative group">
                                <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" alt="Preview" class="absolute inset-0 w-full h-full object-cover z-0">
                                <div class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center text-white z-10 font-label-md pointer-events-none">
                                    <span class="material-symbols-outlined mr-2">edit</span> Ganti Gambar
                                </div>
                            </div>
                            @else
                            <div id="image-preview-container" class="w-full h-48 bg-surface border-2 border-dashed border-outline-variant rounded-lg flex flex-col items-center justify-center text-on-surface-variant overflow-hidden relative group">
                                <span class="material-symbols-outlined text-[48px] mb-2 opacity-100 transition-opacity">add_photo_alternate</span>
                                <span class="text-label-sm opacity-100 transition-opacity">Klik atau drop gambar ke sini</span>
                                <span class="text-xs opacity-70 mt-1 transition-opacity">JPG, PNG, WEBP (Max 2MB)</span>
                                
                                <img id="image-preview" src="#" alt="Preview" class="absolute inset-0 w-full h-full object-cover hidden z-0">
                            </div>
                            @endif
                        </div>
                        @if($product->image)
                        <p class="text-xs text-on-surface-variant mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-xl pt-lg border-t border-outline-variant flex justify-end gap-md">
                <a href="{{ route('admin.products.index') }}" class="px-lg py-sm rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors">Batal</a>
                <button type="submit" class="px-lg py-sm rounded-lg font-label-md bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/{{ \App\Models\Setting::get('tinymce_api_key', 'no-api-key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 500,
            skin: 'oxide',
            content_css: 'default',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    });

    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const container = document.getElementById('image-preview-container');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                
                // If it was dashed (new), make it solid primary
                if (container.classList.contains('border-dashed')) {
                    container.classList.remove('border-dashed', 'border-outline-variant');
                    container.classList.add('border-primary', 'border-solid');
                }
                
                // Hide text elements in container
                Array.from(container.children).forEach(child => {
                    if (child.tagName !== 'IMG' && !child.classList.contains('absolute')) {
                        child.style.opacity = '0';
                    }
                });
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    let featureIndex = 0;
    function addFeatureRow(icon = 'monitor', name = '', value = '') {
        const container = document.getElementById('features-container');
        const row = document.createElement('div');
        row.className = 'flex gap-2 items-start';
        row.innerHTML = `
            <div class="w-1/4">
                <input type="text" name="features[${featureIndex}][icon]" value="${icon}" placeholder="Icon (Google Material)" class="w-full px-sm py-sm rounded border border-outline-variant text-sm">
            </div>
            <div class="w-1/3">
                <input type="text" name="features[${featureIndex}][name]" value="${name}" placeholder="Nama Fitur" class="w-full px-sm py-sm rounded border border-outline-variant text-sm">
            </div>
            <div class="flex-1">
                <input type="text" name="features[${featureIndex}][value]" value="${value}" placeholder="Nilai (Contoh: Tersedia)" class="w-full px-sm py-sm rounded border border-outline-variant text-sm">
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="p-sm text-error hover:bg-error/10 rounded">
                <span class="material-symbols-outlined text-[18px]">delete</span>
            </button>
        `;
        container.appendChild(row);
        featureIndex++;
    }

    // Load existing features
    const existingFeatures = @json(old('features', $product->features ?? []));
    if (existingFeatures && Object.keys(existingFeatures).length > 0) {
        // Convert from object or array
        const featuresArray = Array.isArray(existingFeatures) ? existingFeatures : Object.values(existingFeatures);
        featuresArray.forEach(f => addFeatureRow(f.icon || 'monitor', f.name || '', f.value || ''));
    } else {
        // If empty, add defaults
        addFeatureRow('monitor', 'Tampilan', 'Fully Responsive');
        addFeatureRow('description', 'Dokumentasi', 'Tersedia');
        addFeatureRow('download', 'Source Code', 'Termasuk');
    }
</script>
@endsection
