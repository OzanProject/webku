<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Halaman Layanan Kami
     */
    public function layanan()
    {
        $services = \App\Models\Service::active()->ordered()->get();
        return view('frontend.pages.layanan', compact('services'));
    }

    /**
     * Halaman Produk
     */
    public function produk(Request $request)
    {
        $query = \App\Models\Product::active();

        // Pencarian (q)
        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        // Kategori
        $categoryName = 'Semua Kategori';
        if ($request->filled('category') && $request->category !== 'semua') {
            $categoryModel = \App\Models\Category::where('slug', $request->category)->first();
            
            if ($categoryModel) {
                $categoryName = $categoryModel->name;
                $query->whereHas('category', function($q) use ($categoryModel) {
                    $q->where('name', 'like', '%' . $categoryModel->name . '%');
                });
            } else {
                // Fallback for slugs not in database yet
                $searchCat = str_replace('-', ' ', $request->category);
                $categoryName = ucwords($searchCat);
                $query->whereHas('category', function($q) use ($searchCat) {
                    $q->where('name', 'like', '%' . $searchCat . '%');
                });
            }
        }

        // Urutkan (sort)
        if ($request->filled('sort')) {
            if ($request->sort === 'terbaru') {
                $query->orderBy('id', 'desc');
            } elseif ($request->sort === 'terlama') {
                $query->orderBy('id', 'asc');
            } else {
                $query->ordered();
            }
        } else {
            $query->ordered();
        }

        $products = $query->paginate(9)->withQueryString();

        return view('frontend.pages.produk', compact('products', 'categoryName'));
    }

    /**
     * Halaman Detail Produk
     */
    public function produkDetail($slug)
    {
        $product = \App\Models\Product::active()->where('slug', $slug)->firstOrFail();
        
        // Also get related products (e.g. 4 random or latest products excluding current)
        $relatedProducts = \App\Models\Product::active()
                            ->where('id', '!=', $product->id)
                            ->inRandomOrder()
                            ->take(4)
                            ->get();

        return view('frontend.pages.produk-detail', compact('product', 'relatedProducts'));
    }

    /**
     * Halaman Portofolio
     */
    public function portofolio(Request $request)
    {
        $query = \App\Models\Portfolio::query();
        
        if ($request->filled('category')) {
            $catMap = [
                'landing-page' => 'Landing Page',
                'mobile-app' => 'Mobile App',
                'ui-ux-design' => 'UI/UX Design',
                'website' => 'Website',
            ];
            $cat = $catMap[$request->category] ?? str_replace('-', ' ', $request->category);
            $query->where('category', $cat);
        }
        
        $portfolios = $query->latest()->get();
        $portfolio_hero_image = \App\Models\Setting::where('key', 'portfolio_hero_image')->value('value') ?? 'https://khalimzone.com/assets/images/hero-portfolio.png';
        
        // Count for tabs
        $counts = [
            'semua' => \App\Models\Portfolio::count(),
            'landing-page' => \App\Models\Portfolio::where('category', 'Landing Page')->count(),
            'mobile-app' => \App\Models\Portfolio::where('category', 'Mobile App')->count(),
            'ui-ux-design' => \App\Models\Portfolio::where('category', 'UI/UX Design')->count(),
            'website' => \App\Models\Portfolio::where('category', 'Website')->count(),
        ];

        return view('frontend.pages.portofolio', compact('portfolios', 'portfolio_hero_image', 'counts'));
    }

    /**
     * Halaman Privacy Policy.
     */
    public function privacy()
    {
        $content = \App\Models\Setting::get('legal_privacy_policy');
        return view('frontend.pages.privacy-policy', compact('content'));
    }

    /**
     * Halaman Terms of Service.
     */
    public function terms()
    {
        $content = \App\Models\Setting::get('legal_terms_of_service');
        return view('frontend.pages.terms', compact('content'));
    }

    /**
     * Halaman About Us.
     */
    public function about()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('frontend.pages.about', compact('settings'));
    }

    /**
     * Halaman Contact (GET).
     */
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    /**
     * Proses form Contact (POST).
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min'      => 'Pesan minimal 10 karakter.',
        ]);

        // Honeypot check for bots
        if (!empty($request->input('website_url'))) {
            // Silently reject if honeypot is filled
            return redirect()->route('contact')
                ->with('success', 'Pesan Anda berhasil terkirim! Kami akan menghubungi Anda segera.');
        }

        ContactSubmission::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'subject'    => $validated['subject'] ?? null,
            'message'    => $validated['message'],
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('contact')
            ->with('success', 'Pesan Anda berhasil terkirim! Kami akan menghubungi Anda segera.');
    }
}
