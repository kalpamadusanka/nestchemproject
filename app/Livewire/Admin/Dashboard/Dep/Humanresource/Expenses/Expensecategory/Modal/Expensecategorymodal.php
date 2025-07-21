<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Expensecategory\Modal;

use App\Models\Expensescategories;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Expensecategorymodal extends Component
{
    public $categoryname,$note;
    public $opencategorymodal=false;
    protected $listeners = ['openexpensesmodal' => 'openModal'];

    protected $rules=[
     'categoryname'=>'required',
    ];

    public function openModal(){
    $this->opencategorymodal=true;
    }
    public function closeModal(){
        $this->opencategorymodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
     $expensecategory=new Expensescategories();
     $expensecategory->category_name=$this->categoryname;
     $expensecategory->note=$this->note;
     $expensecategory->added_by=$user->id;
     $expensecategory->status=1;
     $expensecategory->save();
     $this->reset();
     $this->closeModal();
     $this->dispatch('expensecategoryadded');

    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.expenses.expensecategory.modal.expensecategorymodal');
    }
}
