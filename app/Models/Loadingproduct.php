<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loadingproduct extends Model
{
    protected $table = 'loading_product';
    protected $fillable = [
        'id',
        'do_no',
        'product_id',
        'product_stock_id',
        'shelf',
        'qty',
        'in_loading_stock',
        'created_at',
        'updated_at',
   ];
   public function addedBy(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function productData(){
    return $this->hasOne(Product::class, 'id', 'product_id');
   }

   public function shelfData(){
    return $this->hasOne(Shelf::class, 'id', 'shelf');
   }

   public function saleDispatch(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
   }

   public function productStock(){
    return $this->hasOne(Productstock::class, 'id', 'product_stock_id');
   }
}
