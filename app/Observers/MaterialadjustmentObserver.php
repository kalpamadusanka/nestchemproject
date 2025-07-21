<?php

namespace App\Observers;

use App\Models\Materialadjustment;

class MaterialadjustmentObserver
{
    /**
     * Handle the Materialadjustment "created" event.
     */
    public function created(Materialadjustment $materialadjustment): void
    {
        //
    }

    /**
     * Handle the Materialadjustment "updated" event.
     */
    public function updated(Materialadjustment $materialadjustment): void
    {
        //
    }

    /**
     * Handle the Materialadjustment "deleted" event.
     */
    public function deleted(Materialadjustment $materialadjustment): void
    {
        //
    }

    /**
     * Handle the Materialadjustment "restored" event.
     */
    public function restored(Materialadjustment $materialadjustment): void
    {
        //
    }

    /**
     * Handle the Materialadjustment "force deleted" event.
     */
    public function forceDeleted(Materialadjustment $materialadjustment): void
    {
        //
    }
}
