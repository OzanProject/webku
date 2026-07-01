<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page configuration.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.pages.about.index', compact('settings'));
    }

    /**
     * Update the about page configuration.
     */
    public function update(Request $request)
    {
        // Allowed keys for about page
        $allowedKeys = [
            'about_hero_title',
            'about_hero_subtitle',
            'about_story_title',
            'about_story_content',
            'about_stat_1_value',
            'about_stat_1_label',
            'about_stat_2_value',
            'about_stat_2_label',
            'about_stat_3_value',
            'about_stat_3_label',
            'about_stat_4_value',
            'about_stat_4_label',
            'about_cta_title',
            'about_cta_subtitle',
        ];

        foreach ($allowedKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.about.index')->with('success', 'Halaman About berhasil diperbarui.');
    }
}
