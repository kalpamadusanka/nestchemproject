<?php

namespace App\Observers;

use App\Models\Assetstype;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class AassetstypeObserver
{
    /**
     * Handle the Assetstype "created" event.
     */
    public function created(Assetstype $assetstype): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'New Assets type ' . $assetstype->assets_type . ' has been added by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Assetstype "updated" event.
     */
    public function updated(Assetstype $assetstype): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'Existing Assets type ' . $assetstype->assets_type . ' status has been updated by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Assetstype "deleted" event.
     */
    public function deleted(Assetstype $assetstype): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'Existing Assets type ' . $assetstype->assets_type . ' has been deleted by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Assetstype "restored" event.
     */
    public function restored(Assetstype $assetstype): void
    {
        //
    }

    /**
     * Handle the Assetstype "force deleted" event.
     */
    public function forceDeleted(Assetstype $assetstype): void
    {
        //
    }
}
