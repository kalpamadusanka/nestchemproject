<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holiday';
    protected $fillable = [
        'id',
        'holiday',
        'date',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}
}
