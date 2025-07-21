<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelfData extends Model
{
    protected $table = 'shelf_data';
    protected $fillable = [
        'id',
        'shelf_no',
        'product_stock_id',
        'qty',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function shelfCheck(){
    return $this->hasOne(Shelf::class, 'id', 'shelf_no');
   }
   public function productStockcCheck(){
    return $this->hasOne(Productstock::class, 'id', 'product_stock_id');
   }
}
