<?php

namespace App\Providers;

use App\Models\Backend\Brand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // View compose
        // View::composer('*', function ($view) {
        //     $brands = Brand::take(6)->orderBy('position', 'asc')->get();

        //     $view->with([
        //         'brands' => $brands,
        //     ]);
        // });

        // $brands = Brand::take(6)->orderBy('position', 'asc')->get();

        // View::share('brands', $brands);
    }
}
