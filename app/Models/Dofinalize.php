<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dofinalize extends Model
{
     protected $table = 'do_finalize';
    protected $fillable = [
        'id',
        'do_no',
        'total',
        'credit',
        'cash',
        'cheque',
        'expenses',
        'expected_cash',
        'received_cash',
         'expected_cheque',
        'received_cheque',
        'cash_difference',
        'cheque_difference',
        'approved',
        'received_by',
        'status',
        'taken_by',
        'created_at',
        'updated_at',
   ];

public function doData(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
}
}
