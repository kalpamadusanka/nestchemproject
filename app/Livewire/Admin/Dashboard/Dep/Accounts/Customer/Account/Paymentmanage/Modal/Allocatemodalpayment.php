<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account\Paymentmanage\Modal;

use App\Models\Customerreceivepayment;
use App\Models\Paymentacchistory;
use App\Models\Paymentaccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Allocatemodalpayment extends Component
{
     public $openpaymentaccmodal=false;
    public $customerpaymentID;
    public $amount,$payment_date,$customername,$paymentAccounts,$paymentid,$depositamount;

    protected $listeners = ['openallocatemodal' => 'openModal'];
      public function openModal($id){
       $paymentData=Customerreceivepayment::find($id);
       $this->amount=$paymentData->amount;
       $this->paymentid=$id;
       $this->payment_date=$paymentData->created_at;
       $this->customername=$paymentData->customerData->company_name;
        $this->customerpaymentID=$id;
     $this->openpaymentaccmodal=true;
     $this->paymentAccounts=Paymentaccount::where('status',1)->get();
    }
    public function closeModal(){
        $this->openpaymentaccmodal=false;
    }

    public function allocateToAccount($paymentid,$accId){
        $paymentrec=Customerreceivepayment::find($paymentid);
        $this->depositamount=$paymentrec->amount;
        $paymentaccount=Paymentaccount::find($accId);
        $paymentaccount->balance += $paymentrec->amount;
        $result=$paymentaccount->update();
        if($result){
            $paymentrec->allocated = $paymentaccount->id;
            $paymentrec->save();
            $this->paymentaccount_history($paymentaccount);
            $this->dispatch('paymentallocated');
            $this->closeModal();
        }
    }

      public function paymentaccount_history($paymentaccount){
        $user=Auth::user();
        $accountbook=new Paymentacchistory();
        $accountbook->account_id=$paymentaccount->id;
        $accountbook->payment_method=1;
        $accountbook->amount=$this->depositamount;
        $accountbook->balance_before = $paymentaccount->balance - $this->depositamount;
        $accountbook->balance_after = $paymentaccount->balance;
        $accountbook->type='in';
        $accountbook->flow_type='deposit';
        $accountbook->description = 'Cash deposit of ' . number_format($this->depositamount, 2) . ' by ' . $user->name;
        $accountbook->added_by=$user->id;
        $accountbook->status=1;
        $accountbook->save();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.customer.account.paymentmanage.modal.allocatemodalpayment');
    }
}
