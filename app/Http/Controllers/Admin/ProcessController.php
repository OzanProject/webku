<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $processes = \App\Models\Process::ordered()->get();
        return view('admin.pages.processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.processes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'step_number' => 'required|integer',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order'  => 'required|integer',
        ]);

        \App\Models\Process::create($validated);

        return redirect()->route('admin.processes.index')
                         ->with('success', 'Proses Kerja berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $process = \App\Models\Process::findOrFail($id);
        return view('admin.pages.processes.edit', compact('process'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $process = \App\Models\Process::findOrFail($id);

        $validated = $request->validate([
            'step_number' => 'required|integer',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order'  => 'required|integer',
        ]);

        $process->update($validated);

        return redirect()->route('admin.processes.index')
                         ->with('success', 'Proses Kerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $process = \App\Models\Process::findOrFail($id);
        $process->delete();

        return redirect()->route('admin.processes.index')
                         ->with('success', 'Proses Kerja berhasil dihapus.');
    }
}
