<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'emp_leave';
    protected $fillable = [
        'id',
        'empid',
        'leave_type',
        'from_date',
        'to_date',
        'no_of_date',
        'remaining_leave',
        'reason',
        'leave_status',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function employee()
   {
    return $this->belongsTo(Employee::class, 'empid', 'user_id');
   }
}
