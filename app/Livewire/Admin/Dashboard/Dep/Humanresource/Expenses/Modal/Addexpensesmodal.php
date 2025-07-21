<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Modal;

use App\Models\Employee;
use App\Models\Expenses;
use App\Models\Expensescategories;
use App\Models\Paymentmethods;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Addexpensesmodal extends Component
{
    use WithFileUploads;
    public $employees,$paymentmethods,$expensecategories;

    public $empname,$paymentmethod,$transaction,$merchant,$expensecategory,$note,$amount,$currency,$document;
    public $openexpensemodal=false;
    protected $listeners = ['openexpensesModal' => 'openModal'];

    protected $rules =[
      'paymentmethod'=>'required',
      'transaction'=>'required | unique:expenses,transcation_no',
      'merchant'=>'required',
      'expensecategory'=>'required',
      'note'=>'required',
      'amount'=>'required',
      'currency'=>'required',
      'document' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
    ];

    public function openModal(){

      $this->openexpensemodal=true;
    }


    public function closeModal(){
        $this->openexpensemodal=false;
    }

    public function submit(){
    $this->validate();
    $user=Auth::user();
    if($this->empname){
      $expenses=new Expenses();
      $expenses->expense_for=$this->empname;
      $expenses->payment_method=$this->paymentmethod;
      $expenses->transcation_no=$this->transaction;
      $expenses->merchant=$this->merchant;
      $expenses->expenses_category=$this->expensecategory;
      $expenses->note=$this->note;
      $expenses->amount=$this->amount;
      $expenses->currency=$this->currency;
      $expenses->added_by=$user->id;
      $expenses->status=1;
      if ($this->document) {
        $extension = $this->document->getClientOriginalExtension();
        $uniqueFilename = time() . '.' . $extension;
        $storedPath = $this->document->storeAs('expensesdoc', $uniqueFilename, 'public');
    }
      $expenses->doc=$uniqueFilename;
    $expenses->save();
    }
    else{
        $expenses=new Expenses();
        $expenses->expense_for='company';
        $expenses->payment_method=$this->paymentmethod;
        $expenses->transcation_no=$this->transaction;
        $expenses->merchant=$this->merchant;
        $expenses->expenses_category=$this->expensecategory;
        $expenses->note=$this->note;
        $expenses->amount=$this->amount;
        $expenses->currency=$this->currency;
        $expenses->added_by=$user->id;
      $expenses->status=1;
        if ($this->document) {
          $extension = $this->document->getClientOriginalExtension();
          $uniqueFilename = time() . '.' . $extension;
          $storedPath = $this->document->storeAs('expensesdoc', $uniqueFilename, 'public');
      }
        $expenses->doc=$uniqueFilename;
      $expenses->save();
    }
    $this->reset();
    $this->closeModal();
    $this->dispatch('expensesadded');
    }
    public function render()
    {
        $this->employees = Employee::all();
        $this->paymentmethods=Paymentmethods::where('status',1)->get();
        $this->expensecategories=Expensescategories::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.humanresource.expenses.modal.addexpensesmodal');
    }
}
