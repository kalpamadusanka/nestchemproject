<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assetstype extends Model
{
    protected $table = 'assets_type';
    protected $fillable = [
        'id',
        'assets_type',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
}
