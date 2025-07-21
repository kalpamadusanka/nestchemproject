<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salesorderitem extends Model
{
    protected $table = 'sales_order_item';
    protected $fillable = [
        'id',
        'order_no',
        'do_no',
        'product_id',
        'loading_id',
        'stock_id',
        'quantity',
        'product_name',
        'total',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
   public function productData(){
    return $this->hasOne(Product::class, 'id', 'product_id');
   }
}

