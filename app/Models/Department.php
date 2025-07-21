<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected $fillable = [
        'id',
        'department_name',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
}
