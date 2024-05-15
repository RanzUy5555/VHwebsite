<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $observers = [
        \App\Models\Brand::class => [
            \App\Observers\BrandObserver::class
        ],
        \App\Models\Category::class => [
            \App\Observers\CategoryObserver::class
        ],
        \App\Models\Municipality::class => [
            \App\Observers\MunicipalityObserver::class
        ],
        \App\Models\PaymentMethod::class => [
            \App\Observers\PaymentMethodObserver::class
        ],
        \App\Models\Product::class => [
            \App\Observers\ProductObserver::class
        ],
        \App\Models\ProductVariety::class => [
            \App\Observers\ProductVarietyObserver::class
        ],
        \App\Models\Request::class => [
            \App\Observers\RequestObserver::class
        ],
    ];

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}