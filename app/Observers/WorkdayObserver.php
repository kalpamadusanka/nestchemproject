<?php

namespace App\Observers;

use App\Models\Systemlog;
use App\Models\Workday;
use Illuminate\Support\Facades\Auth;

class WorkdayObserver
{
    /**
     * Handle the Workday "created" event.
     */
    public function created(Workday $workday): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'System user ' . $user->name . ' has added a new workday: "' . $workday->date . '".',
        ]);
    }

    /**
     * Handle the Workday "updated" event.
     */
    public function updated(Workday $workday): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'System user ' . $user->name . ' has updated a existing working day: "' . $workday->date . '".',
        ]);
    }

    /**
     * Handle the Workday "deleted" event.
     */
    public function deleted(Workday $workday): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'System user ' . $user->name . ' deleted  existing workday: "' . $workday->date . '".',
        ]);
    }

    /**
     * Handle the Workday "restored" event.
     */
    public function restored(Workday $workday): void
    {
        //
    }

    /**
     * Handle the Workday "force deleted" event.
     */
    public function forceDeleted(Workday $workday): void
    {
        //
    }
}
