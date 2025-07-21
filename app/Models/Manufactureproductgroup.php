<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufactureproductgroup extends Model
{
    protected $table = 'manufacture_product_group';
    protected $fillable = [
        'id',
        'code',
        'product_group',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function addedBy(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

}
