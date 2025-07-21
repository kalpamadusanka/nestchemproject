<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Modal;

use App\Models\Paymentacchistory;
use App\Models\Paymentaccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cashoutmodal extends Component
{

    public $amount,$selectId;
    public $opencashoutmodal=false;

    protected $listeners = ['openCashOutModal' => 'openModal'];
    protected $rules=[
      'amount'=>'required',
    ];

    public function openModal($id){
        $this->selectId=$id;
        $this->opencashoutmodal=true;
    }

    public function submit(){
        $this->validate();
        $amountout=$this->amount;
        $account=Paymentaccount::find($this->selectId);
        if ($account) {
            // Deduct amount
            $balanceBefore = $account->balance;
            $account->balance -= $this->amount;
            $account->update();
        }

        $this->closeModal();
        $this->reset();
        $this->dispatch('cashoutsuccess');

        $this->saverecordhistory($account,$amountout,$balanceBefore);
    }

    public function saverecordhistory($account,$amountout,$balanceBefore){
       $user=Auth::user();
        $accountbook=new Paymentacchistory();
        $accountbook->account_id=$account->id;
        $accountbook->payment_method=1;
        $accountbook->amount=$amountout;
        $accountbook->balance_before = $balanceBefore;
        $accountbook->balance_after = $account->balance;
        $accountbook->transaction_type='cashout';
        $accountbook->type='out';
        $accountbook->flow_type='cashout';
        $accountbook->description = 'Cash payment of ' . number_format($amountout, 2) . ' by ' . $user->name;
        $accountbook->added_by=$user->id;
        $accountbook->status=1;
        $accountbook->save();
    }

    public function closeModal(){
        $this->opencashoutmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.paymentaccount.modal.cashoutmodal');
    }
}
