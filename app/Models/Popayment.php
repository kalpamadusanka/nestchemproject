<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popayment extends Model
{
    protected $table = 'po_payment';
    protected $fillable = [
        'id',
        'payment_methodId',
        'purchase_order_id',
        'transactionId',
        'type',
        'payment_account',
        'due_amount',
        'total_paid',
        'file',
        'amount',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function paymentMethod(){
    return $this->hasOne(Paymentmethods::class, 'id', 'payment_methodId');
   }
   public function paymentAcc(){
    return $this->hasOne(Paymentaccount::class, 'id', 'payment_account');
   }
}
