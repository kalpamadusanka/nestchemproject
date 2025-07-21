<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
        'id',
        'company_name',
        'address',
        'contact_person',
        'fax',
        'email',
        'phone',
        'phonetwo',
        'billing_address',
        'vat',
        'note',
        'signature',
        'area',
        'sales_rep',
        'customer_acc_no',
        'credit_limit',
        'credit_period',
        'added_by',
        'to_be_paid',
        'total_paid',
        'status',
        'created_at',
        'updated_at',
   ];
   public function added_user(){
    return $this->hasOne(User::class, 'id', 'added_by');
}
public function sales_representative(){
    return $this->hasOne(User::class, 'id', 'sales_rep');
}

}

