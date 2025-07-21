<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Momaterial extends Model
{
    protected $table = 'mo_material';
    protected $fillable = [
        'id',
        'material_id',
        'quantity',
        'uom',
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
