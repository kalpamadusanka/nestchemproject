<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    protected $table = 'workingday';
    protected $fillable = [
        'id',
        'workday',
        'date',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}
}
