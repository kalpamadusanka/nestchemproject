<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materialcategory extends Model
{
    protected $table = 'material_category';
    protected $fillable = [
        'id',
        'category_name',
        'category_code',
        'value',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
}
