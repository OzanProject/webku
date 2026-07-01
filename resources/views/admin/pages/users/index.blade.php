@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Manajemen Pengguna</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola akses admin dan pengguna website.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary px-md py-sm rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-label-md whitespace-nowrap">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            Tambah Pengguna
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-lg p-md bg-secondary/10 border border-secondary/20 rounded-lg flex items-start gap-sm text-secondary animate-fade-in-up">
        <span class="material-symbols-outlined text-[20px]">check_circle</span>
        <p class="text-body-md font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Alert Error -->
    @if(session('error'))
    <div class="mb-lg p-md bg-error/10 border border-error/20 rounded-lg flex items-start gap-sm text-error animate-fade-in-up">
        <span class="material-symbols-outlined text-[20px]">error</span>
        <p class="text-body-md font-medium">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Data Table Container -->
    <div class="bg-surface rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
        
        <!-- Table Toolbar -->
        <div class="p-md border-b border-outline-variant flex flex-col xl:flex-row justify-between xl:items-center bg-surface-bright gap-md">
            <h3 class="text-body-lg font-body-lg font-bold text-on-surface whitespace-nowrap">Daftar Admin</h3>
            
            <form action="{{ route('admin.users.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row gap-sm items-center">
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full pl-xl pr-sm py-sm rounded-lg border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-body-md outline-none transition-colors">
                    
                    @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-error transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </a>
                    @endif
                </div>
                <button type="submit" class="hidden">Search</button>
            </form>
        </div>

        <!-- Table Wrapper for Horizontal Scroll -->
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-lowest border-b border-outline-variant">
                        <th class="p-md text-label-md font-bold text-on-surface-variant w-[60px]">No</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant min-w-[200px]">Nama Lengkap</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant min-w-[200px]">Email</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant w-[150px]">Bergabung Pada</th>
                        <th class="p-md text-label-md font-bold text-on-surface-variant w-[120px] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($users as $user)
                    <tr class="hover:bg-surface-container-lowest transition-colors group">
                        <td class="p-md text-body-md text-on-surface-variant">
                            {{ $loop->iteration + $users->firstItem() - 1 }}
                        </td>
                        <td class="p-md">
                            <div class="flex items-center gap-md">
                                <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-label-lg shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-body-md font-bold text-on-surface">{{ $user->name }}
                                        @if($user->email === 'admin@ozanproject.com')
                                            <span class="inline-block ml-1 px-2 py-0.5 bg-secondary/10 text-secondary border border-secondary/20 rounded text-[10px] font-bold tracking-wider" title="Administrator Utama">UTAMA</span>
                                        @endif
                                        @if(auth()->id() === $user->id)
                                            <span class="inline-block ml-1 px-2 py-0.5 bg-primary/10 text-primary rounded text-[10px] font-bold uppercase tracking-wider">Anda</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="p-md text-body-md text-on-surface">
                            {{ $user->email }}
                        </td>
                        <td class="p-md text-body-md text-on-surface-variant">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="p-md text-right">
                            <div class="flex justify-end gap-sm">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-sm text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                @if(auth()->id() === $user->id)
                                <button type="button" disabled class="p-sm text-on-surface-variant/30 rounded-lg cursor-not-allowed" title="Tidak dapat menghapus akun sendiri">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                                @elseif($user->email === 'admin@ozanproject.com')
                                <button type="button" disabled class="p-sm text-on-surface-variant/30 rounded-lg cursor-not-allowed" title="Administrator Utama tidak dapat dihapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                                @else
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-sm text-on-surface-variant hover:text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-xl text-center">
                            <div class="flex flex-col items-center justify-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-[48px] mb-md opacity-50">group</span>
                                <p class="text-body-lg font-bold mb-xs">Data Tidak Ditemukan</p>
                                <p class="text-body-md opacity-80 mb-md">Belum ada akun pengguna lain yang didaftarkan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="p-md border-t border-outline-variant bg-surface-lowest">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
