<?php

namespace App\Observers;

use App\Models\Loadingproduct;

class LoadingproductObserver
{
    /**
     * Handle the Loadingproduct "created" event.
     */
    public function created(Loadingproduct $loadingproduct): void
    {
        //
    }

    /**
     * Handle the Loadingproduct "updated" event.
     */
    public function updated(Loadingproduct $loadingproduct): void
    {
        //
    }

    /**
     * Handle the Loadingproduct "deleted" event.
     */
    public function deleted(Loadingproduct $loadingproduct): void
    {
        //
    }

    /**
     * Handle the Loadingproduct "restored" event.
     */
    public function restored(Loadingproduct $loadingproduct): void
    {
        //
    }

    /**
     * Handle the Loadingproduct "force deleted" event.
     */
    public function forceDeleted(Loadingproduct $loadingproduct): void
    {
        //
    }
}
