<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Modal;

use App\Models\Paymentaccount;
use App\Models\Paymentaccounttype;
use Livewire\Component;

class Editpaymentaccountmodal extends Component
{

    public $openpaymentaccounteditmodal=false;

    public $account_type,$code,$name,$description,$selectedID;
    protected $listeners = ['editpaymentaccount' => 'openModal'];

    public function openModal($id){
        $this->selectedID=$id;
       $this->openpaymentaccounteditmodal = true;
       $account=Paymentaccount::find($id);
       $this->account_type=$account->account_type;
       $this->code=$account->code;
       $this->name=$account->account_name;
       $this->description=$account->description;

    }

    public function closeModal(){
        $this->openpaymentaccounteditmodal = false;
    }

    public function submit(){
      $accountData=Paymentaccount::find($this->selectedID);
      $accountData->account_type=$this->account_type;
      $accountData->code=$this->code;
      $accountData->name=$this->name;
      $accountData->description=$this->description;
      $accountData->update();
      $this->closeModal();
    }
    public function render()
    {
        $accType=Paymentaccounttype::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.accounts.paymentaccount.modal.editpaymentaccountmodal',compact('accType'));
    }
}
