<?php

namespace App\Http\Controllers\Main;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class PageController extends Controller
{
    public function home()
    {
        return view('main.pages.home', [
            // 'products' => Product::with('media')->latest()->take(12)->get(),
            // 'services' => Service::with('media')->latest()->get(),
        ]);
    }

    public function about()
    {
        return view('main.pages.about');
    }

    
    public function services()
    {
        return view('main.pages.services', [
            'services' => Service::with('media')->get(),
        ]);
    }
}