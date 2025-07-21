<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrdatafiles extends Model
{
    protected $table = 'hr_data_file';
    protected $fillable = [
        'id',
        'hrdata_id',
        'doc',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }
}
