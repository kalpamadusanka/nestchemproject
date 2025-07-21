<?php

namespace App\Observers;

use App\Models\Purchaseorder;

class PurchaseorderObserver
{
    /**
     * Handle the Purchaseorder "created" event.
     */
    public function created(Purchaseorder $purchaseorder): void
    {
        //
    }

    /**
     * Handle the Purchaseorder "updated" event.
     */
    public function updated(Purchaseorder $purchaseorder): void
    {
        //
    }

    /**
     * Handle the Purchaseorder "deleted" event.
     */
    public function deleted(Purchaseorder $purchaseorder): void
    {
        //
    }

    /**
     * Handle the Purchaseorder "restored" event.
     */
    public function restored(Purchaseorder $purchaseorder): void
    {
        //
    }

    /**
     * Handle the Purchaseorder "force deleted" event.
     */
    public function forceDeleted(Purchaseorder $purchaseorder): void
    {
        //
    }
}
