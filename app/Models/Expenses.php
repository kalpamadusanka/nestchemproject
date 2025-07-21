<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'expenses';
    protected $fillable = [
        'id',
        'expense_for',
        'payment_method',
        'transcation_no',
        'merchant',
        'expenses_category',
        'note',
        'amount',
        'currency',
        'doc',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}


}
