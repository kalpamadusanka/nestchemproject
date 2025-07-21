<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchaseorder extends Model
{
    protected $table = 'purchase_order';
    protected $fillable = [
        'id',
        'contact_person_id',
        'date',
        'received_date',
        'received_status',
        'order_no',
        'reference',
        'currency',
        'amount_tax_status',
        'subtotal',
        'total',
        'due_amount',
        'delivery_address',
        'attention',
        'telephone',
        'note',
        'po_status',
        'recived_mark_by',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
   public function contact_person(){
    return $this->hasOne(Supplier::class, 'id', 'contact_person_id');
   }

   public function checkReceived(){
    return $this->hasOne(User::class, 'id', 'recived_mark_by');
   }

   public function items()
   {
       return $this->hasMany(Poitems::class);
   }
//    public function purchase_order_items(){
//     return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id', 'id');
//    }
//    public function purchase_order_payments(){
//     return $this->hasMany(PurchaseOrderPayment::class, 'purchase_order_id', 'id');
//    }
//    public function purchase_order_attachments(){
//     return $this->hasMany(PurchaseOrderAttachment::class, 'purchase_order_id', 'id');
//    }

}


