<?php

namespace App\Observers;

use App\Models\Shelf;

class Shelfobserver
{
    /**
     * Handle the Shelf "created" event.
     */
    public function created(Shelf $shelf): void
    {
        //
    }

    /**
     * Handle the Shelf "updated" event.
     */
    public function updated(Shelf $shelf): void
    {
        //
    }

    /**
     * Handle the Shelf "deleted" event.
     */
    public function deleted(Shelf $shelf): void
    {
        //
    }

    /**
     * Handle the Shelf "restored" event.
     */
    public function restored(Shelf $shelf): void
    {
        //
    }

    /**
     * Handle the Shelf "force deleted" event.
     */
    public function forceDeleted(Shelf $shelf): void
    {
        //
    }
}
