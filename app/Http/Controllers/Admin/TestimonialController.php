<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        
        $query = Testimonial::ordered()->latest();
        
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('position', 'like', '%' . $search . '%')
                  ->orWhere('quote', 'like', '%' . $search . '%');
            });
        }
        
        $testimonials = $query->paginate($perPage)->appends($request->all());
        
        return view('admin.pages.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $testimonialData = $validated;
        $testimonialData['is_active'] = $request->has('is_active');
        $testimonialData['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('avatar')) {
            $testimonialData['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($testimonialData);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.pages.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $testimonialData = $validated;
        $testimonialData['is_active'] = $request->has('is_active');
        $testimonialData['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $testimonialData['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update($testimonialData);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        // Delete avatar if exists
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }
        
        $testimonial->delete();
        
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    /**
     * Download Excel template for import.
     */
    public function downloadTemplate()
    {
        $fileName = 'template_import_testimoni.xlsx';
        $path = storage_path('app/public/' . $fileName);
        
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($path);
        
        $writer->addRow([
            'name' => 'Klien Contoh',
            'position' => 'CEO Perusahaan',
            'quote' => 'Pelayanan sangat luar biasa dan profesional.',
            'rating' => '5',
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
            if (empty($row['name']) || $row['name'] === 'Klien Contoh') {
                return;
            }
            
            \App\Models\Testimonial::create([
                'name' => $row['name'],
                'position' => $row['position'] ?? null,
                'quote' => $row['quote'] ?? '-',
                'rating' => isset($row['rating']) && is_numeric($row['rating']) ? (int)$row['rating'] : 5,
                'is_active' => isset($row['is_active']) ? (bool)$row['is_active'] : true,
                'sort_order' => isset($row['sort_order']) && is_numeric($row['sort_order']) ? (int)$row['sort_order'] : 0,
            ]);
            
            $count++;
        });
        
        return redirect()->route('admin.testimonials.index')->with('success', "Berhasil mengimpor {$count} testimoni baru.");
    }
}
