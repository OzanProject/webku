@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Manajemen Portofolio</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola proyek portofolio yang ditampilkan di halaman depan.</p>
        </div>
        <div class="flex items-center gap-sm w-full sm:w-auto">
            <a href="{{ route('admin.portfolios.create') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary px-md py-sm rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-label-md whitespace-nowrap">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Portofolio
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

    <!-- Hero Background Form -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden mb-xl p-lg">
        <h3 class="text-title-md font-bold text-on-surface mb-sm">Background Hero Portofolio</h3>
        <p class="text-body-sm text-on-surface-variant mb-md">Ubah gambar background yang muncul di bagian atas halaman Portofolio.</p>
        
        <form action="{{ route('admin.portfolios.hero') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-md items-end">
            @csrf
            <div class="w-full sm:w-auto flex-1">
                <label class="block text-label-sm font-bold text-on-surface mb-xs">Pilih Gambar</label>
                <div class="flex items-center gap-sm">
                    <img src="{{ asset($heroImage) }}" alt="Hero Background" class="w-20 h-12 object-cover rounded border border-outline-variant">
                    <input type="file" name="portfolio_hero_image" accept="image/*" class="w-full text-body-md file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                </div>
            </div>
            <button type="submit" class="px-md py-sm bg-primary text-on-primary rounded-lg font-label-md hover:bg-primary/90 transition-colors shrink-0">
                Update Background
            </button>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden mb-xl">
        <div class="p-md border-b border-outline-variant flex flex-col xl:flex-row justify-between xl:items-center bg-surface-bright gap-md">
            <h3 class="text-body-lg font-body-lg font-bold text-on-surface whitespace-nowrap">Daftar Portofolio</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-lowest text-on-surface-variant text-label-sm font-label-sm uppercase tracking-wider">
                        <th class="p-md font-medium border-b border-outline-variant w-16">No</th>
                        <th class="p-md font-medium border-b border-outline-variant w-24">Gambar</th>
                        <th class="p-md font-medium border-b border-outline-variant">Judul</th>
                        <th class="p-md font-medium border-b border-outline-variant">Kategori</th>
                        <th class="p-md font-medium border-b border-outline-variant text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-body-md font-body-md divide-y divide-outline-variant">
                    @forelse($portfolios as $index => $portfolio)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="p-md text-on-surface-variant">{{ $index + 1 }}</td>
                        <td class="p-md">
                            @if($portfolio->image)
                                <img src="{{ asset('storage/' . $portfolio->image) }}" class="w-16 h-12 object-cover rounded border border-outline-variant/30">
                            @else
                                <div class="w-16 h-12 bg-surface-variant rounded border border-outline-variant/30 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-on-surface-variant/50 text-[20px]">image</span>
                                </div>
                            @endif
                        </td>
                        <td class="p-md font-bold text-on-surface">{{ $portfolio->title }}</td>
                        <td class="p-md"><span class="px-2 py-1 bg-surface-variant text-on-surface-variant text-xs rounded-full">{{ $portfolio->category }}</span></td>
                        <td class="p-md text-right">
                            <div class="flex justify-end gap-sm">
                                <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}" class="p-sm text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portofolio ini?');">
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
                                <span class="material-symbols-outlined text-[48px] mb-md opacity-50">photo_library</span>
                                <p class="text-body-lg font-bold mb-xs">Belum Ada Portofolio</p>
                                <p class="text-body-md opacity-80 mb-md">Anda belum menambahkan proyek portofolio manapun.</p>
                                <a href="{{ route('admin.portfolios.create') }}" class="text-primary hover:underline font-label-md">Tambah Portofolio Pertama</a>
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
