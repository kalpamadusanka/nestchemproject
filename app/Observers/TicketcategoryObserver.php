<?php

namespace App\Observers;

use App\Models\Systemlog;
use App\Models\TicketCategory;

class TicketcategoryObserver
{
    /**
     * Handle the TicketCategory "created" event.
     */
    public function created(TicketCategory $ticketCategory): void
    {
        Systemlog::create([
            'message'=>'New Ticket Category '.$ticketCategory->name.' created!',
         ]);
    }

    /**
     * Handle the TicketCategory "updated" event.
     */
    public function updated(TicketCategory $ticketCategory): void
    {
        //
    }

    /**
     * Handle the TicketCategory "deleted" event.
     */
    public function deleted(TicketCategory $ticketCategory): void
    {
        Systemlog::create([
            'message'=>'Existing Ticket Category '.$ticketCategory->name.' deleted!',
         ]);
    }

    /**
     * Handle the TicketCategory "restored" event.
     */
    public function restored(TicketCategory $ticketCategory): void
    {
        //
    }

    /**
     * Handle the TicketCategory "force deleted" event.
     */
    public function forceDeleted(TicketCategory $ticketCategory): void
    {
        //
    }
}
