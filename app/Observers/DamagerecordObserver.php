<?php

namespace App\Observers;

use App\Models\Damagerecord;

class DamagerecordObserver
{
    /**
     * Handle the Damagerecord "created" event.
     */
    public function created(Damagerecord $damagerecord): void
    {
        //
    }

    /**
     * Handle the Damagerecord "updated" event.
     */
    public function updated(Damagerecord $damagerecord): void
    {
        //
    }

    /**
     * Handle the Damagerecord "deleted" event.
     */
    public function deleted(Damagerecord $damagerecord): void
    {
        //
    }

    /**
     * Handle the Damagerecord "restored" event.
     */
    public function restored(Damagerecord $damagerecord): void
    {
        //
    }

    /**
     * Handle the Damagerecord "force deleted" event.
     */
    public function forceDeleted(Damagerecord $damagerecord): void
    {
        //
    }
}
