<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturedom extends Model
{
    protected $table = 'manufactured_order_material';
    protected $fillable = [
        'id',
        'mo_line_id',
        'material_id',
        'qty',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function addedBy(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
}
