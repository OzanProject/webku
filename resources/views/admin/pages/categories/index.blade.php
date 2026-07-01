@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Manajemen Kategori</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola kategori layanan yang ditampilkan pada menu navigasi website.</p>
        </div>
        <div class="flex items-center gap-sm w-full sm:w-auto">
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary px-md py-sm rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-label-md whitespace-nowrap">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-lg p-md bg-[#10b981]/10 border border-[#10b981]/20 rounded-lg flex items-start gap-md text-[#047857]">
        <span class="material-symbols-outlined text-[#10b981]">check_circle</span>
        <div class="flex-1">
            <h4 class="font-label-md font-bold">Berhasil!</h4>
            <p class="text-body-md text-sm mt-1">{{ session('success') }}</p>
        </div>
        <button type="button" onclick="this.parentElement.style.display='none'" class="text-[#047857]/70 hover:text-[#047857]">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
    @endif

    <!-- Data Table Card -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden mb-xl">
        <div class="p-md border-b border-outline-variant flex flex-col xl:flex-row justify-between xl:items-center bg-surface-bright gap-md">
            <h3 class="text-body-lg font-body-lg font-bold text-on-surface whitespace-nowrap">Daftar Kategori</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-lowest text-on-surface-variant text-label-sm font-label-sm uppercase tracking-wider">
                        <th class="p-md font-medium border-b border-outline-variant w-16">No</th>
                        <th class="p-md font-medium border-b border-outline-variant">Nama Kategori</th>
                        <th class="p-md font-medium border-b border-outline-variant">Deskripsi</th>
                        <th class="p-md font-medium border-b border-outline-variant w-32">Status</th>
                        <th class="p-md font-medium border-b border-outline-variant text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-body-md font-body-md divide-y divide-outline-variant">
                    @forelse($categories as $index => $category)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="p-md text-on-surface-variant">{{ $index + 1 }}</td>
                        <td class="p-md font-bold text-on-surface">{{ $category->name }}</td>
                        <td class="p-md text-on-surface-variant">{{ $category->description ?? '-' }}</td>
                        <td class="p-md">
                            @if($category->is_active)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[12px] font-medium bg-[#10b981]/10 text-[#047857] border border-[#10b981]/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#10b981] mr-1.5"></span> Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[12px] font-medium bg-error/10 text-error border border-error/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-error mr-1.5"></span> Nonaktif
                            </span>
                            @endif
                        </td>
                        <td class="p-md text-right">
                            <div class="flex justify-end gap-sm">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-sm text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-sm text-on-surface-variant hover:text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-xl text-center">
                            <div class="flex flex-col items-center justify-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-[48px] mb-md opacity-50">category</span>
                                <p class="text-body-lg font-bold mb-xs">Belum Ada Kategori</p>
                                <p class="text-body-md opacity-80 mb-md">Anda belum menambahkan kategori layanan manapun.</p>
                                <a href="{{ route('admin.categories.create') }}" class="text-primary hover:underline font-label-md">Tambah Kategori Pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
