<?php

namespace App\Observers;

use App\Models\Doexpenses;

class DoexpensesObserver
{
    /**
     * Handle the Doexpenses "created" event.
     */
    public function created(Doexpenses $doexpenses): void
    {
        //
    }

    /**
     * Handle the Doexpenses "updated" event.
     */
    public function updated(Doexpenses $doexpenses): void
    {
        //
    }

    /**
     * Handle the Doexpenses "deleted" event.
     */
    public function deleted(Doexpenses $doexpenses): void
    {
        //
    }

    /**
     * Handle the Doexpenses "restored" event.
     */
    public function restored(Doexpenses $doexpenses): void
    {
        //
    }

    /**
     * Handle the Doexpenses "force deleted" event.
     */
    public function forceDeleted(Doexpenses $doexpenses): void
    {
        //
    }
}
