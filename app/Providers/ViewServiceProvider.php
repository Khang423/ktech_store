<?php

namespace App\Providers;

use App\Models\CategoryProduct;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $categories = CategoryProduct::get();
            $view->with('categories', $categories);
        });
    }
}
