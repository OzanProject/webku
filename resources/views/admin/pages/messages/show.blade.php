@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <div class="flex items-center gap-sm mb-xs text-on-surface-variant">
                <a href="{{ route('admin.messages.index') }}" class="hover:text-primary transition-colors">Pesan Masuk</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-on-surface">Detail Pesan</span>
            </div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Detail Pesan</h2>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-sm bg-surface-container-high text-on-surface px-md py-sm rounded-lg hover:bg-surface-container-highest transition-colors font-label-md border border-outline-variant">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Kembali
        </a>
    </div>

    <!-- Message Card -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden mb-xl max-w-4xl">
        <div class="p-lg border-b border-outline-variant bg-surface-bright flex justify-between items-start">
            <div class="flex items-start gap-md">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xl mt-1">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-title-lg font-bold text-on-surface">{{ $message->name }}</h3>
                    <p class="text-body-md text-on-surface-variant mb-1">
                        <a href="mailto:{{ $message->email }}" class="hover:text-primary transition-colors">{{ $message->email }}</a>
                    </p>
                    <p class="text-label-sm text-on-surface-variant flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">schedule</span>
                        {{ $message->created_at->format('l, d F Y - H:i') }}
                    </p>
                    <p class="text-label-sm text-on-surface-variant flex items-center gap-1 mt-1">
                        <span class="material-symbols-outlined text-[14px]">dns</span>
                        IP: {{ $message->ip_address ?: 'Tidak tercatat' }}
                    </p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="mailto:{{ $message->email }}" class="p-sm text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Balas Email">
                    <span class="material-symbols-outlined text-[20px]">reply</span>
                </a>
                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-sm text-on-surface-variant hover:text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus">
                        <span class="material-symbols-outlined text-[20px]">delete</span>
                    </button>
                </form>
            </div>
        </div>
        
        <div class="p-lg">
            <h4 class="text-title-md font-bold text-on-surface mb-md pb-sm border-b border-outline-variant/50">
                Subjek: {{ $message->subject ?: '(Tanpa Subjek)' }}
            </h4>
            
            <div class="text-body-lg text-on-surface whitespace-pre-wrap leading-relaxed">
                {{ $message->message }}
            </div>
        </div>
        
        <div class="p-md border-t border-outline-variant bg-surface-container-lowest flex justify-end">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject ?: 'Balasan') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary px-lg py-sm rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-label-md">
                <span class="material-symbols-outlined text-[20px]">reply</span>
                Balas via Email
            </a>
        </div>
    </div>
</div>
@endsection
