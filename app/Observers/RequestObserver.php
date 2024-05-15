<?php

namespace App\Observers;

use App\Models\Request;
use App\Services\ActivityLogsService;

class RequestObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the Request "created" event.
     *
     * @param  \App\Models\Request  $request
     * @return void
     */
    public function created(Request $request)
    {
        $this->service->log_activity(model:$request, event:'requested', model_name:'Quotation', model_property_name: $request->user->full_name);
    }

    /**
     * Handle the Request "updated" event.
     *
     * @param  \App\Models\Request  $request
     * @return void
     */
    public function updated(Request $request)
    {
        $this->service->log_activity(model:$request, event:'updated', model_name:'Quotation', model_property_name: $request->user->full_name);
    }

    /**
     * Handle the Request "deleted" event.
     *
     * @param  \App\Models\Request  $request
     * @return void
     */
    public function deleted(Request $request)
    {
        $this->service->log_activity(model:$request, event:'deleted', model_name:'Quotation', model_property_name: $request->user->full_name);
    }

    /**
     * Handle the Request "restored" event.
     *
     * @param  \App\Models\Request  $request
     * @return void
     */
    public function restored(Request $request)
    {
        //
    }

    /**
     * Handle the Request "force deleted" event.
     *
     * @param  \App\Models\Request  $request
     * @return void
     */
    public function forceDeleted(Request $request)
    {
        //
    }
}