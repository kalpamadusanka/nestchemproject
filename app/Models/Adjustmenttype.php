<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adjustmenttype extends Model
{

    protected $table = 'adjustment_type';
    protected $fillable = [
        'id',
        'adjustment_type',
        'type',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
}
