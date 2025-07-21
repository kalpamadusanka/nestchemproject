<?php

namespace App\Observers;

use App\Models\Poitems;

class PoitemsObserver
{
    /**
     * Handle the Poitems "created" event.
     */
    public function created(Poitems $poitems): void
    {
        //
    }

    /**
     * Handle the Poitems "updated" event.
     */
    public function updated(Poitems $poitems): void
    {
        //
    }

    /**
     * Handle the Poitems "deleted" event.
     */
    public function deleted(Poitems $poitems): void
    {
        //
    }

    /**
     * Handle the Poitems "restored" event.
     */
    public function restored(Poitems $poitems): void
    {
        //
    }

    /**
     * Handle the Poitems "force deleted" event.
     */
    public function forceDeleted(Poitems $poitems): void
    {
        //
    }
}
