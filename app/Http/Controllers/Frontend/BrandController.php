<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BrandController extends Controller
{
    public function __construct()
    {
        View::composer('*', function ($view) {
            $brands = Brand::take(6)->orderBy('position', 'asc')->get();

            $view->with([
                'brands' => $brands,
            ]);
        });
    }
}
