<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'id',
        'product_name',
        'product_code',
        'product_group',
        'product_image',
        'qty',
        'alert_qty',
        'sold',
        'damage',
        'uom',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function productGroup(){
    return $this->hasOne(Manufactureproductgroup::class, 'id', 'product_group');
   }
   public function productStocks()
   {
       return $this->hasMany(ProductStock::class);
   }
}
