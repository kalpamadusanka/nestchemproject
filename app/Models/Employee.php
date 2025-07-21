<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $fillable = [
        'id',
        'username',
        'email',
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'address',
        'city',
        'country',
        'postal_code',
        'contact',
        'user_id',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function emp(){
    return $this->hasOne(User::class, 'id', 'user_id');
}
public function leave(){
    return $this->hasMany(Leave::class, 'empid', 'user_id');
}

public function workdata()
{
    return $this->belongsTo(Worksheet::class, 'employee','user_id');
}
}
