<?php

namespace App\Observers;

use App\Models\Employeedoc;
use App\Models\Systemlog;

class EmployeedocObserver
{
    /**
     * Handle the Employeedoc "created" event.
     */
    public function created(Employeedoc $employeedoc): void
    {
        Systemlog::create([
            'message'=>'Employee '.$employeedoc->id.' document are updated!',
         ]);
    }

    /**
     * Handle the Employeedoc "updated" event.
     */
    public function updated(Employeedoc $employeedoc): void
    {

    }

    /**
     * Handle the Employeedoc "deleted" event.
     */
    public function deleted(Employeedoc $employeedoc): void
    {
        Systemlog::create([
            'message'=>'Employee '.$employeedoc->id.' document are deleted!',
         ]);
    }

    /**
     * Handle the Employeedoc "restored" event.
     */
    public function restored(Employeedoc $employeedoc): void
    {
        //
    }

    /**
     * Handle the Employeedoc "force deleted" event.
     */
    public function forceDeleted(Employeedoc $employeedoc): void
    {
        //
    }
}
