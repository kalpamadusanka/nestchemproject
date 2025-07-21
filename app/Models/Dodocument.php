<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dodocument extends Model
{
 protected $table = 'do_document';
    protected $fillable = [
        'id',
        'do_no',
        'filename',
        'filepath',
        'filetype',
        'filesize',
        'status',
        'created_at',
        'updated_at',
   ];

public function doData(){
    return $this->hasOne(Saledispatch::class, 'do_no', 'do_no');
}
}
