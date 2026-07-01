<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = \App\Models\Feature::ordered()->get();
        return view('admin.pages.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon'        => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order'  => 'required|integer',
        ]);

        \App\Models\Feature::create($validated);

        return redirect()->route('admin.features.index')
                         ->with('success', 'Keunggulan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feature = \App\Models\Feature::findOrFail($id);
        return view('admin.pages.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature = \App\Models\Feature::findOrFail($id);

        $validated = $request->validate([
            'icon'        => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order'  => 'required|integer',
        ]);

        $feature->update($validated);

        return redirect()->route('admin.features.index')
                         ->with('success', 'Keunggulan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = \App\Models\Feature::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.features.index')
                         ->with('success', 'Keunggulan berhasil dihapus.');
    }
}
