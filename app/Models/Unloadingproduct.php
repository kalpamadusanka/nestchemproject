<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unloadingproduct extends Model
{
   protected $table = 'unloading_product';
    protected $fillable = [
        'id',
        'do_no',
        'product_id',
        'unload_qty',
        'added_by',
        'received_by',
        'verified_by',
        'created_at',
        'updated_at',
   ];
   public function addedBy(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function productData(){
    return $this->hasOne(Product::class, 'id', 'product_id');
   }

   public function saleDispatch(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
   }


}
