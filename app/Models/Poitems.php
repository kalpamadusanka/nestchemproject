<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poitems extends Model
{
    protected $table = 'purchase_order_items';
    protected $fillable = [
        'id',
        'purchase_order_id',
        'item',
        'description',
        'quantity',
        'unit_price',
        'discount',
        'account_id',
        'tax_rate',
        'lot',
        'batch',
        'exp_date',
        'amount',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function material(){
    return $this->hasMany(Material::class,'code','item');
   }

   public function purchasedorder()
   {
       return $this->belongsTo(Purchaseorder::class);
   }
   public function purchaseOrder()
   {
    return $this->hasOne(Purchaseorder::class, 'id', 'purchase_order_id');
   }
   public function scopeExpired($query)
{
    return $query->where('exp_date', '<', now());
}
}
