<?php

namespace App\Observers;

use App\Models\Empworkexperiencedetails;
use App\Models\Systemlog;

class EmpexperienceObserver
{
    /**
     * Handle the Empworkexperiencedetails "created" event.
     */
    public function created(Empworkexperiencedetails $empworkexperiencedetails): void
    {
        Systemlog::create([
            'message'=>'Employee '.$empworkexperiencedetails->empid.' working expereince are updated!',
         ]);
    }

    /**
     * Handle the Empworkexperiencedetails "updated" event.
     */
    public function updated(Empworkexperiencedetails $empworkexperiencedetails): void
    {
        //
    }

    /**
     * Handle the Empworkexperiencedetails "deleted" event.
     */
    public function deleted(Empworkexperiencedetails $empworkexperiencedetails): void
    {
        Systemlog::create([
            'message'=>'Employee '.$empworkexperiencedetails->empid.' working expereince are deleted!',
         ]);
    }

    /**
     * Handle the Empworkexperiencedetails "restored" event.
     */
    public function restored(Empworkexperiencedetails $empworkexperiencedetails): void
    {
        //
    }

    /**
     * Handle the Empworkexperiencedetails "force deleted" event.
     */
    public function forceDeleted(Empworkexperiencedetails $empworkexperiencedetails): void
    {
        //
    }
}
