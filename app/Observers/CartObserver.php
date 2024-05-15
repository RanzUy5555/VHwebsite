<?php

namespace App\Observers;

use App\Models\Cart;
use App\Services\ActivityLogsService;

class CartObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the Cart "created" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function created(Cart $cart)
    {
        $this->service->log_activity(model:$cart, event:'added', model_name:'Product in Cart', model_property_name: $cart->product->name ?? $cart->product_variety->name);
    }

    /**
     * Handle the Cart "updated" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function updated(Cart $cart)
    {
        $this->service->log_activity(model:$cart, event:'updated', model_name:'Product in Cart', model_property_name: $cart->product->name ?? $cart->product_variety->name);
    }

    /**
     * Handle the Cart "deleted" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function deleted(Cart $cart)
    {
        $this->service->log_activity(model:$cart, event:'deleted', model_name:'Product in Cart', model_property_name: $cart->product->name ?? $cart->product_variety->name);
    }

    /**
     * Handle the Cart "restored" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function restored(Cart $cart)
    {
        //
    }

    /**
     * Handle the Cart "force deleted" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function forceDeleted(Cart $cart)
    {
        //
    }
}