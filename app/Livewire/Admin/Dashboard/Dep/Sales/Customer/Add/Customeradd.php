<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Customer\Add;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Customeradd extends Component
{
    public $signatureData,$customer_name,$address,$contact_person,$fax,$email,$phone,$mobile,$billing_address,$vat_no,$note;

    public $rules=[
     'customer_name'=>'required',
     'address'=>'required',
     'contact_person'=>'required',
     'fax'=>'required',
     'email'=>'required',
     'phone'=>'required',
     'billing_address'=>'required',
     'vat_no'=>'required',

    ];
    public function submit(){
     try {
        $this->validate();
        $user=Auth::user();
        $customer=new Customer();
        $customer->company_name=$this->customer_name;
        $customer->address=$this->address;
        $customer->contact_person=$this->contact_person;
        $customer->fax=$this->fax;
        $customer->email=$this->email;
        $customer->phone=$this->phone;
        $customer->phonetwo=$this->mobile;
        $customer->billing_address=$this->billing_address;
        $customer->vat=$this->vat_no;
        $customer->note=$this->note;
        $customer->signature=$this->signatureData;
        $customer->added_by=$user->id;
        $customer->status=1;
        $customer->save();
        $this->reset();
        $this->dispatch('customerAdded');
     } catch (\Throwable $th) {

        $this->dispatch('errorcustomerAdded', message: $th->getMessage());
            DB::table('error_logs')->insert([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                'created_at' => now(),
      ]);
     }
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.customer.add.customeradd')->layout('livewire.admin.dashboard.layout.master');
    }
}
