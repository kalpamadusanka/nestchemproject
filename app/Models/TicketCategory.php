<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $table = 'ticket_category';
    protected $fillable = [
        'id',
        'category_name',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function tickets()
   {
       return $this->hasMany(Ticket::class,'t_category');
   }

}
