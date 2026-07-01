@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    <div class="flex items-center gap-sm mb-lg">
        <a href="{{ route('admin.portfolios.index') }}" class="text-on-surface-variant hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Edit Portofolio</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden max-w-3xl">
        <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" class="p-lg">
            @csrf
            @method('PUT')
            
            <div class="mb-md">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Judul Proyek <span class="text-error">*</span></label>
                <input type="text" name="title" value="{{ old('title', $portfolio->title) }}" required class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                @error('title')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-md">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Kategori <span class="text-error">*</span></label>
                <select name="category" required class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                    <option value="">Pilih Kategori</option>
                    <option value="Landing Page" {{ old('category', $portfolio->category) == 'Landing Page' ? 'selected' : '' }}>Landing Page</option>
                    <option value="Mobile App" {{ old('category', $portfolio->category) == 'Mobile App' ? 'selected' : '' }}>Mobile App</option>
                    <option value="UI/UX Design" {{ old('category', $portfolio->category) == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                    <option value="Website" {{ old('category', $portfolio->category) == 'Website' ? 'selected' : '' }}>Website</option>
                </select>
                @error('category')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-md">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Deskripsi Singkat</label>
                <textarea name="description" rows="3" class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">{{ old('description', $portfolio->description) }}</textarea>
                @error('description')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-md">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Link/URL (Opsional)</label>
                <input type="url" name="link" value="{{ old('link', $portfolio->link) }}" placeholder="https://..." class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                @error('link')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-lg">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Gambar (Opsional)</label>
                @if($portfolio->image)
                    <div class="mb-sm">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" class="w-32 h-20 object-cover rounded border border-outline-variant/50">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-body-md file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer border border-outline-variant/50 rounded-lg p-2">
                <p class="text-label-sm text-on-surface-variant mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                @error('image')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="flex justify-end gap-sm pt-md border-t border-outline-variant">
                <a href="{{ route('admin.portfolios.index') }}" class="px-md py-sm rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors">Batal</a>
                <button type="submit" class="px-md py-sm rounded-lg font-label-md bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
