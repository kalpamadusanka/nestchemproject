<?php

namespace App\Observers;

use App\Models\Paymentacchistory;

class PaymentaccounthistoryObserver
{
    /**
     * Handle the Paymentacchistory "created" event.
     */
    public function created(Paymentacchistory $paymentacchistory): void
    {

    }

    /**
     * Handle the Paymentacchistory "updated" event.
     */
    public function updated(Paymentacchistory $paymentacchistory): void
    {
        //
    }

    /**
     * Handle the Paymentacchistory "deleted" event.
     */
    public function deleted(Paymentacchistory $paymentacchistory): void
    {
        //
    }

    /**
     * Handle the Paymentacchistory "restored" event.
     */
    public function restored(Paymentacchistory $paymentacchistory): void
    {
        //
    }

    /**
     * Handle the Paymentacchistory "force deleted" event.
     */
    public function forceDeleted(Paymentacchistory $paymentacchistory): void
    {
        //
    }
}
