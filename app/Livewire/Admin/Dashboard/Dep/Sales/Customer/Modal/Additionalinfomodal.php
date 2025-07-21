<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Customer\Modal;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Additionalinfomodal extends Component
{
    public $openadditionalinfomodal=false;
    protected $listeners = ['openadditionalmodal' => 'openModal'];

    public $area,$sales_rep,$acc_no,$credit_limit,$credit_period,$signature,$phone_two,$phone,$email,$contact_person,$address,$billing_address,$fax,$selectedId;

    public function openModal($id){
     $this->selectedId=$id;
     $this->openadditionalinfomodal=true;
     $customerData=Customer::where('id',$id)->first();
     $this->area=$customerData->area;
     $this->sales_rep=$customerData->sales_representative->id ?? '';
     $this->acc_no=$customerData->customer_acc_no;
     $this->credit_limit=$customerData->credit_limit;
     $this->credit_period=$customerData->credit_period;
     $this->signature=$customerData->signature;
     $this->phone_two=$customerData->phonetwo;
     $this->phone=$customerData->phone;
     $this->email=$customerData->email;
     $this->contact_person=$customerData->contact_person;
     $this->address=$customerData->address;
     $this->billing_address=$customerData->billing_address;
     $this->fax=$customerData->fax;


    }

    public function submit(){
     try {
        $customer=Customer::find($this->selectedId);
        $customer->area=$this->area;
        $customer->sales_rep=$this->sales_rep;
        $customer->customer_acc_no=$this->acc_no;
        $customer->address=$this->address;
        $customer->credit_period=$this->credit_period;
        $customer->credit_limit=$this->credit_limit;
        $customer->contact_person=$this->contact_person;
        $customer->email=$this->email;
        $customer->phone=$this->phone;
        $customer->phonetwo=$this->phone_two;
        $customer->billing_address=$this->billing_address;
        $customer->fax=$this->fax;
        $customer->save();
        $this->closeModal();
        $this->dispatch('customerdetailsupdated');
     } catch (\Throwable $th) {
        $this->dispatch('errorcustomerdetailsupdated', message: $th->getMessage());
        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
  ]);
     }
    }

    public function closeModal(){
        $this->openadditionalinfomodal=false;
    }
    public function render()
    {
        $salesrep=User::where('role','Sales Officer')->get();
        return view('livewire.admin.dashboard.dep.sales.customer.modal.additionalinfomodal',compact('salesrep'));
    }
}
