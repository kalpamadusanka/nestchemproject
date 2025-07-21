<?php

namespace App\Observers;

use App\Models\ShelfData;

class Shelfdataobserver
{
    /**
     * Handle the ShelfData "created" event.
     */
    public function created(ShelfData $shelfData): void
    {
        //
    }

    /**
     * Handle the ShelfData "updated" event.
     */
    public function updated(ShelfData $shelfData): void
    {
        //
    }

    /**
     * Handle the ShelfData "deleted" event.
     */
    public function deleted(ShelfData $shelfData): void
    {
        //
    }

    /**
     * Handle the ShelfData "restored" event.
     */
    public function restored(ShelfData $shelfData): void
    {
        //
    }

    /**
     * Handle the ShelfData "force deleted" event.
     */
    public function forceDeleted(ShelfData $shelfData): void
    {
        //
    }
}
