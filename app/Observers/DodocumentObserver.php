<?php

namespace App\Observers;

use App\Models\Dodocument;

class DodocumentObserver
{
    /**
     * Handle the Dodocument "created" event.
     */
    public function created(Dodocument $dodocument): void
    {
        //
    }

    /**
     * Handle the Dodocument "updated" event.
     */
    public function updated(Dodocument $dodocument): void
    {
        //
    }

    /**
     * Handle the Dodocument "deleted" event.
     */
    public function deleted(Dodocument $dodocument): void
    {
        //
    }

    /**
     * Handle the Dodocument "restored" event.
     */
    public function restored(Dodocument $dodocument): void
    {
        //
    }

    /**
     * Handle the Dodocument "force deleted" event.
     */
    public function forceDeleted(Dodocument $dodocument): void
    {
        //
    }
}
