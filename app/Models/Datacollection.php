<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datacollection extends Model
{

    protected $table = 'data_collection';
    protected $fillable = [
        'id',
        'collection_name',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}


}
