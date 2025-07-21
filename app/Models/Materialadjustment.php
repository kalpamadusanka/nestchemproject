<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materialadjustment extends Model
{

    protected $table = 'material_adjustment';
    protected $fillable = [
        'id',
        'material_id',
        'adjustment_type',
        'quantity',
        'reason',
        'previous_stock',
        'lot',
        'batch',
        'new_stock',
        'adjustment_date',
        'reference_number',
        'approved',
        'approved_by',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];

   public function addedUser(){
    return $this->hasOne(User::class, 'id', 'added_by');
   }

   public function material(){
    return $this->hasOne(Material::class, 'id', 'material_id');
   }

   public function approvedBy(){
    return $this->hasOne(User::class, 'id', 'approved_by');
   }

   public function adjustmentType(){
    return $this->hasOne(Adjustmenttype::class, 'id', 'adjustment_type');
   }

}
