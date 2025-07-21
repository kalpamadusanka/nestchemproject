<?php

namespace App\Observers;

use App\Models\Expenses;

class ExpensesObserver
{
    /**
     * Handle the Expenses "created" event.
     */
    public function created(Expenses $expenses): void
    {
        //
    }

    /**
     * Handle the Expenses "updated" event.
     */
    public function updated(Expenses $expenses): void
    {
        //
    }

    /**
     * Handle the Expenses "deleted" event.
     */
    public function deleted(Expenses $expenses): void
    {
        //
    }

    /**
     * Handle the Expenses "restored" event.
     */
    public function restored(Expenses $expenses): void
    {
        //
    }

    /**
     * Handle the Expenses "force deleted" event.
     */
    public function forceDeleted(Expenses $expenses): void
    {
        //
    }
}
