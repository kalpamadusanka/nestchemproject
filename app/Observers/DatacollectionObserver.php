<?php

namespace App\Observers;

use App\Models\Datacollection;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class DatacollectionObserver
{
    /**
     * Handle the Datacollection "created" event.
     */
    public function created(Datacollection $datacollection): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'New collection ' . $datacollection->collection_name . ' has been added by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Datacollection "updated" event.
     */
    public function updated(Datacollection $datacollection): void
    {
        //
    }

    /**
     * Handle the Datacollection "deleted" event.
     */
    public function deleted(Datacollection $datacollection): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'Existing collection ' . $datacollection->collection_name . ' has been deleted by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Datacollection "restored" event.
     */
    public function restored(Datacollection $datacollection): void
    {
        //
    }

    /**
     * Handle the Datacollection "force deleted" event.
     */
    public function forceDeleted(Datacollection $datacollection): void
    {
        //
    }
}
