<?php

namespace App\Observers;

use App\Models\Unloadingproduct;

class UnloadingObserver
{
    /**
     * Handle the Unloadingproduct "created" event.
     */
    public function created(Unloadingproduct $unloadingproduct): void
    {
        //
    }

    /**
     * Handle the Unloadingproduct "updated" event.
     */
    public function updated(Unloadingproduct $unloadingproduct): void
    {
        //
    }

    /**
     * Handle the Unloadingproduct "deleted" event.
     */
    public function deleted(Unloadingproduct $unloadingproduct): void
    {
        //
    }

    /**
     * Handle the Unloadingproduct "restored" event.
     */
    public function restored(Unloadingproduct $unloadingproduct): void
    {
        //
    }

    /**
     * Handle the Unloadingproduct "force deleted" event.
     */
    public function forceDeleted(Unloadingproduct $unloadingproduct): void
    {
        //
    }
}
