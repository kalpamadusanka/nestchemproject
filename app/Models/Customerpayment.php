<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customerpayment extends Model
{
  protected $table = 'so_payment';
    protected $fillable = [
        'id',
        'do_no',
        'order_no',
        'customer',
        'invoice_no',
        'received_id',
        'type',
        'total',
        'paid_amount',
        'to_be_paid',
        'cheque_number',
        'bank_name',
        'cheque_date',
        'cheque_image',
        'chequedate',
        'status',
        'created_at',
        'updated_at',
   ];
   public function customerData(){
    return $this->hasOne(Customer::class, 'id', 'customer');
}
public function doData(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
}
public function orderData(){
    return $this->hasOne(Salesorder::class, 'order_no', 'order_no');
}
}

