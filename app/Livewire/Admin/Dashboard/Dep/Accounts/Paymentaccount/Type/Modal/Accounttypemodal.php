<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Type\Modal;

use App\Models\Paymentaccounttype;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Accounttypemodal extends Component
{


    public $account_type;

    protected $rules=[
     'account_type'=>'required|unique:payment_account_type'
    ];
    public $openaccounttypeaddmodal=false;
    protected $listeners = ['openaccountypeaddmodal' => 'openModal'];

    public function openModal(){
        $this->openaccounttypeaddmodal=true;
    }
    public function closeModal(){
        $this->openaccounttypeaddmodal=false;
    }
    public function submit(){
   $this->validate();
   $user=Auth::user();
    $accounttype=new Paymentaccounttype();
    $accounttype->account_type=$this->account_type;
    $accounttype->added_by=$user->id;
    $accounttype->status=1;
    $accounttype->save();
    $this->closeModal();
    // $this->emit('accounttypeadded');
    $this->reset();
    $this->dispatch('accounttypeadded');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.paymentaccount.type.modal.accounttypemodal');
    }
}
