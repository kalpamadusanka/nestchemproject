<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loadingactivity extends Model
{
    protected $table = 'loading_activity';
    protected $fillable = [
        'id',
        'do_no',
        'type',
        'activity',
        'created_at',
        'updated_at',
   ];
   public function saleDispatch(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
   }

}
