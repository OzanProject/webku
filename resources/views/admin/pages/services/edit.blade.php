@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <div class="flex items-center gap-sm mb-xs text-on-surface-variant">
                <a href="{{ route('admin.services.index') }}" class="hover:text-primary transition-colors">Manajemen Layanan</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-on-surface">Edit Layanan</span>
            </div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Edit: {{ $service->title }}</h2>
        </div>
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-sm bg-surface-container-high text-on-surface px-md py-sm rounded-lg hover:bg-surface-container-highest transition-colors font-label-md border border-outline-variant">
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
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden max-w-4xl">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="p-md md:p-lg">
            @csrf
            @method('PUT')
            
            <div class="space-y-lg">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-label-md font-label-md text-on-surface mb-xs">Nama Layanan <span class="text-error">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                    <!-- Icon String -->
                    <div>
                        <label for="icon" class="block text-label-md font-label-md text-on-surface mb-xs flex items-center justify-between">
                            <span>Ikon (Material Symbols) <span class="text-error">*</span></span>
                            <a href="https://fonts.google.com/icons?icon.set=Material+Symbols" target="_blank" class="text-xs text-primary hover:underline flex items-center">
                                Cari Ikon <span class="material-symbols-outlined text-[14px] ml-1">open_in_new</span>
                            </a>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant bg-surface-container-highest p-1 rounded" id="icon-preview">{{ old('icon', $service->icon) }}</span>
                            <input type="text" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" required class="w-full pl-12 pr-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors" onkeyup="document.getElementById('icon-preview').innerText = this.value || 'code'">
                        </div>
                        <p class="text-xs text-on-surface-variant mt-1">Ketikkan nama ikon Google Material Symbols.</p>
                    </div>
                    
                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-label-md font-label-md text-on-surface mb-xs">Urutan Tampil (Sort Order)</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                        <p class="text-xs text-on-surface-variant mt-1">Angka lebih kecil akan tampil lebih dulu.</p>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-label-md font-label-md text-on-surface mb-xs">Deskripsi Layanan <span class="text-error">*</span></label>
                    <textarea id="description" name="description" required rows="4" class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors resize-y">{{ old('description', $service->description) }}</textarea>
                </div>
                
                <!-- Status -->
                <div class="bg-surface-container-low p-md rounded-lg border border-outline-variant/50">
                    <label class="flex items-center gap-sm cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-surface-container-highest rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </div>
                        <div>
                            <span class="text-body-md text-on-surface font-bold block">Aktifkan Layanan</span>
                            <span class="text-xs text-on-surface-variant">Layanan yang aktif akan ditampilkan di halaman depan website.</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-xl pt-lg border-t border-outline-variant flex justify-end gap-md">
                <a href="{{ route('admin.services.index') }}" class="px-lg py-sm rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors">Batal</a>
                <button type="submit" class="px-lg py-sm rounded-lg font-label-md bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
