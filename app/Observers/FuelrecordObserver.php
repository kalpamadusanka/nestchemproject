<?php

namespace App\Observers;

use App\Models\Fuelrecord;

class FuelrecordObserver
{
    /**
     * Handle the Fuelrecord "created" event.
     */
    public function created(Fuelrecord $fuelrecord): void
    {
        //
    }

    /**
     * Handle the Fuelrecord "updated" event.
     */
    public function updated(Fuelrecord $fuelrecord): void
    {
        //
    }

    /**
     * Handle the Fuelrecord "deleted" event.
     */
    public function deleted(Fuelrecord $fuelrecord): void
    {
        //
    }

    /**
     * Handle the Fuelrecord "restored" event.
     */
    public function restored(Fuelrecord $fuelrecord): void
    {
        //
    }

    /**
     * Handle the Fuelrecord "force deleted" event.
     */
    public function forceDeleted(Fuelrecord $fuelrecord): void
    {
        //
    }
}
