<?php

namespace App\Observers;

use App\Models\ProductVariety;
use App\Services\ActivityLogsService;

class ProductVarietyObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the ProductVariety "created" event.
     *
     * @param  \App\Models\ProductVariety  $productVariety
     * @return void
     */
    public function created(ProductVariety $productVariety)
    {
        $this->service->log_activity(model:$productVariety, event:'added', model_name:'Product Variety', model_property_name: $productVariety->name);
    }

    /**
     * Handle the ProductVariety "updated" event.
     *
     * @param  \App\Models\ProductVariety  $productVariety
     * @return void
     */
    public function updated(ProductVariety $productVariety)
    {
        $this->service->log_activity(model:$productVariety, event:'updated', model_name:'Product Variety', model_property_name: $productVariety->name);
    }

    /**
     * Handle the ProductVariety "deleted" event.
     *
     * @param  \App\Models\ProductVariety  $productVariety
     * @return void
     */
    public function deleted(ProductVariety $productVariety)
    {
        $this->service->log_activity(model:$productVariety, event:'deleted', model_name:'Product Variety', model_property_name: $productVariety->name);
    }

    /**
     * Handle the ProductVariety "restored" event.
     *
     * @param  \App\Models\ProductVariety  $productVariety
     * @return void
     */
    public function restored(ProductVariety $productVariety)
    {
        //
    }

    /**
     * Handle the ProductVariety "force deleted" event.
     *
     * @param  \App\Models\ProductVariety  $productVariety
     * @return void
     */
    public function forceDeleted(ProductVariety $productVariety)
    {
        //
    }
}