<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = [
        'id',
        'invoice_no',
        'total',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function addedBy()
   {
    return $this->hasOne(User::class, 'id', 'added_by');
   }
}
