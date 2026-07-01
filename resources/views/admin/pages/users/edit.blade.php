@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex items-center gap-sm mb-lg">
        <a href="{{ route('admin.users.index') }}" class="p-2 rounded-full hover:bg-surface-container-high text-on-surface-variant transition-colors">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Edit Pengguna</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Ubah informasi akun administrator.</p>
        </div>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="max-w-2xl">
        @csrf
        @method('PUT')
        
        <div class="bg-surface border border-outline-variant rounded-2xl p-lg shadow-sm flex flex-col gap-lg">
            
            <div class="flex items-start gap-4 mb-2 pb-sm border-b border-outline-variant">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[28px]">manage_accounts</span>
                </div>
                <div>
                    <h3 class="text-title-lg font-bold text-on-surface">Detail Akun</h3>
                    <p class="text-body-sm text-on-surface-variant">Biarkan password kosong jika tidak ingin mengubahnya.</p>
                </div>
            </div>

            <div>
                <label for="name" class="block text-label-md font-bold text-on-surface mb-xs">Nama Lengkap <span class="text-error">*</span></label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">badge</span>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary @error('name') border-error @enderror" required placeholder="Masukkan nama lengkap">
                </div>
                @error('name') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-label-md font-bold text-on-surface mb-xs">Alamat Email <span class="text-error">*</span></label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">mail</span>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary @error('email') border-error @enderror" required placeholder="admin@domain.com">
                </div>
                @error('email') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant border-dashed">
                <label for="password" class="block text-label-md font-bold text-on-surface mb-xs">Ganti Password (Opsional)</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock_reset</span>
                    <input type="password" name="password" id="password" class="w-full pl-12 pr-4 py-3 border-outline-variant rounded-xl text-body-md bg-surface focus:ring-primary focus:border-primary @error('password') border-error @enderror" placeholder="Isi untuk mengubah password">
                </div>
                @error('password') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 mt-2 border-t border-outline-variant flex items-center gap-sm">
                <button type="submit" class="flex-1 sm:flex-none inline-flex justify-center items-center gap-sm bg-primary text-on-primary px-xl py-3 rounded-xl hover:bg-primary/90 transition-all font-bold text-label-lg shadow-sm hover:shadow-md">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.users.index') }}" class="flex-1 sm:flex-none inline-flex justify-center items-center gap-sm bg-surface-container-high text-on-surface px-xl py-3 rounded-xl hover:bg-surface-container-highest transition-all font-bold text-label-lg border border-outline-variant">
                    Batal
                </a>
            </div>
            
        </div>
    </form>
</div>
@endsection
