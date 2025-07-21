<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrdata extends Model
{
    protected $table = 'hr_data';
    protected $fillable = [
        'id',
        'name',
        'collection_id',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function dataCollection(){
    return $this->hasOne(Datacollection::class, 'id', 'collection_id');
   }

}
