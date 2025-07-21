<?php

namespace App\Observers;

use App\Models\Materialrequest;

class MaterialrequestObserver
{
    /**
     * Handle the Materialrequest "created" event.
     */
    public function created(Materialrequest $materialrequest): void
    {
        //
    }

    /**
     * Handle the Materialrequest "updated" event.
     */
    public function updated(Materialrequest $materialrequest): void
    {
        //
    }

    /**
     * Handle the Materialrequest "deleted" event.
     */
    public function deleted(Materialrequest $materialrequest): void
    {
        //
    }

    /**
     * Handle the Materialrequest "restored" event.
     */
    public function restored(Materialrequest $materialrequest): void
    {
        //
    }

    /**
     * Handle the Materialrequest "force deleted" event.
     */
    public function forceDeleted(Materialrequest $materialrequest): void
    {
        //
    }
}
