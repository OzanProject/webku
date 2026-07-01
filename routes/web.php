<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ProcessController;
use App\Http\Controllers\Admin\TestimonialController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Legal & Static Pages
|--------------------------------------------------------------------------
*/
Route::get('/layanan',         [PageController::class, 'layanan'])->name('layanan');
Route::get('/produk',          [PageController::class, 'produk'])->name('produk');
Route::get('/produk/{slug}',   [PageController::class, 'produkDetail'])->name('produk.detail');
Route::get('/portofolio',      [PageController::class, 'portofolio'])->name('portofolio');
Route::get('/about',           [PageController::class, 'about'])->name('about');
Route::get('/contact',         [PageController::class, 'contact'])->name('contact');
Route::post('/contact',        [PageController::class, 'contactSubmit'])->name('contact.submit')->middleware('throttle:5,60');
Route::post('/pesan',          [\App\Http\Controllers\Frontend\OrderController::class, 'store'])->name('order.submit')->middleware('throttle:5,60');
Route::get('/privacy-policy',  [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service',[PageController::class, 'terms'])->name('terms');

/*
|--------------------------------------------------------------------------
| SEO Routes
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');


/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Excel Import & Templates
    Route::get('/products/template', [ProductController::class, 'downloadTemplate'])->name('products.template');
    Route::post('/products/import', [ProductController::class, 'importExcel'])->name('products.import');
    
    Route::get('/services/template', [ServiceController::class, 'downloadTemplate'])->name('services.template');
    Route::post('/services/import', [ServiceController::class, 'importExcel'])->name('services.import');
    
    Route::get('/testimonials/template', [TestimonialController::class, 'downloadTemplate'])->name('testimonials.template');
    Route::post('/testimonials/import', [TestimonialController::class, 'importExcel'])->name('testimonials.import');

    Route::resource('stats', StatController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('products', ProductController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('processes', ProcessController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('portfolios', App\Http\Controllers\Admin\PortfolioController::class);
    Route::post('portfolios/hero', [App\Http\Controllers\Admin\PortfolioController::class, 'updateHero'])->name('portfolios.hero');
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    
    // About Page
    Route::get('/about-page',         [App\Http\Controllers\Admin\AboutController::class, 'index'])->name('about.index');
    Route::post('/about-page',        [App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');

    // Home Page Settings
    Route::get('/home-page',          [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home-page.index');
    Route::post('/home-page',         [App\Http\Controllers\Admin\HomeController::class, 'update'])->name('home-page.update');

    // Legal Pages
    Route::get('/legals',             [App\Http\Controllers\Admin\LegalController::class, 'index'])->name('legals.index');
    Route::post('/legals',            [App\Http\Controllers\Admin\LegalController::class, 'update'])->name('legals.update');

    // Messages
    Route::resource('messages',       App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});


/*
|--------------------------------------------------------------------------
| Breeze Default Routes (Profile)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
