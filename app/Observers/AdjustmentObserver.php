<?php

namespace App\Observers;

use App\Models\Adjustmenttype;

class AdjustmentObserver
{
    /**
     * Handle the Adjustmenttype "created" event.
     */
    public function created(Adjustmenttype $adjustmenttype): void
    {
        //
    }

    /**
     * Handle the Adjustmenttype "updated" event.
     */
    public function updated(Adjustmenttype $adjustmenttype): void
    {
        //
    }

    /**
     * Handle the Adjustmenttype "deleted" event.
     */
    public function deleted(Adjustmenttype $adjustmenttype): void
    {
        //
    }

    /**
     * Handle the Adjustmenttype "restored" event.
     */
    public function restored(Adjustmenttype $adjustmenttype): void
    {
        //
    }

    /**
     * Handle the Adjustmenttype "force deleted" event.
     */
    public function forceDeleted(Adjustmenttype $adjustmenttype): void
    {
        //
    }
}
