<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentaccounttype extends Model
{
    protected $table = 'payment_account_type';
    protected $fillable = [
        'id',
        'account_type',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}
}
