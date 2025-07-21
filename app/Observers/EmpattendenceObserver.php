<?php

namespace App\Observers;

use App\Models\Empattendence;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class EmpattendenceObserver
{
    /**
     * Handle the Empattendence "created" event.
     */
    public function created(Empattendence $empattendence): void
    {
        $user=Auth::user();
        Systemlog::create([
        'message' => 'Attendance for employee ' . $empattendence->employeeData->username . ' has been successfully recorded by ' . $user->name . '.'

        ]);
    }

    /**
     * Handle the Empattendence "updated" event.
     */
    public function updated(Empattendence $empattendence): void
    {

    }

    /**
     * Handle the Empattendence "deleted" event.
     */
    public function deleted(Empattendence $empattendence): void
    {
        $user=Auth::user();
        Systemlog::create([
        'message' => 'Existing Attendance for employee ' . $empattendence->employeeData->username . ' has been successfully deleted by ' . $user->name . '.'

        ]);
    }

    /**
     * Handle the Empattendence "restored" event.
     */
    public function restored(Empattendence $empattendence): void
    {
        //
    }

    /**
     * Handle the Empattendence "force deleted" event.
     */
    public function forceDeleted(Empattendence $empattendence): void
    {
        //
    }
}
