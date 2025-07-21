<?php

namespace App\Observers;

use App\Models\Expensescategories;
use App\Models\Systemlog;
use Illuminate\Support\Facades\Auth;

class ExpensescategoriesObserver
{
    /**
     * Handle the Expensescategories "created" event.
     */
    public function created(Expensescategories $expensescategories): void
    {
        $user=Auth::user();
        Systemlog::create([
        'message' => 'New Expenses category ' . $expensescategories->category_name. ' has been successfully added by ' . $user->name . '.'

        ]);
    }

    /**
     * Handle the Expensescategories "updated" event.
     */
    public function updated(Expensescategories $expensescategories): void
    {
        $user=Auth::user();
        Systemlog::create([
        'message' => 'Existing Expenses category ' . $expensescategories->category_name. ' has been successfully updated by ' . $user->name . '.'

        ]);
    }

    /**
     * Handle the Expensescategories "deleted" event.
     */
    public function deleted(Expensescategories $expensescategories): void
    {
        $user=Auth::user();
        Systemlog::create([
        'message' => 'Existing Expenses category ' . $expensescategories->category_name. ' has been successfully deleted by ' . $user->name . '.'

        ]);
    }

    /**
     * Handle the Expensescategories "restored" event.
     */
    public function restored(Expensescategories $expensescategories): void
    {
        //
    }

    /**
     * Handle the Expensescategories "force deleted" event.
     */
    public function forceDeleted(Expensescategories $expensescategories): void
    {
        //
    }
}
