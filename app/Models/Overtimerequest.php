<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overtimerequest extends Model
{
    protected $table = 'overtime_request';
    protected $fillable = [
        'id',
        'employee_id',
        'category_id',
        'start_time',
        'end_time',
        'note',
        'approval_status',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
  }

  public function category(){
    return $this->hasOne(Overtimecategory::class, 'id', 'category_id');
  }

  public function employee(){
    return $this->hasOne(Employee::class, 'user_id', 'employee_id');
  }
}
