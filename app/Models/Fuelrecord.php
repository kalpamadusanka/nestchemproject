<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuelrecord extends Model
{
       protected $table = 'do_fuel';
    protected $fillable = [
        'id',
        'do_no',
        'date',
        'amount',
        'cost',
        'odometer',
        'note',
        'status',
        'created_at',
        'updated_at',
   ];
   public function doData(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
}
}
