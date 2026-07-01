@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    <div class="flex items-center gap-sm mb-lg">
        <a href="{{ route('admin.processes.index') }}" class="text-on-surface-variant hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Edit Proses Kerja</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden max-w-3xl">
        <form action="{{ route('admin.processes.update', $process->id) }}" method="POST" class="p-lg">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-md mb-md">
                <div>
                    <label class="block text-label-md font-bold text-on-surface mb-xs">Angka Langkah <span class="text-error">*</span></label>
                    <input type="number" name="step_number" value="{{ old('step_number', $process->step_number) }}" required class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                    <p class="text-label-sm text-on-surface-variant mt-1">Angka yang akan ditampilkan, contoh: 1, 2, 3</p>
                    @error('step_number')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-label-md font-bold text-on-surface mb-xs">Urutan Tampil (Sort Order) <span class="text-error">*</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $process->sort_order) }}" required class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                    <p class="text-label-sm text-on-surface-variant mt-1">Urutan dari kiri ke kanan, contoh: 1, 2, 3</p>
                    @error('sort_order')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-md">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Judul Proses <span class="text-error">*</span></label>
                <input type="text" name="title" value="{{ old('title', $process->title) }}" required class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                @error('title')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-lg">
                <label class="block text-label-md font-bold text-on-surface mb-xs">Deskripsi <span class="text-error">*</span></label>
                <textarea name="description" rows="3" required class="w-full px-md py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">{{ old('description', $process->description) }}</textarea>
                @error('description')<p class="text-error text-label-sm mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="flex justify-end gap-sm pt-md border-t border-outline-variant">
                <a href="{{ route('admin.processes.index') }}" class="px-md py-sm rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors">Batal</a>
                <button type="submit" class="px-md py-sm rounded-lg font-label-md bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
