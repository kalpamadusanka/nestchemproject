<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\Salesorder;
use Illuminate\Support\Facades\DB;

class SalesObserver
{
    /**
     * Handle the Salesorder "created" event.
     */
    public function created(Salesorder $salesorder): void
    {
        try {
            $customerId=$salesorder->customer;
       $tobepaid=$salesorder->due;
       $customerData=Customer::where('id',$customerId)->first();
       $customerData->to_be_paid += $tobepaid;
       $customerData->save();
        } catch (\Throwable $th) {
              DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
        ]);
        }
    }

    /**
     * Handle the Salesorder "updated" event.
     */
    public function updated(Salesorder $salesorder): void
    {
        //
    }

    /**
     * Handle the Salesorder "deleted" event.
     */
    public function deleted(Salesorder $salesorder): void
    {
        //
    }

    /**
     * Handle the Salesorder "restored" event.
     */
    public function restored(Salesorder $salesorder): void
    {
        //
    }

    /**
     * Handle the Salesorder "force deleted" event.
     */
    public function forceDeleted(Salesorder $salesorder): void
    {
        //
    }
}
