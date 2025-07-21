<?php

namespace App\Observers;

use App\Models\Dofinalize;

class DofinalizeObserver
{
    /**
     * Handle the Dofinalize "created" event.
     */
    public function created(Dofinalize $dofinalize): void
    {
        //
    }

    /**
     * Handle the Dofinalize "updated" event.
     */
    public function updated(Dofinalize $dofinalize): void
    {
        //
    }

    /**
     * Handle the Dofinalize "deleted" event.
     */
    public function deleted(Dofinalize $dofinalize): void
    {
        //
    }

    /**
     * Handle the Dofinalize "restored" event.
     */
    public function restored(Dofinalize $dofinalize): void
    {
        //
    }

    /**
     * Handle the Dofinalize "force deleted" event.
     */
    public function forceDeleted(Dofinalize $dofinalize): void
    {
        //
    }
}
