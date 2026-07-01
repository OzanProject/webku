<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Display the legal pages configuration.
     */
    public function index()
    {
        $privacy = Setting::get('legal_privacy_policy', '');
        $terms = Setting::get('legal_terms_of_service', '');

        return view('admin.pages.legals.index', compact('privacy', 'terms'));
    }

    /**
     * Update the legal pages configuration.
     */
    public function update(Request $request)
    {
        // Allowed keys for legal
        $allowedKeys = [
            'legal_privacy_policy',
            'legal_terms_of_service'
        ];

        foreach ($allowedKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.legals.index')->with('success', 'Halaman Legal berhasil diperbarui.');
    }
}
