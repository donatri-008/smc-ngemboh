<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, ArticleController, EnvironmentController,
    DemographicController, ShopController, CheckoutController, AboutController, ProgramController};

// PUBLIK — tanpa login
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(ArticleController::class)->prefix('artikel')->group(function () {
    Route::get('/', 'index')->name('articles.index');
    Route::get('/{article}', 'show')->name('articles.show');
});

Route::controller(ProgramController::class)->prefix('program')->group(function () {
    Route::get('/{program}', 'show')->name('program.show');
});

Route::get('/info-lingkungan', [EnvironmentController::class, 'index'])->name('environment.index');
Route::get('/demografi-nelayan', [DemographicController::class, 'index'])->name('demographic.index');

Route::controller(ShopController::class)->prefix('belanja')->group(function () {
    Route::get('/', 'index')->name('shop.index');
    Route::post('/cart/add/{product}', 'addToCart')->name('cart.add');
    Route::get('/cart', 'cart')->name('cart.index');
    Route::patch('/cart/update/{product}', 'updateQuantity')->name('cart.update');
    Route::delete('/cart/remove/{product}', 'removeFromCart')->name('cart.remove');
    Route::get('/{product}', 'show')->name('shop.show');
});
Route::post('/checkout', [CheckoutController::class, 'redirectToWhatsapp'])->name('checkout');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about.index');

// ADMIN — wajib login
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\DashboardOverview::class)->name('dashboard');
    Route::get('/artikel', \App\Livewire\Admin\ArticleManager::class)->name('articles');
    Route::get('/belanja', \App\Livewire\Admin\ProductManager::class)->name('products');
    Route::get('/demografi-nelayan', \App\Livewire\Admin\DemographicManager::class)->name('demographics');
    Route::get('/info-lingkungan', \App\Livewire\Admin\EnvironmentManager::class)->name('environment');
    Route::get('/statistik', \App\Livewire\Admin\StatisticManager::class)->name('statistics');
    Route::get('/legalitas', \App\Livewire\Admin\LegalityManager::class)->name('legalities');
    Route::get('/profil-tim', \App\Livewire\Admin\TeamManager::class)->name('team');
    Route::get('/mitra', \App\Livewire\Admin\PartnerManager::class)->name('partners');
    Route::get('/program', \App\Livewire\Admin\ProgramManager::class)->name('programs');
});

require __DIR__.'/auth.php';
