<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartRequest;
use App\Models\Municipality;

class CartController extends Controller
{
    public function index()
    {
        return view('user.cart.index', [
            'carts' => Cart::with('product.media')->whereBelongsTo(auth()->user())->get(),
            'municipalities' => Municipality::all(),
            'payment_methods' => PaymentMethod::all(),
        ]);
    }

    public function store(CartRequest $request)
    {
        // check if the product is already added to cart 
        // if it does, increment the cart qty 
        
         $check_cart = Cart::query()
        ->when($request->filled('product_id'), fn($query) => $query->where('product_id', $request->product_id))
        ->when($request->filled('product_variety_id'), fn($query) => $query->where('product_variety_id', $request->product_variety_id))
        ->where('user_id', auth()->id())
        ->first(); 

        if($check_cart)
        {
            $check_cart->increment('qty', $request->qty);
            
            return to_route('main.products.index')->with(['success' => 'As the product is already in your cart, we proceed to augment the quantity of the item.']);

            //return back()->with('error', 'Product has already been added to cart. Please select another one');
        }
           
        auth()->user()->carts()->create($request->validated());
    
        return to_route('main.products.index')->with(['success' => 'Product has been added to your cart']);
        
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return $this->res(['success' => 'Product Removed Successfully']);
    }
}