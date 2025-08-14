<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $cartTotal = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));
            $view->with('cartTotal', $cartTotal);
        });
    }
}
