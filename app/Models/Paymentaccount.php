<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentaccount extends Model
{
    protected $table = 'payment_account';
    protected $fillable = [
        'id',
        'account_name',
        'account_type',
        'code',
        'balance',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function accountType(){
    return $this->hasOne(Paymentaccounttype::class, 'id', 'account_type');
   }
}
