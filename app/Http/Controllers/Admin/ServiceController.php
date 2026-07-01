<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        
        $query = Service::ordered()->latest();
        
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        $services = $query->paginate($perPage)->appends($request->all());
        
        return view('admin.pages.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $serviceData = $validated;
        $serviceData['is_active'] = $request->has('is_active');
        $serviceData['sort_order'] = $request->input('sort_order', 0);

        Service::create($serviceData);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('admin.pages.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $serviceData = $validated;
        $serviceData['is_active'] = $request->has('is_active');
        $serviceData['sort_order'] = $request->input('sort_order', 0);

        $service->update($serviceData);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }

    /**
     * Download Excel template for import.
     */
    public function downloadTemplate()
    {
        $fileName = 'template_import_layanan.xlsx';
        $path = storage_path('app/public/' . $fileName);
        
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($path);
        
        $writer->addRow([
            'title' => 'Layanan Contoh',
            'icon' => 'code',
            'description' => 'Ini adalah deskripsi layanan.',
            'is_active' => '1',
            'sort_order' => '1'
        ]);
        
        $writer->close();
        
        return response()->download($path)->deleteFileAfterSend(true);
    }

    /**
     * Handle Excel file import.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:5120'
        ]);
        
        $file = $request->file('file');
        
        $rows = \Spatie\SimpleExcel\SimpleExcelReader::create($file->getRealPath(), $file->getClientOriginalExtension())
            ->getRows();
            
        $count = 0;
        
        $rows->each(function(array $row) use (&$count) {
            // Skip empty rows or the sample row
            if (empty($row['title']) || $row['title'] === 'Layanan Contoh') {
                return;
            }
            
            \App\Models\Service::create([
                'title' => $row['title'],
                'icon' => $row['icon'] ?? 'design_services',
                'description' => $row['description'] ?? '-',
                'is_active' => isset($row['is_active']) ? (bool)$row['is_active'] : true,
                'sort_order' => isset($row['sort_order']) && is_numeric($row['sort_order']) ? (int)$row['sort_order'] : 0,
            ]);
            
            $count++;
        });
        
        return redirect()->route('admin.services.index')->with('success', "Berhasil mengimpor {$count} layanan baru.");
    }
}
