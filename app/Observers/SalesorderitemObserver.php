<?php

namespace App\Observers;

use App\Models\Loadingproduct;
use App\Models\Salesorderitem;
use Illuminate\Support\Facades\DB;

class SalesorderitemObserver
{
    /**
     * Handle the Salesorderitem "created" event.
     */
    public function created(Salesorderitem $salesorderitem): void
    {
       try {
        $loadingData=Loadingproduct::where('id',$salesorderitem->loading_id)->first();
        $loadingData->in_loading_stock -=  $salesorderitem->quantity;
        $loadingData->save();

       } catch (\Throwable $th) {
        DB::table('error_logs')->insert([
            'message'    => $th->getMessage(),
            'file'       => $th->getFile(),
            'line'       => $th->getLine(),
            'trace'      => $th->getTraceAsString(),
            'created_at' => now(),
        ]);
       }
    }

    /**
     * Handle the Salesorderitem "updated" event.
     */
    public function updated(Salesorderitem $salesorderitem): void
    {
        //
    }

    /**
     * Handle the Salesorderitem "deleted" event.
     */
    public function deleted(Salesorderitem $salesorderitem): void
    {
        //
    }

    /**
     * Handle the Salesorderitem "restored" event.
     */
    public function restored(Salesorderitem $salesorderitem): void
    {
        //
    }

    /**
     * Handle the Salesorderitem "force deleted" event.
     */
    public function forceDeleted(Salesorderitem $salesorderitem): void
    {
        //
    }
}
