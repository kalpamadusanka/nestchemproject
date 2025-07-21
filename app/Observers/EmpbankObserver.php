<?php

namespace App\Observers;

use App\Models\Empbankdetails;
use App\Models\Systemlog;

class EmpbankObserver
{
    /**
     * Handle the Empbankdetails "created" event.
     */
    public function created(Empbankdetails $empbankdetails): void
    {
        Systemlog::create([
            'message'=>'Employee '.$empbankdetails->empid.' bank details are updated!',
         ]);
    }

    /**
     * Handle the Empbankdetails "updated" event.
     */
    public function updated(Empbankdetails $empbankdetails): void
    {
        //
    }

    /**
     * Handle the Empbankdetails "deleted" event.
     */
    public function deleted(Empbankdetails $empbankdetails): void
    {
        //
    }

    /**
     * Handle the Empbankdetails "restored" event.
     */
    public function restored(Empbankdetails $empbankdetails): void
    {
        //
    }

    /**
     * Handle the Empbankdetails "force deleted" event.
     */
    public function forceDeleted(Empbankdetails $empbankdetails): void
    {
        //
    }
}
