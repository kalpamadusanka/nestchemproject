<?php

namespace App\Observers;

use App\Models\Systemlog;
use App\Models\Worksheet;
use Illuminate\Support\Facades\Auth;

class WorksheetObserver
{
    /**
     * Handle the Worksheet "created" event.
     */
    public function created(Worksheet $worksheet): void
    {
        $user=Auth::user();
        Systemlog::create([
           'message' => 'A new worksheet record has been added by system user ' . $user->name . ' for employee "' . $worksheet->employeeData->username . '".'
        ]);
    }

    /**
     * Handle the Worksheet "updated" event.
     */
    public function updated(Worksheet $worksheet): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'Existing worksheet record of ' . $worksheet->employeeData->username . ' has been updated by system user ' . $user->name . '.'
        ]);

    }

    /**
     * Handle the Worksheet "deleted" event.
     */
    public function deleted(Worksheet $worksheet): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'Existing worksheet record of ' . $worksheet->employeeData->username . ' has been deleted by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Worksheet "restored" event.
     */
    public function restored(Worksheet $worksheet): void
    {
        //
    }

    /**
     * Handle the Worksheet "force deleted" event.
     */
    public function forceDeleted(Worksheet $worksheet): void
    {
        //
    }
}
