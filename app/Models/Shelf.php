<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $table = 'shelf';
    protected $fillable = [
        'id',
        'shelf_no',
        'capacity',
        'warehouse',
        'current_stock',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
   public function wareHouse(){
    return $this->hasOne(Warehouse::class, 'id', 'warehouse');
   }
}
