<?php

namespace App\Observers;

use App\Models\Municipality;
use App\Services\ActivityLogsService;

class MunicipalityObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the Municipality "created" event.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return void
     */
    public function created(Municipality $municipality)
    {
        $this->service->log_activity(model:$municipality, event:'added', model_name:'Municipality', model_property_name: $municipality->name);
    }

    /**
     * Handle the Municipality "updated" event.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return void
     */
    public function updated(Municipality $municipality)
    {
        $this->service->log_activity(model:$municipality, event:'updated', model_name:'Municipality', model_property_name: $municipality->name);
    }

    /**
     * Handle the Municipality "deleted" event.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return void
     */
    public function deleted(Municipality $municipality)
    {
        $this->service->log_activity(model:$municipality, event:'deleted', model_name:'Municipality', model_property_name: $municipality->name);
    }

    /**
     * Handle the Municipality "restored" event.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return void
     */
    public function restored(Municipality $municipality)
    {
        //
    }

    /**
     * Handle the Municipality "force deleted" event.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return void
     */
    public function forceDeleted(Municipality $municipality)
    {
        //
    }
}