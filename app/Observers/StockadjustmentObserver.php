<?php

namespace App\Observers;

use App\Models\Stockadjustment;

class StockadjustmentObserver
{
    /**
     * Handle the Stockadjustment "created" event.
     */
    public function created(Stockadjustment $stockadjustment): void
    {
        //
    }

    /**
     * Handle the Stockadjustment "updated" event.
     */
    public function updated(Stockadjustment $stockadjustment): void
    {
        //
    }

    /**
     * Handle the Stockadjustment "deleted" event.
     */
    public function deleted(Stockadjustment $stockadjustment): void
    {
        //
    }

    /**
     * Handle the Stockadjustment "restored" event.
     */
    public function restored(Stockadjustment $stockadjustment): void
    {
        //
    }

    /**
     * Handle the Stockadjustment "force deleted" event.
     */
    public function forceDeleted(Stockadjustment $stockadjustment): void
    {
        //
    }
}
