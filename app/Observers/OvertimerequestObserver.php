<?php

namespace App\Observers;

use App\Models\Empattendence;
use App\Models\Overtimerequest;
use Carbon\Carbon;

class OvertimerequestObserver
{
    /**
     * Handle the Overtimerequest "created" event.
     */
    public function created(Overtimerequest $overtimerequest): void
    {
        //
    }

    /**
     * Handle the Overtimerequest "updated" event.
     */
    public function updated(Overtimerequest $overtimerequest): void
    {
        $starttime = Carbon::parse($overtimerequest->start_time);
        $endtime = Carbon::parse($overtimerequest->end_time);

        $hoursDifference = $starttime->diffInHours($endtime);
        $extraworkadded = Empattendence::where('employee', $overtimerequest->employee_id)
        ->whereDate('created_at', Carbon::parse($overtimerequest->start_time)) // Ensure start_time is parsed correctly
        ->first();


        if($extraworkadded){
            $extraworkadded->worked_hours += $hoursDifference;
            $extraworkadded->update();
        }
    }

    /**
     * Handle the Overtimerequest "deleted" event.
     */
    public function deleted(Overtimerequest $overtimerequest): void
    {
        //
    }

    /**
     * Handle the Overtimerequest "restored" event.
     */
    public function restored(Overtimerequest $overtimerequest): void
    {
        //
    }

    /**
     * Handle the Overtimerequest "force deleted" event.
     */
    public function forceDeleted(Overtimerequest $overtimerequest): void
    {
        //
    }
}
