<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanTransaction extends Model
{

    protected $table = 'can_record';
    protected $fillable = [
        'id',
        'order_no',
        'do_no',
        'size',
        'purchased_qty',
        'exchanged_qty',
        'price_per_can',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function doDetails(){
    return $this->hasOne(Saledispatch::class, 'id', 'do_no');
   }

   public function saleOrder(){
    return $this->hasOne(Salesorder::class, 'order_no', 'order_no');
   }
}
