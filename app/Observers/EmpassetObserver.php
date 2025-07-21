<?php

namespace App\Observers;

use App\Models\Empasset;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class EmpassetObserver
{
    /**
     * Handle the Empasset "created" event.
     */
    public function created(Empasset $empasset): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'New Assets ' . $empasset->code . ' has been assigned by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Empasset "updated" event.
     */
    public function updated(Empasset $empasset): void
    {
        //
    }

    /**
     * Handle the Empasset "deleted" event.
     */
    public function deleted(Empasset $empasset): void
    {

    }

    /**
     * Handle the Empasset "restored" event.
     */
    public function restored(Empasset $empasset): void
    {
        //
    }

    /**
     * Handle the Empasset "force deleted" event.
     */
    public function forceDeleted(Empasset $empasset): void
    {
        //
    }
}
