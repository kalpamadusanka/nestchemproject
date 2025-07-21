<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\Customerpayment;
use App\Models\Salesorder;
use Illuminate\Support\Facades\DB;

class CustomerpaymentObserver
{
    /**
     * Handle the Customerpayment "created" event.
     */
    public function created(Customerpayment $customerpayment): void
    {
      try {
          $paid=$customerpayment->paid_amount;
          $salesData=Salesorder::where('order_no',$customerpayment->order_no)->first();
         $customerData=Customer::where('id',$salesData->customer)->first();
         $customerData->to_be_paid -= $paid;
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
     * Handle the Customerpayment "updated" event.
     */
    public function updated(Customerpayment $customerpayment): void
    {
        //
    }

    /**
     * Handle the Customerpayment "deleted" event.
     */
    public function deleted(Customerpayment $customerpayment): void
    {
        //
    }

    /**
     * Handle the Customerpayment "restored" event.
     */
    public function restored(Customerpayment $customerpayment): void
    {
        //
    }

    /**
     * Handle the Customerpayment "force deleted" event.
     */
    public function forceDeleted(Customerpayment $customerpayment): void
    {
        //
    }
}
