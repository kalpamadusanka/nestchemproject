<?php

namespace App\Observers;

use App\Models\Momaterial;

class MomaterialObserver
{
    /**
     * Handle the Momaterial "created" event.
     */
    public function created(Momaterial $momaterial): void
    {
        //
    }

    /**
     * Handle the Momaterial "updated" event.
     */
    public function updated(Momaterial $momaterial): void
    {
        //
    }

    /**
     * Handle the Momaterial "deleted" event.
     */
    public function deleted(Momaterial $momaterial): void
    {
        //
    }

    /**
     * Handle the Momaterial "restored" event.
     */
    public function restored(Momaterial $momaterial): void
    {
        //
    }

    /**
     * Handle the Momaterial "force deleted" event.
     */
    public function forceDeleted(Momaterial $momaterial): void
    {
        //
    }
}
