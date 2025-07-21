<?php

namespace App\Observers;

use App\Models\Productstock;

class Productstockobserver
{
    /**
     * Handle the Productstock "created" event.
     */
    public function created(Productstock $productstock): void
    {
        //
    }

    /**
     * Handle the Productstock "updated" event.
     */
    public function updated(Productstock $productstock): void
    {
        //
    }

    /**
     * Handle the Productstock "deleted" event.
     */
    public function deleted(Productstock $productstock): void
    {
        //
    }

    /**
     * Handle the Productstock "restored" event.
     */
    public function restored(Productstock $productstock): void
    {
        //
    }

    /**
     * Handle the Productstock "force deleted" event.
     */
    public function forceDeleted(Productstock $productstock): void
    {
        //
    }
}
