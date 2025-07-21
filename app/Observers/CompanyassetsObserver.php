<?php

namespace App\Observers;

use App\Models\Companyassets;
use App\Models\Empasset;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class CompanyassetsObserver
{
    /**
     * Handle the Companyassets "created" event.
     */
    public function created(Companyassets $companyassets): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'New assets ' . $companyassets->item . ' has been added by system user ' . $user->name . '.'
        ]);
        Empasset::create([
            'empid' => $companyassets->empid,
            'code' => $companyassets->code,
            'item'=>$companyassets->item,
            'assigned_date'=>$companyassets->created_at,
            'assigned_by'=>$companyassets->added_by,
            'added_by'=>$user->id,
            'status' => 1,
        ]);
    }

    /**
     * Handle the Companyassets "updated" event.
     */
    public function updated(Companyassets $companyassets): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'Existing assets ' . $companyassets->item . ' status has been updated by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Companyassets "deleted" event.
     */
    public function deleted(Companyassets $companyassets): void
    {
        $user=Auth::user();
        Systemlog::create([
            'message' => 'Existing assets ' . $companyassets->item . ' status has been deleted by system user ' . $user->name . '.'
        ]);
    }

    /**
     * Handle the Companyassets "restored" event.
     */
    public function restored(Companyassets $companyassets): void
    {
        //
    }

    /**
     * Handle the Companyassets "force deleted" event.
     */
    public function forceDeleted(Companyassets $companyassets): void
    {
        //
    }
}
