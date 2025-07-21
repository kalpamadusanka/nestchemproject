<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';
    protected $fillable = [
        'id',
        'warehouse_name',
        'warehouse_code',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
}
