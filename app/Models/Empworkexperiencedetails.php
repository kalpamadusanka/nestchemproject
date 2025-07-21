<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empworkexperiencedetails extends Model
{
    protected $table = 'empexperiencedetails';
    protected $fillable = [
        'id',
        'empid',
        'employer',
        'position',
        'daterange',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
}
