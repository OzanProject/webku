@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    <div class="flex items-center gap-sm mb-lg">
        <a href="{{ route('admin.categories.index') }}" class="text-on-surface-variant hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Tambah Kategori</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden max-w-3xl">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-lg">
            @csrf
            
            <div class="mb-md">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Nama Kategori <span class="text-error">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                @error('name')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-md">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Deskripsi Singkat</label>
                <textarea name="description" rows="3" class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">{{ old('description') }}</textarea>
                <p class="text-label-sm text-on-surface-variant mt-1">Deskripsi ini akan muncul di bawah judul menu navigasi.</p>
                @error('description')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-lg">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-outline-variant/50 text-primary focus:ring-primary">
                    <span class="text-body-md font-medium text-on-surface">Aktifkan Kategori</span>
                </label>
            </div>
            
            <div class="flex justify-end gap-sm pt-md border-t border-outline-variant">
                <a href="{{ route('admin.categories.index') }}" class="px-md py-sm rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors">Batal</a>
                <button type="submit" class="px-md py-sm rounded-lg font-label-md bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
