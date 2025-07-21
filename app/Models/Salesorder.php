<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salesorder extends Model
{
    protected $table = 'sales_order';
    protected $fillable = [
        'id',
        'do_no',
        'invoice_no',
        'order_no',
        'customer',
        'cantotal',
        'total_qty',
        'total',
        'due',
        'latitude',
        'longitude',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function items()
{
    return $this->hasMany(SalesorderItem::class, 'salesorder_id', 'id');
}

   public function customerData(){
    return $this->hasOne(Customer::class, 'id', 'customer');
   }

   protected static function booted()
{
    static::deleting(function ($salesorder) {
        $salesorder->items()->delete();
    });
}


}

