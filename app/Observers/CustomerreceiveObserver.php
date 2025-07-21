<?php

namespace App\Observers;

use App\Models\Customerreceivepayment;

class CustomerreceiveObserver
{
    /**
     * Handle the Customerreceivepayment "created" event.
     */
    public function created(Customerreceivepayment $customerreceivepayment): void
    {
        //
    }

    /**
     * Handle the Customerreceivepayment "updated" event.
     */
    public function updated(Customerreceivepayment $customerreceivepayment): void
    {
        //
    }

    /**
     * Handle the Customerreceivepayment "deleted" event.
     */
    public function deleted(Customerreceivepayment $customerreceivepayment): void
    {
        //
    }

    /**
     * Handle the Customerreceivepayment "restored" event.
     */
    public function restored(Customerreceivepayment $customerreceivepayment): void
    {
        //
    }

    /**
     * Handle the Customerreceivepayment "force deleted" event.
     */
    public function forceDeleted(Customerreceivepayment $customerreceivepayment): void
    {
        //
    }
}
