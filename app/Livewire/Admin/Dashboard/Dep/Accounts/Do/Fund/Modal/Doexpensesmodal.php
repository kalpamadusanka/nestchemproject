<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Do\Fund\Modal;

use App\Models\Dofundespenses;
use App\Models\Paymentaccount;
use App\Models\Saledispatch;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Doexpensesmodal extends Component
{
    public $startedDo,$amount,$starteddo,$paymentAccount,$paymentaccount,$note;
    public $doexpmodal=false;
      protected $listeners = ['showexpensesmodal' => 'openModal'];

      protected $rules=[
        'amount'=>'required',
        'starteddo'=>'required',
        'paymentaccount'=>'required',
      ];
      public function openModal(){
        $this->doexpmodal=true;
      }
       public function closeModal(){
        $this->doexpmodal=false;
      }
      public function mount(){
        $this->startedDo=Saledispatch::whereNotNull('start_time')->where('end_time',null)->get();
        $this->paymentAccount=Paymentaccount::whereNotNull('balance')->get();
      }

      public function submit(){
        $this->validate();
        $user=Auth::user();

        $dofundrecord=new Dofundespenses();
        $dofundrecord->do_no=$this->starteddo;
        $dofundrecord->amount=$this->amount;
         $dofundrecord->payment_account=$this->paymentaccount;
          $dofundrecord->type='cash';
          $dofundrecord->description=$this->note;
          $dofundrecord->approved=0;
          $dofundrecord->added_by=$user->id;
          $dofundrecord->status=1;

          $paymentAcc=Paymentaccount::where('id',$this->paymentaccount)->first();
          if($paymentAcc->balance < $this->amount){
            $this->dispatch('insufficentfund');
            $this->closeModal();
          }
          else{
            $dofundrecord->save();
            $this->dispatch('dofundexpensesadded');
             $this->closeModal();
          }

      }



    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.do.fund.modal.doexpensesmodal');
    }
}
