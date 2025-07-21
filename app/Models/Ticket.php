<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $fillable = [
        'id',
        'title',
        'ticket_no',
        't_category',
        'subject',
        'assign_to',
        'description',
        'priority',
        't_status',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function ticketCategory()
   {
       return $this->belongsTo(TicketCategory::class, 't_category');
   }

   public function assignUser(){
       return $this->belongsTo(User::class, 'assign_to');
   }

   public function addedBy(){
    return $this->belongsTo(User::class, 'added_by');
   }


}
