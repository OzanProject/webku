@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    
    <!-- Header Section -->
    <div class="flex items-center gap-sm mb-lg">
        <a href="{{ route('admin.orders.index') }}" class="p-2 rounded-full hover:bg-surface-container-high text-on-surface-variant transition-colors">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Detail & Edit Pesanan</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Nomor Order: <span class="font-bold text-primary">{{ $order->order_number }}</span></p>
        </div>
    </div>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
        @csrf
        @method('PUT')
        
        <!-- Left Column: Main Order Details -->
        <div class="lg:col-span-2 flex flex-col gap-lg">
            
            <!-- Customer Information -->
            <div class="bg-surface border border-outline-variant rounded-2xl p-lg shadow-sm">
                <h3 class="text-title-lg font-bold text-on-surface mb-md pb-sm border-b border-outline-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">person</span>
                    Informasi Klien
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div>
                        <label for="customer_name" class="block text-label-md font-bold text-on-surface mb-xs">Nama Pemesan <span class="text-error">*</span></label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $order->customer_name) }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary focus:border-primary px-md py-sm @error('customer_name') border-error @enderror" required placeholder="Contoh: Budi Santoso">
                        @error('customer_name') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="customer_phone" class="block text-label-md font-bold text-on-surface mb-xs">No. WhatsApp <span class="text-error">*</span></label>
                        <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary focus:border-primary px-md py-sm @error('customer_phone') border-error @enderror" required placeholder="Contoh: 08123456789">
                        @error('customer_phone') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="customer_email" class="block text-label-md font-bold text-on-surface mb-xs">Email (Opsional)</label>
                        <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email', $order->customer_email) }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary focus:border-primary px-md py-sm @error('customer_email') border-error @enderror" placeholder="Contoh: budi@gmail.com">
                        @error('customer_email') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="bg-surface border border-outline-variant rounded-2xl p-lg shadow-sm">
                <h3 class="text-title-lg font-bold text-on-surface mb-md pb-sm border-b border-outline-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">shopping_bag</span>
                    Detail Pesanan
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div>
                        <label for="order_type" class="block text-label-md font-bold text-on-surface mb-xs">Jenis Pesanan <span class="text-error">*</span></label>
                        <select name="order_type" id="order_type" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary focus:border-primary px-md py-sm @error('order_type') border-error @enderror" required>
                            <option value="Produk" {{ old('order_type', $order->order_type) == 'Produk' ? 'selected' : '' }}>Produk / Aplikasi</option>
                            <option value="Layanan" {{ old('order_type', $order->order_type) == 'Layanan' ? 'selected' : '' }}>Layanan Jasa</option>
                            <option value="Lainnya" {{ old('order_type', $order->order_type) == 'Lainnya' ? 'selected' : '' }}>Lainnya (Custom)</option>
                        </select>
                        @error('order_type') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="item_name" class="block text-label-md font-bold text-on-surface mb-xs">Nama Item <span class="text-error">*</span></label>
                        <input type="text" name="item_name" id="item_name" value="{{ old('item_name', $order->item_name) }}" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary focus:border-primary px-md py-sm @error('item_name') border-error @enderror" required placeholder="Contoh: Web Company Profile">
                        @error('item_name') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="total_price" class="block text-label-md font-bold text-on-surface mb-xs">Total Harga kesepakatan (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium">Rp</span>
                            <input type="number" name="total_price" id="total_price" value="{{ old('total_price', $order->total_price) }}" min="0" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary focus:border-primary pl-12 pr-md py-sm @error('total_price') border-error @enderror" placeholder="0">
                        </div>
                        @error('total_price') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-surface border border-outline-variant rounded-2xl p-lg shadow-sm">
                <h3 class="text-title-lg font-bold text-on-surface mb-md pb-sm border-b border-outline-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">description</span>
                    Catatan Tambahan
                </h3>
                <label for="notes" class="block text-label-md font-bold text-on-surface mb-xs">Detail Permintaan / Catatan</label>
                <textarea name="notes" id="notes" rows="4" class="w-full border-outline-variant rounded-lg text-body-md bg-surface focus:ring-primary focus:border-primary px-md py-sm" placeholder="Masukkan catatan tambahan dari klien (jika ada)...">{{ old('notes', $order->notes) }}</textarea>
            </div>
            
        </div>

        <!-- Right Column: Settings & Submit -->
        <div class="flex flex-col gap-lg">
            
            <div class="bg-surface border border-outline-variant rounded-2xl p-lg shadow-sm">
                <h3 class="text-title-lg font-bold text-on-surface mb-md pb-sm border-b border-outline-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">analytics</span>
                    Status Pesanan
                </h3>

                <div class="space-y-sm">
                    <label class="flex items-center gap-sm cursor-pointer p-sm hover:bg-surface-container-lowest rounded-lg transition-colors border border-outline-variant/50">
                        <input type="radio" name="status" value="Pending" class="text-[#d97706] focus:ring-[#d97706] w-5 h-5" {{ old('status', $order->status) == 'Pending' ? 'checked' : '' }}>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#f59e0b]"></span>
                            <span class="text-body-md font-medium text-on-surface">Pending (Baru)</span>
                        </div>
                    </label>
                    
                    <label class="flex items-center gap-sm cursor-pointer p-sm hover:bg-surface-container-lowest rounded-lg transition-colors border border-outline-variant/50">
                        <input type="radio" name="status" value="Diproses" class="text-[#2563eb] focus:ring-[#2563eb] w-5 h-5" {{ old('status', $order->status) == 'Diproses' ? 'checked' : '' }}>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#3b82f6]"></span>
                            <span class="text-body-md font-medium text-on-surface">Diproses</span>
                        </div>
                    </label>

                    <label class="flex items-center gap-sm cursor-pointer p-sm hover:bg-surface-container-lowest rounded-lg transition-colors border border-outline-variant/50">
                        <input type="radio" name="status" value="Selesai" class="text-[#047857] focus:ring-[#047857] w-5 h-5" {{ old('status', $order->status) == 'Selesai' ? 'checked' : '' }}>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#10b981]"></span>
                            <span class="text-body-md font-medium text-on-surface">Selesai</span>
                        </div>
                    </label>

                    <label class="flex items-center gap-sm cursor-pointer p-sm hover:bg-error/5 rounded-lg transition-colors border border-error/20 bg-error/5 mt-md">
                        <input type="radio" name="status" value="Dibatalkan" class="text-error focus:ring-error w-5 h-5" {{ old('status', $order->status) == 'Dibatalkan' ? 'checked' : '' }}>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-error"></span>
                            <span class="text-body-md font-medium text-error font-bold">Dibatalkan</span>
                        </div>
                    </label>
                </div>
                @error('status') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="bg-surface border border-outline-variant rounded-2xl p-lg shadow-sm flex flex-col gap-sm">
                <button type="submit" class="w-full flex items-center justify-center gap-sm bg-primary text-on-primary px-xl py-md rounded-xl hover:bg-primary/90 transition-all font-bold text-label-lg shadow-sm hover:shadow-md">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.orders.index') }}" class="w-full flex items-center justify-center gap-sm bg-surface-container-high text-on-surface px-xl py-md rounded-xl hover:bg-surface-container-highest transition-all font-bold text-label-lg border border-outline-variant">
                    Batal
                </a>
            </div>

        </div>
    </form>
</div>
@endsection
