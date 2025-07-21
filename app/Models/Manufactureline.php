<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufactureline extends Model
{
    protected $table = 'manufacture_line';
    protected $fillable = [
        'id',
        'mo_no',
        'product_group',
        'product',
        'barcode',
        'barcode_type',
        'files',
        'qty',
        'st_date',
        'ed_date',
        'assigned',
        'mo_status',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function addedBy(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function  productData(){
    return $this->hasOne(Product::class,'id','product');
   }

   public function  productGroup(){
    return $this->hasOne(Manufactureproductgroup::class,'id','product_group');
   }
}
