<?php

namespace App\Observers;

use App\Models\Holiday;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class HolidayObserver
{
    /**
     * Handle the Holiday "created" event.
     */
    public function created(Holiday $holiday): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'System user ' . $user->name . ' has added a new holiday: "' . $holiday->date . '".',
        ]);
    }

    /**
     * Handle the Holiday "updated" event.
     */
    public function updated(Holiday $holiday): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'System user ' . $user->name . ' has updated a existing holiday: "' . $holiday->date . '".',
        ]);
    }

    /**
     * Handle the Holiday "deleted" event.
     */
    public function deleted(Holiday $holiday): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'System user ' . $user->name . ' deleted  existing holiday: "' . $holiday->date . '".',
        ]);
    }

    /**
     * Handle the Holiday "restored" event.
     */
    public function restored(Holiday $holiday): void
    {
        //
    }

    /**
     * Handle the Holiday "force deleted" event.
     */
    public function forceDeleted(Holiday $holiday): void
    {
        //
    }
}
