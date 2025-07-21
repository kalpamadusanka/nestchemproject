<?php

namespace App\Observers;

use App\Models\Hrdata;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class HrdataObserver
{
    /**
     * Handle the Hrdata "created" event.
     */
    public function created(Hrdata $hrdata): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'New data record ' . $hrdata->name . ' has been added by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Hrdata "updated" event.
     */
    public function updated(Hrdata $hrdata): void
    {
        //
    }

    /**
     * Handle the Hrdata "deleted" event.
     */
    public function deleted(Hrdata $hrdata): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'Existing data record ' . $hrdata->name . ' has been deleted by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Hrdata "restored" event.
     */
    public function restored(Hrdata $hrdata): void
    {
        //
    }

    /**
     * Handle the Hrdata "force deleted" event.
     */
    public function forceDeleted(Hrdata $hrdata): void
    {
        //
    }
}
