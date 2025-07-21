<?php

namespace App\Observers;

use App\Models\Paymentacchistory;
use App\Models\Paymentaccount;
use Illuminate\Support\Facades\Auth;

class PaymentaccountObserver
{
    /**
     * Handle the Paymentaccount "created" event.
     */
    public function created(Paymentaccount $paymentaccount): void
    {

    }

    /**
     * Handle the Paymentaccount "updated" event.
     */
    public function updated(Paymentaccount $paymentaccount): void
    {


    }

    /**
     * Handle the Paymentaccount "deleted" event.
     */
    public function deleted(Paymentaccount $paymentaccount): void
    {
        //
    }

    /**
     * Handle the Paymentaccount "restored" event.
     */
    public function restored(Paymentaccount $paymentaccount): void
    {
        //
    }

    /**
     * Handle the Paymentaccount "force deleted" event.
     */
    public function forceDeleted(Paymentaccount $paymentaccount): void
    {
        //
    }
}
