<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expensescategories extends Model
{

    protected $table = 'expenses_categories';
    protected $fillable = [
        'id',
        'category_name',
        'note',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}

}
