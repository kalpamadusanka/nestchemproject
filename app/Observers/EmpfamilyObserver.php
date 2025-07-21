<?php

namespace App\Observers;

use App\Models\Empfamilydetails;
use App\Models\Systemlog;

class EmpfamilyObserver
{
    /**
     * Handle the Empfamilydetails "created" event.
     */
    public function created(Empfamilydetails $empfamilydetails): void
    {
        Systemlog::create([
            'message'=>'Employee '.$empfamilydetails->empid.' family information are updated!',
         ]);
    }

    /**
     * Handle the Empfamilydetails "updated" event.
     */
    public function updated(Empfamilydetails $empfamilydetails): void
    {
        //
    }

    /**
     * Handle the Empfamilydetails "deleted" event.
     */
    public function deleted(Empfamilydetails $empfamilydetails): void
    {
        Systemlog::create([
            'message'=>'Employee '.$empfamilydetails->empid.' family information are deleted!',
         ]);
    }

    /**
     * Handle the Empfamilydetails "restored" event.
     */
    public function restored(Empfamilydetails $empfamilydetails): void
    {
        //
    }

    /**
     * Handle the Empfamilydetails "force deleted" event.
     */
    public function forceDeleted(Empfamilydetails $empfamilydetails): void
    {
        //
    }
}
