<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productstock extends Model
{
    protected $table = 'product_stock';
    protected $fillable = [
        'id',
        'product_id',
        'barcode',
        'qty',
        'unit_price',
        'product_group',
        'lot',
        'exp_date',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
   public function productData(){
    return $this->hasOne(Product::class,'id','product_id');
   }
   public function  productGroup(){
    return $this->hasOne(Manufactureproductgroup::class,'id','product_group');
   }
  // In ProductStock model
public function shelfData()
{
    return $this->hasMany(ShelfData::class, 'product_stock_id');
}


}
