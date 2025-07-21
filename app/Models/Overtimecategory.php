<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overtimecategory extends Model
{
    protected $table = 'overtime_category';
    protected $fillable = [
        'id',
        'category_name',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}
}
