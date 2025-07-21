<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Modal;

use App\Models\Paymentaccount;
use App\Models\Paymentaccounttype;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addpaymentaccountmodal extends Component
{

    public $account_type,$code,$name,$description;

    protected $rules=[
        'account_type'=>'required',
        'code'=>'required|unique:payment_account,code',
        'name'=>'required|unique:payment_account,account_name',
        'description'=>'required'
    ];
    public $openpaymentaccountaddmodal=false;
    protected $listeners = ['paymentaccountaddmodal' => 'openModal'];

    public function openModal(){
     $this->openpaymentaccountaddmodal=true;
    }
    public function closeModal(){
        $this->openpaymentaccountaddmodal=false;
    }
    public function submit(){
    $this->validate();
    $user=Auth::user();
    $paymentAccount=new Paymentaccount();
    $paymentAccount->account_name=$this->name;
    $paymentAccount->account_type=$this->account_type;
    $paymentAccount->code=$this->code;
    $paymentAccount->description=$this->description;
    $paymentAccount->status=1;
    $paymentAccount->balance=0;
    $paymentAccount->added_by=$user->id;
    $paymentAccount->save();
    $this->reset();
    $this->closeModal();
    $this->dispatch('paymentaccountadded');
    // $this->dispatchBrowserEvent('success', ['message' => 'Payment Account Added Successfully']);
    }
    public function render()
    {
        $accType=Paymentaccounttype::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.accounts.paymentaccount.modal.addpaymentaccountmodal',compact('accType'));
    }
}
