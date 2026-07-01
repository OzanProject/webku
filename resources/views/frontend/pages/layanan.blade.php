@extends('frontend.layouts.app')
@section('title', 'Layanan Kami - ' . $siteName)
@section('meta_description', 'Layanan pembuatan website, aplikasi mobile, dan sistem kustom terbaik untuk bisnis Anda.')

@section('content')
    <!-- Alert Success -->
    @if(session('order_success'))
    <div class="max-w-container-max mx-auto px-gutter mt-[100px] mb-[-80px]">
        <div class="p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3 text-green-700 shadow-sm animate-fade-in-up">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <p class="text-sm font-medium">{{ session('order_success') }}</p>
        </div>
    </div>
    @endif

    <section class="max-w-container-max mx-auto px-gutter py-xxl pt-[120px]" x-data="{ orderModalOpen: false, selectedService: '' }">
        <div class="text-center mb-xl">
            <h1 class="font-display-lg-mobile md:font-headline-lg text-on-surface mb-sm">Layanan Kami</h1>
            <p class="font-body-lg text-on-surface-variant max-w-2xl mx-auto">Solusi digital menyeluruh untuk kebutuhan bisnis Anda di era modern.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            @foreach($services as $service)
            <div class="bg-surface-bright p-lg rounded-xl border border-outline-variant/30 shadow-sm hover:shadow-lg transition-all transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-primary-container/10 rounded-lg flex items-center justify-center text-primary-container mb-md">
                    <span class="material-symbols-outlined">{{ $service->icon }}</span>
                </div>
                <h3 class="font-headline-md text-on-surface mb-sm text-xl">{{ $service->title }}</h3>
                <p class="font-body-md text-on-surface-variant mb-6">{{ $service->description }}</p>
                <button type="button" @click="selectedService = '{{ addslashes($service->title) }}'; orderModalOpen = true" class="w-full inline-flex justify-center items-center gap-2 bg-primary/10 text-primary hover:bg-primary hover:text-on-primary font-bold py-2 px-4 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                    Pesan Layanan
                </button>
            </div>
            @endforeach
        </div>

        <!-- ===== ORDER MODAL ===== -->
        <div x-show="orderModalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Background backdrop -->
            <div x-show="orderModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/75 transition-opacity backdrop-blur-sm"></div>

            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="orderModalOpen" @click.away="orderModalOpen = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    
                    <!-- Modal Header -->
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900" id="modal-title">{{ __('Form Pemesanan') }}</h3>
                        <button type="button" @click="orderModalOpen = false" class="text-gray-400 hover:text-gray-500">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    
                    <form action="{{ route('order.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_type" value="Layanan">
                        <input type="hidden" name="item_name" x-model="selectedService">

                        <!-- Modal Body -->
                        <div class="px-6 py-6 space-y-5">
                            
                            <!-- Alert Service Name -->
                            <div class="bg-primary-container/10 border border-primary/20 rounded-lg p-4 flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary mt-0.5">design_services</span>
                                <div>
                                    <p class="text-xs text-primary font-semibold uppercase tracking-wider mb-1">{{ __('Memesan Layanan') }}</p>
                                    <p class="text-sm font-bold text-gray-900" x-text="selectedService"></p>
                                </div>
                            </div>

                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nama Lengkap') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" id="customer_name" required class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-primary focus:ring-primary" placeholder="Masukkan nama lengkap Anda">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('No. WhatsApp') }} <span class="text-red-500">*</span></label>
                                    <input type="text" name="customer_phone" id="customer_phone" required class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-primary focus:ring-primary" placeholder="0812...">
                                </div>
                                <div>
                                    <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Email') }}</label>
                                    <input type="email" name="customer_email" id="customer_email" class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-primary focus:ring-primary" placeholder="opsional@email.com">
                                </div>
                            </div>

                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Catatan Tambahan') }}</label>
                                <textarea name="notes" id="notes" rows="3" class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-primary focus:ring-primary" placeholder="Ceritakan sedikit tentang kebutuhan Anda..."></textarea>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                            <button type="button" @click="orderModalOpen = false" class="rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Batal</button>
                            <button type="submit" class="inline-flex justify-center rounded-lg bg-primary px-6 py-2.5 text-sm font-semibold text-on-primary shadow-sm hover:bg-primary/90 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">send</span>
                                Kirim Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA BANNER --}}
    <section class="max-w-container-max mx-auto px-gutter py-xl">
        <div class="bg-primary-container rounded-2xl p-xxl text-center text-on-primary shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="font-display-lg-mobile md:font-headline-lg mb-md">Siap Memulai Proyek Anda?</h2>
                <p class="font-body-lg mb-xl max-w-2xl mx-auto opacity-90">Diskusikan kebutuhan bisnis Anda dengan tim ahli kami.</p>
                <a href="{{ route('contact') }}" class="inline-block bg-surface text-primary-container font-label-md px-8 py-4 rounded-lg hover:bg-surface-variant transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-lg">
                    Hubungi Kami Sekarang
                </a>
            </div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
        </div>
    </section>
@endsection
