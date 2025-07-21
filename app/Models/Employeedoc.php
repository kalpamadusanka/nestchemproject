<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employeedoc extends Model
{
    protected $table = 'employeedoc';
    protected $fillable = [
        'id',
        'user_id',
        'doc',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function emp(){
    return $this->hasOne(User::class, 'id', 'user_id');
}
}
