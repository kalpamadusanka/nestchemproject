<?php

namespace App\Observers;

use App\Models\CanTransaction;

class CanTransactionObserver
{
    /**
     * Handle the CanTransaction "created" event.
     */
    public function created(CanTransaction $canTransaction): void
    {
        //
    }

    /**
     * Handle the CanTransaction "updated" event.
     */
    public function updated(CanTransaction $canTransaction): void
    {
        //
    }

    /**
     * Handle the CanTransaction "deleted" event.
     */
    public function deleted(CanTransaction $canTransaction): void
    {
        //
    }

    /**
     * Handle the CanTransaction "restored" event.
     */
    public function restored(CanTransaction $canTransaction): void
    {
        //
    }

    /**
     * Handle the CanTransaction "force deleted" event.
     */
    public function forceDeleted(CanTransaction $canTransaction): void
    {
        //
    }
}
