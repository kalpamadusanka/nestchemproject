<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewprofile\Bankdata;

use App\Models\Empbankdetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bankdetailsmodal extends Component
{

    public $selectedid,$bankname,$accno,$branch;
    public $viewbankdatamodal=false;
    protected $listeners = ['openbankmodal' => 'openModal'];

    protected $rules =[
      'bankname'=>'required',
      'accno'=>'required',
      'branch'=>'required',
    ];
    protected $messages = [
        'bankname.required' => 'Bank Name is required',
        'accno.required' => 'Account Number is required',
        'branch.required' => 'Branch Name is required',
    ];

    public function openModal($id){
        $this->selectedid=$id;
       $this->viewbankdatamodal=true;
    }
    public function closeModal(){
        $this->viewbankdatamodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $userExist=Empbankdetails::where('empid',$this->selectedid)->first();
        if($userExist){
            $userExist->update([
                'bank_name'=>$this->bankname,
                'acc_no'=>$this->accno,
                'branch'=>$this->branch,
            ]);
            $this->dispatch('bankdetailsupdated',$this->selectedid);
            $this->closeModal();
        }
        else{
            $bankDetail = new Empbankdetails();
            $bankDetail->empid = $this->selectedid;
            $bankDetail->bank_name = $this->bankname;
            $bankDetail->acc_no = $this->accno;
            $bankDetail->branch = $this->branch;
            $bankDetail->added_by=$user->id;
            $bankDetail->status=1;
            $bankDetail->save();
            $this->closeModal();
            $this->dispatch('bankdetailsupdated',$this->selectedid);
        }



    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewprofile.bankdata.bankdetailsmodal');
    }
}
