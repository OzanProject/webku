<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman depan (landing page).
     */
    public function index()
    {
        return view('frontend.pages.home', [
            'hero'         => \App\Models\Setting::group('hero'),
            'stats'        => \App\Models\Stat::ordered()->get(),
            'services'     => \App\Models\Service::active()->ordered()->get(),
            'products'     => \App\Models\Product::active()->ordered()->take(6)->get(),
            'features'     => \App\Models\Feature::ordered()->get(),
            'processes'    => \App\Models\Process::ordered()->get(),
            'testimonials' => \App\Models\Testimonial::active()->ordered()->get(),
            'cta'          => \App\Models\Setting::group('cta'),
            'whyUs'        => \App\Models\Setting::group('why_us'),
        ]);
    }
}
