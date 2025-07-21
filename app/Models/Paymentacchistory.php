<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentacchistory extends Model
{
    protected $table = 'payment_account_history';
    protected $fillable = [
        'id',
        'account_id',
        'transaction_id',
        'payment_method',
        'amount',
        'balance_before',
        'balance_after',
        'transaction_type',
        'type',
        'flow_type',
        'refNo',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function paymentAccount(){
    return $this->hasOne(Paymentaccount::class, 'id', 'account_id');
   }

   public function paymentMethod(){
    return $this->hasOne(Paymentmethods::class, 'id','payment_method');
   }

}
