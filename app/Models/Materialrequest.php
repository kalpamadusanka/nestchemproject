<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materialrequest extends Model
{

    protected $table = 'material_request';
    protected $fillable = [
        'id',
        'material_id',
        'quantity',
        'description',
        'uom',
        'req_code',
        'req_status',
        'transferred_by',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function material(){
    return $this->hasOne(Material::class, 'id', 'material_id');
   }

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function transferredUser(){
    return $this->hasOne(User::class, 'id', 'transferred_by');
   }

}
