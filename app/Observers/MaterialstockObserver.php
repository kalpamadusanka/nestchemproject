<?php

namespace App\Observers;

use App\Models\Materialstock;

class MaterialstockObserver
{
    /**
     * Handle the Materialstock "created" event.
     */
    public function created(Materialstock $materialstock): void
    {
        //
    }

    /**
     * Handle the Materialstock "updated" event.
     */
    public function updated(Materialstock $materialstock): void
    {
        //
    }

    /**
     * Handle the Materialstock "deleted" event.
     */
    public function deleted(Materialstock $materialstock): void
    {
        //
    }

    /**
     * Handle the Materialstock "restored" event.
     */
    public function restored(Materialstock $materialstock): void
    {
        //
    }

    /**
     * Handle the Materialstock "force deleted" event.
     */
    public function forceDeleted(Materialstock $materialstock): void
    {
        //
    }
}
