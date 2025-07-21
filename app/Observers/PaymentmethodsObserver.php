<?php

namespace App\Observers;

use App\Models\Paymentmethods;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class PaymentmethodsObserver
{
    /**
     * Handle the Paymentmethods "created" event.
     */
    public function created(Paymentmethods $paymentmethods): void
    {
        $user=Auth::user();
        Systemlog::create([
        'message' => 'New payment methods ' . $paymentmethods->payment_method. ' has been successfully added by ' . $user->name . '.'

        ]);
    }

    /**
     * Handle the Paymentmethods "updated" event.
     */
    public function updated(Paymentmethods $paymentmethods): void
    {
        $user=Auth::user();
        Systemlog::create([
        'message' => 'Existing payment methods ' . $paymentmethods->payment_method. ' status has been successfully updated by ' . $user->name . '.'

        ]);
    }

    /**
     * Handle the Paymentmethods "deleted" event.
     */
    public function deleted(Paymentmethods $paymentmethods): void
    {
        $user=Auth::user();
        Systemlog::create([
        'message' => 'Existing payment methods ' . $paymentmethods->payment_method. ' has been successfully deleted by ' . $user->name . '.'

        ]);
    }

    /**
     * Handle the Paymentmethods "restored" event.
     */
    public function restored(Paymentmethods $paymentmethods): void
    {
        //
    }

    /**
     * Handle the Paymentmethods "force deleted" event.
     */
    public function forceDeleted(Paymentmethods $paymentmethods): void
    {
        //
    }
}
