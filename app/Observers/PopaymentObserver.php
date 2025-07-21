<?php

namespace App\Observers;

use App\Models\Popayment;

class PopaymentObserver
{
    /**
     * Handle the Popayment "created" event.
     */
    public function created(Popayment $popayment): void
    {
        //
    }

    /**
     * Handle the Popayment "updated" event.
     */
    public function updated(Popayment $popayment): void
    {
        //
    }

    /**
     * Handle the Popayment "deleted" event.
     */
    public function deleted(Popayment $popayment): void
    {
        //
    }

    /**
     * Handle the Popayment "restored" event.
     */
    public function restored(Popayment $popayment): void
    {
        //
    }

    /**
     * Handle the Popayment "force deleted" event.
     */
    public function forceDeleted(Popayment $popayment): void
    {
        //
    }
}
