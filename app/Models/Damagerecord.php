<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Damagerecord extends Model
{
    protected $table = 'do_damage';
    protected $fillable = [
        'id',
        'do_no',
        'problem',
        'reported_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function doData(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
}  public function reportedData(){
     return $this->hasOne(User::class, 'id', 'reported_by');
}
}
