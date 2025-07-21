<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{

    protected $table = 'worksheet';
    protected $fillable = [
        'id',
        'employee',
        'task',
        'deadline',
        'worked_hours',
        'date',
        'note',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}

public function employeeData(){
    return $this->hasOne(Employee::class, 'user_id', 'employee');
}


}
