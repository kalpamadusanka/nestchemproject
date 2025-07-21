<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empattendence extends Model
{

    protected $table = 'emp_attendence';
    protected $fillable = [
        'id',
        'employee',
        'timein',
        'timeout',
        'worked_hours',
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
