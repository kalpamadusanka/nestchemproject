<?php

namespace App\Observers;

use App\Models\Hrdatafiles;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class HrdatafilesObserver
{
    /**
     * Handle the Hrdatafiles "created" event.
     */
    public function created(Hrdatafiles $hrdatafiles): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'New HR file record ' . $hrdatafiles->doc . ' has been added by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Hrdatafiles "updated" event.
     */
    public function updated(Hrdatafiles $hrdatafiles): void
    {
        //
    }

    /**
     * Handle the Hrdatafiles "deleted" event.
     */
    public function deleted(Hrdatafiles $hrdatafiles): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'New HR file record ' . $hrdatafiles->doc . ' has been deleted by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Hrdatafiles "restored" event.
     */
    public function restored(Hrdatafiles $hrdatafiles): void
    {
        //
    }

    /**
     * Handle the Hrdatafiles "force deleted" event.
     */
    public function forceDeleted(Hrdatafiles $hrdatafiles): void
    {
        //
    }
}
