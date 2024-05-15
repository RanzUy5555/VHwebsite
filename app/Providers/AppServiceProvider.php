<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Request;
use App\Models\Service;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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

        view()->composer('*', function ($view) 
        {
            $user = Auth::user();

            if ( $user && $user->hasRole('admin')) 
            {
                $view->with('pending_request_notifications', Request::with('user', 'service')->pending()->get());
                $view->with('order_count', Order::where('status', Order::PENDING)
                ->groupBy('product_id')
                ->count());
                // $view->with('average_products', Product::whereBetween('qty', [11,20])->get());
                // $view->with('scarcity_products', Product::whereBetween('qty', [0,10])->get());
            } 
            
            if ( $user && $user->hasRole('user')) 
            {
                $view->with('cart_count', Cart::whereBelongsTo($user)->count());
                $view->with('order_count', Order::pending()->whereBelongsTo($user)->count());
            } 


            $view->with('available_services', Service::with('media')->latest()->get());


        });
            
        
    }
}