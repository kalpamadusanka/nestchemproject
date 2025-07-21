<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empbankdetails extends Model
{
    protected $table = 'empbankdetails';
    protected $fillable = [
        'id',
        'empid',
        'bank_name',
        'acc_no',
        'branch',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
}
