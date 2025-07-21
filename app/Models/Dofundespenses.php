<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dofundespenses extends Model
{
    protected $table = 'do_fund_expenses';
    protected $fillable = [
        'id',
        'do_no',
        'amount',
        'payment_account',
        'type',
        'description',
        'approved',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

public function doData(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
}

public function userData(){
    return $this->hasOne(User::class, 'id', 'added_by');
}
public function accData(){
    return $this->hasOne(Paymentaccount::class, 'id', 'payment_account');
}
}

