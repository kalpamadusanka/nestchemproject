<?php

namespace App\Observers;

use App\Models\Materialcategory;

class MaterialcategoryObserver
{
    /**
     * Handle the Materialcategory "created" event.
     */
    public function created(Materialcategory $materialcategory): void
    {
        //
    }

    /**
     * Handle the Materialcategory "updated" event.
     */
    public function updated(Materialcategory $materialcategory): void
    {
        //
    }

    /**
     * Handle the Materialcategory "deleted" event.
     */
    public function deleted(Materialcategory $materialcategory): void
    {
        //
    }

    /**
     * Handle the Materialcategory "restored" event.
     */
    public function restored(Materialcategory $materialcategory): void
    {
        //
    }

    /**
     * Handle the Materialcategory "force deleted" event.
     */
    public function forceDeleted(Materialcategory $materialcategory): void
    {
        //
    }
}
