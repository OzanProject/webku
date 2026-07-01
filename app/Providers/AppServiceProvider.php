<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use View::composer so settings are re-read on EVERY request
        // (View::share only runs once at boot and gets cached)
        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('settings')) {
                    $view->with([
                        'siteName'            => Setting::get('site_title',        config('app.name')),
                        'siteDescription'     => Setting::get('site_description',  ''),
                        'siteLogo'            => Setting::get('site_logo',         null),
                        'contactEmail'        => Setting::get('contact_email',     ''),
                        'contactPhone'        => Setting::get('contact_phone',     ''),
                        'contactAddress'      => Setting::get('contact_address',   ''),
                        'contactWorkingHours' => Setting::get('contact_working_hours', 'Senin - Jumat: 09.00 - 17.00 WIB'),
                        'contactTitle'        => Setting::get('contact_title',     'Ayo Bicara!'),
                        'contactSubtitle'     => Setting::get('contact_subtitle',  'Ceritakan kebutuhan digital Anda dan tim kami akan merespons dalam 1x24 jam kerja.'),
                        'socialInstagram'     => Setting::get('social_instagram',  ''),
                        'socialFacebook'      => Setting::get('social_facebook',   ''),
                        'socialLinkedin'      => Setting::get('social_linkedin',   ''),
                        'navCategories'       => Schema::hasTable('categories') ? Category::active()->get() : collect(),
                    ]);
                } else {
                    $view->with([
                        'siteName'            => config('app.name'),
                        'siteDescription'     => '',
                        'siteLogo'            => null,
                        'contactEmail'        => '',
                        'contactPhone'        => '',
                        'contactAddress'      => '',
                        'contactWorkingHours' => 'Senin - Jumat: 09.00 - 17.00 WIB',
                        'contactTitle'        => 'Ayo Bicara!',
                        'contactSubtitle'     => 'Ceritakan kebutuhan digital Anda dan tim kami akan merespons dalam 1x24 jam kerja.',
                        'socialInstagram'     => '',
                        'socialFacebook'      => '',
                        'socialLinkedin'      => '',
                        'navCategories'       => collect(),
                    ]);
                }
            } catch (\Exception $e) {
                    $view->with([
                        'siteName'            => config('app.name'),
                        'siteDescription'     => '',
                        'siteLogo'            => null,
                        'contactEmail'        => '',
                        'contactPhone'        => '',
                        'contactAddress'      => '',
                        'contactWorkingHours' => 'Senin - Jumat: 09.00 - 17.00 WIB',
                        'contactTitle'        => 'Ayo Bicara!',
                        'contactSubtitle'     => 'Ceritakan kebutuhan digital Anda dan tim kami akan merespons dalam 1x24 jam kerja.',
                        'socialInstagram'     => '',
                        'socialFacebook'      => '',
                        'socialLinkedin'      => '',
                        'navCategories'       => collect(),
                    ]);
            }
        });
    }
}
