<?php

namespace App\Observers;

use App\Models\Saledispatch;

class SaledispatchObserver
{
    /**
     * Handle the Saledispatch "created" event.
     */
    public function created(Saledispatch $saledispatch): void
    {
        //
    }

    /**
     * Handle the Saledispatch "updated" event.
     */
    public function updated(Saledispatch $saledispatch): void
    {
        //
    }

    /**
     * Handle the Saledispatch "deleted" event.
     */
    public function deleted(Saledispatch $saledispatch): void
    {
        //
    }

    /**
     * Handle the Saledispatch "restored" event.
     */
    public function restored(Saledispatch $saledispatch): void
    {
        //
    }

    /**
     * Handle the Saledispatch "force deleted" event.
     */
    public function forceDeleted(Saledispatch $saledispatch): void
    {
        //
    }
}
