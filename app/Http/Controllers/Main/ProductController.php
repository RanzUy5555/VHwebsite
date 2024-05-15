<?php

namespace App\Http\Controllers\Main;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
        ->when($request->filled('category'), fn($query) => $query->where('id', $request->category))
        ->has('products')
        ->with(['products' => fn($query) => $query->with('media')->where('is_available', true)])
        ->orderBy('name', 'ASC')
        ->get();

        return view('main.product.index', [
            'categories' => $categories
        ]);
    }

    public function show(Product $product)
    {
        return view('main.product.show', [
            'product' => $product->load('media', 'category'),
            'related_products' => Product::whereBelongsTo($product->category)
            ->with('media')
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(3)
            ->get(),
        ]);
    }
}