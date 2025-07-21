<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empfamilydetails extends Model
{
    protected $table = 'empfamilydetails';
    protected $fillable = [
        'id',
        'empid',
        'name',
        'relationship',
        'dob',
        'phone',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
}
