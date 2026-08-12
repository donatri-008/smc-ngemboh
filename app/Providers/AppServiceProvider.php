<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));

        View::composer('partials.navbar', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = collect($cart)->sum('qty');

            $view->with('cartCount', $cartCount);
        });
    }
}