<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customerreceivepayment extends Model
{
   protected $table = 'customer_receive_payment';
    protected $fillable = [
        'id',
        'customer',
        'amount',
        'invoice_no',
        'allocated',
        'type',
        'description',
        'approved',
        'added_by',
        'doc',
        'status',
        'created_at',
        'updated_at',
   ];
   public function customerData(){
    return $this->hasOne(Customer::class, 'id', 'customer');
}

 public function paymentData(){
    return $this->hasOne(Paymentaccount::class, 'id', 'allocated');
}

 public function userData(){
    return $this->hasOne(User::class, 'id', 'customer');
}
}
