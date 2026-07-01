@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Pesan Masuk</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola pesan dari form kontak di halaman depan.</p>
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
            <h3 class="text-body-lg font-body-lg font-bold text-on-surface whitespace-nowrap">Daftar Pesan</h3>
            
            <form action="{{ route('admin.messages.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row gap-sm items-center">
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengirim, subjek..." class="w-full pl-xl pr-sm py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                    
                    @if(request('search'))
                    <a href="{{ route('admin.messages.index') }}" class="absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-error transition-colors flex items-center justify-center">
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
                        <th class="p-md font-medium border-b border-outline-variant">Pengirim</th>
                        <th class="p-md font-medium border-b border-outline-variant">Subjek</th>
                        <th class="p-md font-medium border-b border-outline-variant w-40">Tanggal</th>
                        <th class="p-md font-medium border-b border-outline-variant text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-body-md font-body-md divide-y divide-outline-variant">
                    @forelse($messages as $index => $message)
                    <tr class="hover:bg-surface-container-low transition-colors group {{ !$message->is_read ? 'bg-primary/5' : '' }}">
                        <td class="p-md text-on-surface-variant">{{ $messages->firstItem() + $index }}</td>
                        <td class="p-md">
                            <div class="flex items-center gap-md">
                                <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($message->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold {{ !$message->is_read ? 'text-primary' : 'text-on-surface' }}">{{ $message->name }}</h4>
                                    <p class="text-sm text-on-surface-variant">{{ $message->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-md">
                            <span class="{{ !$message->is_read ? 'font-bold text-on-surface' : 'text-on-surface-variant' }}">
                                {{ $message->subject ?: '(Tanpa Subjek)' }}
                            </span>
                        </td>
                        <td class="p-md text-sm text-on-surface-variant">
                            {{ $message->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="p-md text-right">
                            <div class="flex justify-end gap-sm">
                                <a href="{{ route('admin.messages.show', $message->id) }}" class="p-sm {{ !$message->is_read ? 'text-primary bg-primary/10' : 'text-on-surface-variant' }} hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Baca Pesan">
                                    <span class="material-symbols-outlined text-[20px]">{{ !$message->is_read ? 'mark_email_unread' : 'visibility' }}</span>
                                </a>
                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
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
                                <span class="material-symbols-outlined text-[48px] mb-md opacity-50">mark_email_read</span>
                                <p class="text-body-lg font-bold mb-xs">Tidak Ada Pesan</p>
                                <p class="text-body-md opacity-80 mb-md">Belum ada pesan masuk saat ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($messages->hasPages())
        <div class="p-md border-t border-outline-variant bg-surface-lowest">
            {{ $messages->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
