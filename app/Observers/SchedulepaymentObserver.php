<?php

namespace App\Observers;

use App\Models\Schedulepayment;

class SchedulepaymentObserver
{
    /**
     * Handle the Schedulepayment "created" event.
     */
    public function created(Schedulepayment $schedulepayment): void
    {
        //
    }

    /**
     * Handle the Schedulepayment "updated" event.
     */
    public function updated(Schedulepayment $schedulepayment): void
    {
        //
    }

    /**
     * Handle the Schedulepayment "deleted" event.
     */
    public function deleted(Schedulepayment $schedulepayment): void
    {
        //
    }

    /**
     * Handle the Schedulepayment "restored" event.
     */
    public function restored(Schedulepayment $schedulepayment): void
    {
        //
    }

    /**
     * Handle the Schedulepayment "force deleted" event.
     */
    public function forceDeleted(Schedulepayment $schedulepayment): void
    {
        //
    }
}
