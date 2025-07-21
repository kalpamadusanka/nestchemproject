<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedulepayment extends Model
{
  protected $table = 'customer_payment_schedule';
    protected $fillable = [
        'id',
        'customer',
        'amount',
        'date',
        'payment_method',
        'added_by',
        'status',
        'taken_by',
        'created_at',
        'updated_at',
   ];

   public function customerData(){
    return $this->hasOne(Customer::class, 'id', 'customer');
   }
}

