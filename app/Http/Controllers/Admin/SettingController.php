<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        // Load all settings into an associative array for easy access in view
        $settings = Setting::pluck('value', 'key')->toArray();
        
        return view('admin.pages.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        // Define which keys we expect to save (to prevent mass assignment vulnerability)
        $allowedKeys = [
            'site_title',
            'site_description',
            'contact_email',
            'contact_phone',
            'contact_address',
            'contact_title',
            'contact_subtitle',
            'contact_working_hours',
            'social_instagram',
            'social_facebook',
            'social_linkedin',
            'tinymce_api_key',
            'google_analytics_id',
        ];

        // Loop through allowed keys and update/create in database
        foreach ($allowedKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        // Handle Logo Upload
        if ($request->hasFile('site_logo')) {
            $request->validate([
                'site_logo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            $file = $request->file('site_logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Store in storage/app/public/settings
            $path = $file->storeAs('settings', $filename, 'public');
            
            // Generate public URL
            $url = Storage::url($path);

            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $url]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
