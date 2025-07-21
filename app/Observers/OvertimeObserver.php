<?php

namespace App\Observers;

use App\Models\Overtimecategory;

class OvertimeObserver
{
    /**
     * Handle the Overtimecategory "created" event.
     */
    public function created(Overtimecategory $overtimecategory): void
    {
        //
    }

    /**
     * Handle the Overtimecategory "updated" event.
     */
    public function updated(Overtimecategory $overtimecategory): void
    {
        //
    }

    /**
     * Handle the Overtimecategory "deleted" event.
     */
    public function deleted(Overtimecategory $overtimecategory): void
    {
        //
    }

    /**
     * Handle the Overtimecategory "restored" event.
     */
    public function restored(Overtimecategory $overtimecategory): void
    {
        //
    }

    /**
     * Handle the Overtimecategory "force deleted" event.
     */
    public function forceDeleted(Overtimecategory $overtimecategory): void
    {
        //
    }
}
