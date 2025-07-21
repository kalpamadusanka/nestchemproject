<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Systemlog extends Model
{
    protected $table = 'system_log';
    protected $fillable = [
        'id',
        'message',
        'created_at',
        'updated_at',
   ];
}
