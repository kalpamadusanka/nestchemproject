<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
   protected $table = 'do_vehicle_trip';
    protected $fillable = [
        'id',
        'do_no',
        'start_km',
        'distance',
        'end_km',
        'initial_fuel',
        'final_fuel',
        'status',
        'created_at',
        'updated_at',
   ];

     public function doData(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
   }
}
