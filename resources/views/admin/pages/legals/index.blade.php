@extends('admin.layouts.app')

@push('styles')
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/{{ \App\Models\Setting::get('tinymce_api_key', 'no-api-key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full" x-data="{ tab: 'privacy' }">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Halaman Legal</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola konten halaman Privacy Policy dan Terms of Service menggunakan teks editor.</p>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-lg p-md bg-secondary/10 border border-secondary/20 rounded-lg flex items-start gap-sm text-secondary animate-fade-in-up">
        <span class="material-symbols-outlined text-[20px]">check_circle</span>
        <p class="text-body-md font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-lg">
        
        <!-- Sidebar Tabs -->
        <div class="lg:col-span-1">
            <div class="bg-surface border border-outline-variant rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <button @click="tab = 'privacy'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'privacy', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'privacy' }" class="flex items-center gap-md px-lg py-md text-left transition-colors">
                    <span class="material-symbols-outlined text-[24px]">shield_locked</span>
                    Privacy Policy
                </button>
                
                <button @click="tab = 'terms'" :class="{ 'bg-primary/10 text-primary font-bold border-r-4 border-primary': tab === 'terms', 'text-on-surface-variant hover:bg-surface-container-lowest hover:text-on-surface border-r-4 border-transparent': tab !== 'terms' }" class="flex items-center gap-md px-lg py-md text-left transition-colors border-t border-outline-variant">
                    <span class="material-symbols-outlined text-[24px]">gavel</span>
                    Terms of Service
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <form action="{{ route('admin.legals.update') }}" method="POST" class="bg-surface border border-outline-variant rounded-2xl shadow-sm overflow-hidden">
                @csrf
                
                <!-- Privacy Tab -->
                <div x-show="tab === 'privacy'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">shield_locked</span>
                            Privacy Policy
                        </h3>
                        <p class="text-body-md text-on-surface-variant mt-1">Halaman ini mengatur tentang kebijakan privasi website Anda.</p>
                    </div>

                    <div>
                        <textarea name="legal_privacy_policy" class="tinymce-editor">{{ old('legal_privacy_policy', $privacy) }}</textarea>
                    </div>
                </div>

                <!-- Terms Tab -->
                <div x-show="tab === 'terms'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="p-lg md:p-xl flex flex-col gap-lg" style="display: none;">
                    <div class="border-b border-outline-variant pb-md mb-sm">
                        <h3 class="text-title-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">gavel</span>
                            Terms of Service
                        </h3>
                        <p class="text-body-md text-on-surface-variant mt-1">Halaman ini mengatur tentang syarat dan ketentuan layanan website Anda.</p>
                    </div>

                    <div>
                        <textarea name="legal_terms_of_service" class="tinymce-editor">{{ old('legal_terms_of_service', $terms) }}</textarea>
                    </div>
                </div>

                <!-- Submit Button Area (Always Visible) -->
                <div class="p-lg md:p-xl bg-surface-bright border-t border-outline-variant flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center gap-sm bg-primary text-on-primary px-xl py-3 rounded-xl hover:bg-primary/90 transition-all font-bold text-label-lg shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined">save</span>
                        Simpan Halaman Legal
                    </button>
                </div>
                
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if(typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '.tinymce-editor',
                height: 500,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        } else {
            console.warn('TinyMCE failed to load. Check your internet connection or API key.');
        }
    });
</script>
@endpush
