@extends('admin.layouts.app')

@section('content')
<div x-data="{ showImportModal: false }" class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Manajemen Produk</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola daftar produk atau portofolio Anda.</p>
        </div>
        <div class="flex items-center gap-sm w-full sm:w-auto">
            <button @click="showImportModal = true" class="inline-flex items-center gap-sm bg-surface-container-high text-on-surface border border-outline-variant px-md py-sm rounded-lg hover:bg-surface-container-highest transition-colors font-label-md whitespace-nowrap">
                <span class="material-symbols-outlined text-[20px]">upload_file</span>
                Import Excel
            </button>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary px-md py-sm rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-label-md whitespace-nowrap">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Produk
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
            <h3 class="text-body-lg font-body-lg font-bold text-on-surface whitespace-nowrap">Daftar Produk</h3>
            
            <form action="{{ route('admin.products.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row gap-sm items-center">
                <!-- Data Per Page -->
                <div class="flex items-center gap-sm">
                    <label for="per_page" class="text-label-sm font-medium text-on-surface-variant whitespace-nowrap">Tampilkan</label>
                    <select name="per_page" id="per_page" class="py-sm pl-sm pr-lg rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-label-md outline-none transition-colors cursor-pointer" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="text-label-sm font-medium text-on-surface-variant whitespace-nowrap">data</span>
                </div>
                
                <!-- Search Bar -->
                <div class="relative w-full sm:w-64">
                    <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-xl pr-sm py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                    
                    @if(request('search'))
                    <a href="{{ route('admin.products.index') }}" class="absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-error transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </a>
                    @endif
                </div>
                <button type="submit" class="hidden">Search</button>
            </form>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-lowest text-on-surface-variant text-label-sm font-label-sm uppercase tracking-wider">
                        <th class="p-md font-medium border-b border-outline-variant w-16">No</th>
                        <th class="p-md font-medium border-b border-outline-variant">Produk</th>
                        <th class="p-md font-medium border-b border-outline-variant">Kategori</th>
                        <th class="p-md font-medium border-b border-outline-variant">Harga</th>
                        <th class="p-md font-medium border-b border-outline-variant">Status</th>
                        <th class="p-md font-medium border-b border-outline-variant text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-body-md font-body-md divide-y divide-outline-variant">
                    @forelse($products as $index => $product)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="p-md text-on-surface-variant">{{ $products->firstItem() + $index }}</td>
                        <td class="p-md">
                            <div class="flex items-center gap-md">
                                <div class="w-12 h-12 rounded-lg bg-surface-container-high overflow-hidden shrink-0 border border-outline-variant/30">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                                            <span class="material-symbols-outlined">image</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-on-surface">{{ $product->title }}</h4>
                                    <p class="text-sm text-on-surface-variant truncate max-w-[200px]">{{ $product->description }}</p>
                                    <div class="flex items-center gap-3 mt-1.5">
                                        @if($product->demo_link)
                                        <a href="{{ $product->demo_link }}" target="_blank" class="inline-flex items-center text-[11px] font-medium text-primary hover:underline bg-primary/5 px-1.5 py-0.5 rounded border border-primary/10">
                                            <span class="material-symbols-outlined text-[12px] mr-1">open_in_new</span> Live Demo
                                        </a>
                                        @endif
                                        @if(is_array($product->features) && count($product->features) > 0)
                                        <span class="inline-flex items-center text-[11px] font-medium text-on-surface-variant bg-surface-container-high px-1.5 py-0.5 rounded border border-outline-variant/50" title="Dilengkapi Spesifikasi">
                                            <span class="material-symbols-outlined text-[12px] mr-1">list_alt</span> {{ count($product->features) }} Fitur
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="p-md">
                            <span class="inline-flex px-2 py-1 rounded-md bg-secondary/10 text-secondary text-label-sm font-label-sm border border-secondary/20">
                                {{ $product->category_label }}
                            </span>
                        </td>
                        <td class="p-md font-medium text-on-surface-variant">
                            {{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : '-' }}
                        </td>
                        <td class="p-md">
                            @if($product->is_active)
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
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="p-sm text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
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
                        <td colspan="6" class="p-xl text-center">
                            <div class="flex flex-col items-center justify-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-[48px] mb-md opacity-50">inventory_2</span>
                                <p class="text-body-lg font-bold mb-xs">Belum Ada Produk</p>
                                <p class="text-body-md opacity-80 mb-md">Anda belum menambahkan produk atau portofolio apapun.</p>
                                <a href="{{ route('admin.products.create') }}" class="text-primary hover:underline font-label-md">Tambah Produk Pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
        <div class="p-md border-t border-outline-variant bg-surface-lowest">
            {{ $products->links() }}
        </div>
        @endif
    </div>
    <!-- Import Modal -->
    <div x-show="showImportModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div @click.outside="showImportModal = false" class="bg-surface w-full max-w-md mx-4 rounded-2xl shadow-xl overflow-hidden">
            <div class="px-lg py-md border-b border-outline-variant flex items-center justify-between bg-surface-container-lowest">
                <h3 class="text-headline-sm font-headline-sm font-bold text-on-surface">Import Data Produk</h3>
                <button @click="showImportModal = false" class="text-on-surface-variant hover:text-error transition-colors p-1 rounded-md hover:bg-error/10">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            <div class="p-lg">
                <p class="text-body-md text-on-surface-variant mb-md">Gunakan file template Excel untuk mengimpor data produk secara massal. Data yang diimpor tidak akan memiliki foto/gambar bawaan.</p>
                
                <a href="{{ route('admin.products.template') }}" class="inline-flex items-center gap-sm px-md py-sm bg-surface-container-high hover:bg-surface-container-highest border border-outline-variant rounded-lg text-on-surface font-label-md transition-colors w-full justify-center mb-lg">
                    <span class="material-symbols-outlined text-[20px]">download</span>
                    Download Template Excel
                </a>

                <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-lg">
                        <label class="block text-label-md font-bold text-on-surface mb-xs">Upload File Excel <span class="text-error">*</span></label>
                        <div class="border-2 border-dashed border-outline-variant rounded-xl p-xl text-center hover:border-primary hover:bg-primary/5 transition-colors cursor-pointer relative">
                            <input type="file" name="file" accept=".xlsx,.csv" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="document.getElementById('fileNameProduct').innerText = this.files[0] ? this.files[0].name : 'Belum ada file dipilih'">
                            <span class="material-symbols-outlined text-[40px] text-on-surface-variant mb-sm">upload_file</span>
                            <p class="text-body-md text-on-surface font-medium">Klik atau Seret file ke sini</p>
                            <p id="fileNameProduct" class="text-label-sm text-primary mt-2">Belum ada file dipilih (.xlsx, .csv)</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-sm pt-md border-t border-outline-variant">
                        <button type="button" @click="showImportModal = false" class="px-md py-sm rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors">Batal</button>
                        <button type="submit" class="px-md py-sm rounded-lg font-label-md bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-sm">
                            <span class="material-symbols-outlined text-[18px]">publish</span>
                            Mulai Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
