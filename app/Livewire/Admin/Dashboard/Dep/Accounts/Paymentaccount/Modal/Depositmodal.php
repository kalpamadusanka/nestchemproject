<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Modal;

use App\Models\Paymentacchistory;
use App\Models\Paymentaccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Depositmodal extends Component
{
    public $opendepositmodal=false;

    public $amount,$selectedID;

    protected $rules=[
     "amount"=> "required",
    ];

    protected $listeners = ['opendipositmodal' => 'openModal'];

    public function openModal($id){
        $this->selectedID=$id;
        $this->opendepositmodal = true;
    }

    public function submit(){
        $this->validate();
        $this->opendepositmodal = false;
        $paymentaccount=Paymentaccount::find($this->selectedID);
        $paymentaccount->balance += $this->amount;
        $paymentaccount->update();
        $this->paymentaccount_history($paymentaccount);
        $this->reset();
        $this->dispatch("funddeposite");
    }

    public function paymentaccount_history($paymentaccount){
        $user=Auth::user();
        $accountbook=new Paymentacchistory();
        $accountbook->account_id=$paymentaccount->id;
        $accountbook->payment_method=1;
        $accountbook->amount=$this->amount;
        $accountbook->balance_before = $paymentaccount->balance - $this->amount;
        $accountbook->balance_after = $paymentaccount->balance;
        $accountbook->type='in';
        $accountbook->flow_type='deposit';
        $accountbook->description = 'Cash deposit of ' . number_format($this->amount, 2) . ' by ' . $user->name;
        $accountbook->added_by=$user->id;
        $accountbook->status=1;
        $accountbook->save();
    }

    public function closeModal(){
     $this->opendepositmodal = false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.paymentaccount.modal.depositmodal');
    }
}
