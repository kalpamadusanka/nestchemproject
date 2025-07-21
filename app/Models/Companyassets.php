<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companyassets extends Model
{
    protected $table = 'company_assets';
    protected $fillable = [
        'id',
        'empid',
        'code',
        'item',
        'type',
        'department',
        'description',
        'added_by',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}

public function employeeData(){
    return $this->hasOne(Employee::class, 'user_id', 'empid');
}
 public function assettype(){
    return $this->hasOne(Assetstype::class, 'id', 'type');
 }

 public function assetdepartment(){
    return $this->hasOne(Department::class, 'id', 'department');
 }


}
