<?php

namespace App\Observers;

use App\Models\Empedudetails;
use App\Models\Systemlog;

class EmpeduObserver
{
    /**
     * Handle the Empedudetails "created" event.
     */
    public function created(Empedudetails $empedudetails): void
    {
        Systemlog::create([
            'message'=>'Employee '.$empedudetails->empid.' education details are updated!',
         ]);
    }

    /**
     * Handle the Empedudetails "updated" event.
     */
    public function updated(Empedudetails $empedudetails): void
    {
        //
    }

    /**
     * Handle the Empedudetails "deleted" event.
     */
    public function deleted(Empedudetails $empedudetails): void
    {
        Systemlog::create([
            'message'=>'Employee '.$empedudetails->empid.' education details are deleted!',
         ]);
    }

    /**
     * Handle the Empedudetails "restored" event.
     */
    public function restored(Empedudetails $empedudetails): void
    {
        //
    }

    /**
     * Handle the Empedudetails "force deleted" event.
     */
    public function forceDeleted(Empedudetails $empedudetails): void
    {
        //
    }
}
