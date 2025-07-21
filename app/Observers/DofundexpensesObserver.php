<?php

namespace App\Observers;

use App\Models\Dofundespenses;

class DofundexpensesObserver
{
    /**
     * Handle the Dofundespenses "created" event.
     */
    public function created(Dofundespenses $dofundespenses): void
    {
        //
    }

    /**
     * Handle the Dofundespenses "updated" event.
     */
    public function updated(Dofundespenses $dofundespenses): void
    {
        //
    }

    /**
     * Handle the Dofundespenses "deleted" event.
     */
    public function deleted(Dofundespenses $dofundespenses): void
    {
        //
    }

    /**
     * Handle the Dofundespenses "restored" event.
     */
    public function restored(Dofundespenses $dofundespenses): void
    {
        //
    }

    /**
     * Handle the Dofundespenses "force deleted" event.
     */
    public function forceDeleted(Dofundespenses $dofundespenses): void
    {
        //
    }
}
