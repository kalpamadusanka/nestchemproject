<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentmethods extends Model
{
    protected $table = 'payment_methods';
    protected $fillable = [
        'id',
        'payment_method',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}
}
