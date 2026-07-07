<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display the home page configuration.
     */
    public function index()
    {
        $settings = array_merge(
            Setting::group('hero'),
            Setting::group('why_us'),
            Setting::group('cta'),
            Setting::group('home_sections')
        );

        return view('admin.pages.home.index', compact('settings'));
    }

    /**
     * Update the home page configuration.
     */
    public function update(Request $request)
    {
        // Define fields mapping to their respective groups
        $fields = [
            // Hero Group
            'hero_trust_badge' => 'hero',
            'hero_title' => 'hero',
            'hero_subtitle' => 'hero',
            
            // Why Us Group
            'why_us_title' => 'why_us',
            'why_us_subtitle' => 'why_us',
            
            // CTA Group
            'cta_title' => 'cta',
            'cta_subtitle' => 'cta',
            'cta_button_text' => 'cta',
            'cta_button_link' => 'cta',

            // Home Sections Group
            'process_title' => 'home_sections',
            'process_subtitle' => 'home_sections',
            'category_label' => 'home_sections',
            'category_title' => 'home_sections',
            'product_title' => 'home_sections',
            'product_subtitle' => 'home_sections',
            'testimonial_title' => 'home_sections',
            'testimonial_subtitle' => 'home_sections',
        ];

        foreach ($fields as $key => $group) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key), 'group' => $group]
                );
            }
        }

        // Handle Image Uploads for Hero
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $path = $file->store('settings', 'public');
            $url = Storage::url($path);

            Setting::updateOrCreate(
                ['key' => 'hero_image_url'],
                ['value' => $url, 'group' => 'hero']
            );
        }

        return redirect()->route('admin.home-page.index')->with('success', 'Pengaturan Beranda berhasil diperbarui.');
    }
}
