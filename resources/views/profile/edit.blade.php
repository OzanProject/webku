@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md mb-lg">
        <div>
            <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Profil Saya</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Kelola informasi profil dan pengaturan keamanan akun Anda.</p>
        </div>
    </div>

    <div class="space-y-lg">
        <div class="bg-surface border border-outline-variant p-lg md:p-xl rounded-2xl shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-surface border border-outline-variant p-lg md:p-xl rounded-2xl shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-surface border border-outline-variant p-lg md:p-xl rounded-2xl shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
