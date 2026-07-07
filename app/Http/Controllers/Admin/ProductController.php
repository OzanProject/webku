<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);
        
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        
        $query = Product::ordered()->latest();
        
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('category_label', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        $products = $query->paginate($perPage)->appends($request->all());
        
        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        
        $categories = \App\Models\Category::active()->get();
        return view('admin.pages.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_label' => 'required|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'demo_link' => 'nullable|url',
            'features' => 'nullable|array',
            'version' => 'nullable|string|max:50',
            'release_date' => 'nullable|date',
        ]);

        $productData = $validated;
        $productData['slug'] = Str::slug($validated['title']);
        $productData['is_active'] = $request->has('is_active');
        $productData['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $productData['image'] = $path;
        }

        Product::create($productData);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);
        
        $categories = \App\Models\Category::active()->get();
        return view('admin.pages.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_label' => 'required|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'demo_link' => 'nullable|url',
            'features' => 'nullable|array',
            'version' => 'nullable|string|max:50',
            'release_date' => 'nullable|date',
        ]);

        $productData = $validated;
        
        // Only update slug if title changed significantly (optional, but good practice)
        if ($product->title !== $validated['title']) {
            $productData['slug'] = Str::slug($validated['title']);
        }
        
        $productData['is_active'] = $request->has('is_active');
        $productData['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $path = $request->file('image')->store('products', 'public');
            $productData['image'] = $path;
        }

        $product->update($productData);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Download Excel template for import.
     */
    public function downloadTemplate()
    {
        $this->authorize('create', Product::class);
        
        $fileName = 'template_import_produk.xlsx';
        $path = storage_path('app/public/' . $fileName);
        
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($path);
        
        $writer->addRow([
            'title' => 'Produk Contoh',
            'category_label' => 'Template',
            'price' => '150000',
            'description' => 'Ini adalah deskripsi singkat produk.',
            'content' => 'Ini adalah detail konten HTML produk.',
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
        $this->authorize('create', Product::class);
        
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:5120'
        ]);
        
        $file = $request->file('file');
        
        $rows = \Spatie\SimpleExcel\SimpleExcelReader::create($file->getRealPath(), $file->getClientOriginalExtension())
            ->getRows();
            
        $count = 0;
        
        $rows->each(function(array $row) use (&$count) {
            // Skip empty rows or the sample row
            if (empty($row['title']) || $row['title'] === 'Produk Contoh') {
                return;
            }
            
            Product::create([
                'title' => $row['title'],
                'slug' => Str::slug($row['title']),
                'category_label' => $row['category_label'] ?? 'General',
                'price' => isset($row['price']) && is_numeric($row['price']) ? (float)$row['price'] : 0,
                'description' => $row['description'] ?? '-',
                'content' => $row['content'] ?? null,
                'is_active' => isset($row['is_active']) ? (bool)$row['is_active'] : true,
                'sort_order' => isset($row['sort_order']) && is_numeric($row['sort_order']) ? (int)$row['sort_order'] : 0,
            ]);
            
            $count++;
        });
        
        return redirect()->route('admin.products.index')->with('success', "Berhasil mengimpor {$count} produk baru.");
    }
}
