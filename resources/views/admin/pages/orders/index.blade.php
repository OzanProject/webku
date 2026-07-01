@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Manajemen Pesanan</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola daftar pesanan klien Anda di sini.</p>
        </div>
        <a href="{{ route('admin.orders.create') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary px-md py-sm rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-label-md whitespace-nowrap">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Pesanan
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-lg p-md bg-secondary/10 border border-secondary/20 rounded-lg flex items-start gap-sm text-secondary animate-fade-in-up">
        <span class="material-symbols-outlined text-[20px]">check_circle</span>
        <p class="text-body-md font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Data Table Container -->
    <div class="bg-surface rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
        
        <!-- Table Toolbar -->
        <div class="p-md border-b border-outline-variant flex flex-col xl:flex-row justify-between xl:items-center bg-surface-bright gap-md">
            <h3 class="text-body-lg font-body-lg font-bold text-on-surface whitespace-nowrap">Daftar Pesanan</h3>
            
            <form action="{{ route('admin.orders.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row gap-sm items-center">
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan..." class="w-full pl-xl pr-sm py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                    
                    @if(request('search'))
                    <a href="{{ route('admin.orders.index') }}" class="absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-error transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </a>
                    @endif
                </div>
                <button type="submit" class="hidden">Search</button>
            </form>
        </div>

        <!-- Table Wrapper for Horizontal Scroll -->
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse min-w-[1000px]">
                <thead>
                    <tr class="bg-surface-container-lowest border-b border-outline-variant">
                        <th class="p-md text-label-md font-bold text-on-surface-variant min-w-[120px] whitespace-nowrap">No. Order</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant min-w-[200px]">Klien</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant min-w-[200px]">Item Pesanan</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant w-[150px]">Harga</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant w-[120px]">Status</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant w-[100px] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($orders as $order)
                    <tr class="hover:bg-surface-container-lowest transition-colors group">
                        <td class="p-md whitespace-nowrap">
                            <span class="text-label-md font-bold text-primary">{{ $order->order_number }}</span><br>
                            <span class="text-[11px] text-on-surface-variant">{{ $order->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="p-md">
                            <p class="text-body-md font-bold text-on-surface">{{ $order->customer_name }}</p>
                            @if($order->customer_phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="text-[12px] text-on-surface-variant hover:text-primary flex items-center gap-1 mt-1">
                                    <span class="material-symbols-outlined text-[14px]">call</span> {{ $order->customer_phone }}
                                </a>
                            @endif
                            @if($order->customer_email)
                                <a href="mailto:{{ $order->customer_email }}" class="text-[12px] text-on-surface-variant hover:text-primary flex items-center gap-1 mt-0.5">
                                    <span class="material-symbols-outlined text-[14px]">mail</span> {{ $order->customer_email }}
                                </a>
                            @endif
                        </td>
                        <td class="p-md">
                            <span class="inline-block px-2 py-0.5 bg-surface-container-high rounded text-[11px] font-bold text-on-surface-variant mb-1">{{ $order->order_type }}</span>
                            <p class="text-body-sm font-medium text-on-surface">{{ $order->item_name }}</p>
                        </td>
                        <td class="p-md font-medium text-on-surface">
                            {{ $order->total_price ? 'Rp ' . number_format($order->total_price, 0, ',', '.') : '-' }}
                        </td>
                        <td class="p-md">
                            @if($order->status == 'Pending')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[12px] font-medium bg-[#f59e0b]/10 text-[#d97706] border border-[#f59e0b]/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#f59e0b] mr-1.5"></span> Pending
                            </span>
                            @elseif($order->status == 'Diproses')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[12px] font-medium bg-[#3b82f6]/10 text-[#2563eb] border border-[#3b82f6]/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#3b82f6] mr-1.5"></span> Diproses
                            </span>
                            @elseif($order->status == 'Selesai')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[12px] font-medium bg-[#10b981]/10 text-[#047857] border border-[#10b981]/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#10b981] mr-1.5"></span> Selesai
                            </span>
                            @elseif($order->status == 'Dibatalkan')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[12px] font-medium bg-error/10 text-error border border-error/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-error mr-1.5"></span> Dibatalkan
                            </span>
                            @endif
                        </td>
                        <td class="p-md text-right">
                            <div class="flex justify-end gap-sm">
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="p-sm text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini? Tindakan ini tidak dapat dibatalkan.');">
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
                                <span class="material-symbols-outlined text-[48px] mb-md opacity-50">shopping_cart</span>
                                <p class="text-body-lg font-bold mb-xs">Belum Ada Pesanan</p>
                                <p class="text-body-md opacity-80 mb-md">Anda belum menerima pesanan apapun dari klien.</p>
                                <a href="{{ route('admin.orders.create') }}" class="text-primary hover:underline font-label-md">Buat Pesanan Manual</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="p-md border-t border-outline-variant bg-surface-lowest">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
