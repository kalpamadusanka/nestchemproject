<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Paymentmethods\Modal;

use App\Models\Paymentmethods;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addpaymentmethodmodal extends Component
{

    public $paymentmethod;
    public $openpaymentmethodmodal=false;
    protected $listeners = ['openpaymentmethodmodal' => 'openModal'];

    protected $rules=[
        'paymentmethod'=>'required | unique:payment_methods,payment_method',
    ];

    public function openModal(){
     $this->openpaymentmethodmodal=true;
    }

    public function closeModal(){
        $this->openpaymentmethodmodal=false;
    }

    public function submit(){
     $this->validate();
     $user=Auth::user();
     $paymentmethod=new Paymentmethods();
     $paymentmethod->payment_method=$this->paymentmethod;
     $paymentmethod->added_by=$user->id;
     $paymentmethod->status=1;
     $paymentmethod->save();
     $this->reset();
     $this->closeModal();
     $this->dispatch('paymentmethodadded');
     //session()->flash('success','Payment Method Added Successfully');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.expenses.paymentmethods.modal.addpaymentmethodmodal');
    }
}
