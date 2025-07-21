<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'raw_materials';
    protected $fillable = [
        'id',
        'name',
        'code',
        'warehouse_id',
        'shelf_no',
        'category_id',
        'unit',
        'qty',
        'min_stock',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
   public function categoryData(){
    return $this->hasOne(Materialcategory::class, 'id', 'category_id');
   }

}
