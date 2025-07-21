<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saledispatch extends Model
{
    protected $table = 'sale_dispatch';
    protected $fillable = [
        'id',
        'do_no',
        'area',
        'date',
        'sale_represntative',
        'vehicle',
        'driver',
        'opening_amount',
        'load_value',
        'unload_value',
        'can_total',
        'loading_prepared_by',
        'loading_received_by',
        'loading_store_keeper',
        'unloading_prepared_by',
        'unloading_received_by',
        'unloading_store_keeper',
        'checked_by',
        'authorised',
        'load_status',
        'unload_status',
        'start_time',
        'end_time',
        'note',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];



   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
   public function salePerson(){
    return $this->hasOne(User::class, 'id', 'sale_represntative');
   }

   public function vehicleCheck(){
    return $this->hasOne(Companyassets::class, 'id', 'vehicle');
   }
   public function driverCheck(){
    return $this->hasOne(User::class, 'id', 'driver');
   }
   public function loadingPrepared(){
    return $this->hasOne(User::class, 'id', 'loading_prepared_by');
   }
   public function loadingReceived(){
    return $this->hasOne(User::class, 'id', 'loading_received_by');
   }
   public function loadingStorekeeper(){
    return $this->hasOne(User::class, 'id', 'loading_store_keeper');
   }

   public function unloadingPrepared(){
    return $this->hasOne(User::class, 'id', 'unloading_prepared_by');
   }

   public function unloadingReceived(){
    return $this->hasOne(User::class, 'id', 'unloading_received_by');
   }
   public function unloadingStorekeeper(){
    return $this->hasOne(User::class, 'id', 'unloading_store_keeper');
   }

   public function checkedBy(){
    return $this->hasOne(User::class, 'id', 'checked_by');
   }
   public function authorised(){
    return $this->hasOne(User::class, 'id', 'authorised');
   }
   public function soPayments()
{
    return $this->hasMany(Customerpayment::class, 'do_no', 'do_no');
}
public function getGroupedSoPaymentsSum()
{
    return $this->soPayments()
        ->select('do_no', 'order_no')
        ->selectRaw('MAX(total) as total') // assume each order_no has duplicated total
        ->groupBy('do_no', 'order_no')
        ->get()
        ->sum('total');
}
}
