<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockadjustment extends Model
{
    protected $table = 'product_stock_adjustment';
    protected $fillable = [
        'id',
        'ref_no',
        'date',
        'product_id',
        'shelf_no',
        'uom',
        'type',
        'adjustment_qty',
        'newqty',
        'unit_price',
        'in_stock',
        'approved',
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
   public function product(){
    return $this->hasOne(Product::class, 'id', 'product_id');
   }
   public function productStockcCheck(){
    return $this->hasOne(Productstock::class, 'id', 'product_stock_id');
   }
}
