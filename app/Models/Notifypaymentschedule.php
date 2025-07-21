<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifypaymentschedule extends Model
{
      protected $table = 'customer_payment_schedule_notify';
    protected $fillable = [
        'id',
        'payment_schedule_id',
        'mark_as_received',
        'status',
        'created_at',
        'updated_at',
   ];
   public function scheduleData(){
    return $this->hasOne(Schedulepayment::class, 'id', 'payment_schedule_id');
}
}
