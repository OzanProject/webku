@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Manajemen Proses Kerja</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola langkah-langkah proses kerja yang ditampilkan di beranda.</p>
        </div>
        <div class="flex items-center gap-sm w-full sm:w-auto">
            <a href="{{ route('admin.processes.create') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary px-md py-sm rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-label-md whitespace-nowrap">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Proses
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
            <h3 class="text-body-lg font-body-lg font-bold text-on-surface whitespace-nowrap">Daftar Proses Kerja</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-lowest text-on-surface-variant text-label-sm font-label-sm uppercase tracking-wider">
                        <th class="p-md font-medium border-b border-outline-variant w-16">Urutan</th>
                        <th class="p-md font-medium border-b border-outline-variant w-24">Langkah</th>
                        <th class="p-md font-medium border-b border-outline-variant">Judul</th>
                        <th class="p-md font-medium border-b border-outline-variant">Deskripsi</th>
                        <th class="p-md font-medium border-b border-outline-variant text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-body-md font-body-md divide-y divide-outline-variant">
                    @forelse($processes as $process)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="p-md text-on-surface-variant text-center font-bold">{{ $process->sort_order }}</td>
                        <td class="p-md text-on-surface-variant text-center">
                            <span class="inline-flex w-8 h-8 items-center justify-center rounded-full bg-primary/10 text-primary font-bold">
                                {{ $process->step_number }}
                            </span>
                        </td>
                        <td class="p-md font-bold text-on-surface">{{ $process->title }}</td>
                        <td class="p-md text-on-surface-variant">{{ Str::limit($process->description, 60) }}</td>
                        <td class="p-md text-right">
                            <div class="flex justify-end gap-sm">
                                <a href="{{ route('admin.processes.edit', $process->id) }}" class="p-sm text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.processes.destroy', $process->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus langkah ini?');">
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
                                <span class="material-symbols-outlined text-[48px] mb-md opacity-50">list_alt</span>
                                <p class="text-body-lg font-bold mb-xs">Belum Ada Proses Kerja</p>
                                <p class="text-body-md opacity-80 mb-md">Anda belum menambahkan langkah proses kerja satupun.</p>
                                <a href="{{ route('admin.processes.create') }}" class="text-primary hover:underline font-label-md">Tambah Proses Pertama</a>
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
