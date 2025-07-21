<?php

namespace App\Observers;

use App\Models\Paymentaccounttype;

class PaymentaccounttypeObserver
{
    /**
     * Handle the Paymentaccounttype "created" event.
     */
    public function created(Paymentaccounttype $paymentaccounttype): void
    {
        //
    }

    /**
     * Handle the Paymentaccounttype "updated" event.
     */
    public function updated(Paymentaccounttype $paymentaccounttype): void
    {
        //
    }

    /**
     * Handle the Paymentaccounttype "deleted" event.
     */
    public function deleted(Paymentaccounttype $paymentaccounttype): void
    {
        //
    }

    /**
     * Handle the Paymentaccounttype "restored" event.
     */
    public function restored(Paymentaccounttype $paymentaccounttype): void
    {
        //
    }

    /**
     * Handle the Paymentaccounttype "force deleted" event.
     */
    public function forceDeleted(Paymentaccounttype $paymentaccounttype): void
    {
        //
    }
}
