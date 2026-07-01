<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dan serve sitemap.xml secara dinamis.
     * Tambahkan halaman baru ke array $pages saat project berkembang.
     */
    public function index(): Response
    {
        $pages = [
            [
                'url'        => route('home'),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'daily',
                'priority'   => '1.0',
            ],
            [
                'url'        => route('produk'),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'daily',
                'priority'   => '0.9',
            ],
            [
                'url'        => route('layanan'),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'weekly',
                'priority'   => '0.8',
            ],
            [
                'url'        => route('portofolio'),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'weekly',
                'priority'   => '0.8',
            ],
            [
                'url'        => route('about'),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'monthly',
                'priority'   => '0.8',
            ],
            [
                'url'        => route('contact'),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'monthly',
                'priority'   => '0.7',
            ],
            [
                'url'        => route('privacy'),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'yearly',
                'priority'   => '0.3',
            ],
            [
                'url'        => route('terms'),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'yearly',
                'priority'   => '0.3',
            ],
        ];

        // Tambahkan halaman produk dinamis
        $products = \App\Models\Product::active()->get();
        foreach ($products as $product) {
            $pages[] = [
                'url'        => route('produk.detail', $product->slug),
                'lastmod'    => $product->updated_at->toDateString(),
                'changefreq' => 'weekly',
                'priority'   => '0.9',
            ];
        }

        $content = view('frontend.sitemap', compact('pages'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
