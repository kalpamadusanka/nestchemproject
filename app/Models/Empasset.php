<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empasset extends Model
{
    protected $table = 'empasset';
    protected $fillable = [
        'id',
        'empid',
        'code',
        'item',
        'assigned_date',
        'assigned_by',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
}
