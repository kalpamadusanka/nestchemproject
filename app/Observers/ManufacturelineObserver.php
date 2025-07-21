<?php

namespace App\Observers;

use App\Models\Manufactureline;

class ManufacturelineObserver
{
    /**
     * Handle the Manufactureline "created" event.
     */
    public function created(Manufactureline $manufactureline): void
    {
        //
    }

    /**
     * Handle the Manufactureline "updated" event.
     */
    public function updated(Manufactureline $manufactureline): void
    {
        //
    }

    /**
     * Handle the Manufactureline "deleted" event.
     */
    public function deleted(Manufactureline $manufactureline): void
    {
        //
    }

    /**
     * Handle the Manufactureline "restored" event.
     */
    public function restored(Manufactureline $manufactureline): void
    {
        //
    }

    /**
     * Handle the Manufactureline "force deleted" event.
     */
    public function forceDeleted(Manufactureline $manufactureline): void
    {
        //
    }
}
