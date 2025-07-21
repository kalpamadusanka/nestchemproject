<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doexpenses extends Model
{
    protected $table = 'do_expenses';
    protected $fillable = [
        'id',
        'do_no',
        'amount',
        'note',
        'date',
        'reported_by',
        'status',
        'created_at',
        'updated_at',
   ];

public function doData(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
}

public function userData(){
    return $this->hasOne(User::class, 'id', 'reported_by');
}
}
