<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empedudetails extends Model
{
    protected $table = 'empedudetails';
    protected $fillable = [
        'id',
        'empid',
        'institute',
        'subject',
        'daterange',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

}
