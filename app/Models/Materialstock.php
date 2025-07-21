<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materialstock extends Model
{
    protected $table = 'material_stock';
    protected $fillable = [
        'id',
        'material_id',
        'exp_date',
        'qty',
        'lot',
        'batch',
        'expired',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function materialData(){
    return $this->hasOne(Material::class, 'id', 'material_id');
   }
}
