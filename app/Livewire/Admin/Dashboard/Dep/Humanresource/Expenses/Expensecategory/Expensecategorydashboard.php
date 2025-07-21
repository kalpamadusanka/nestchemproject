<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Expensecategory;

use App\Models\Expensescategories;
use Livewire\Component;
use Livewire\WithPagination;

class Expensecategorydashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    protected $listeners = ['expensecategoryadded' => 'render','expensecategoryupdated'=>'render'];
    public function openexpensecategorymodal(){
        $this->dispatch('openexpensesmodal');
    }

    public function activecategory($id){
     $expensecategory=Expensescategories::find($id);
     $expensecategory->status=1;
     $expensecategory->update();
     $this->dispatch('expensecategoryupdated');
    }
    public function deactivecategory($id){
        $expensecategory=Expensescategories::find($id);
        $expensecategory->status=0;
        $expensecategory->update();
        $this->dispatch('expensecategoryupdated');
    }

    public function deletecategory($id){
        $expensecategory=Expensescategories::find($id);
        $expensecategory->delete();
        $this->dispatch('expensecategoryupdated');
    }
    public function render()
    {
        $expensecategory =Expensescategories::whereNotNull('status')
        ->where(function ($query) {
            $query->where('category_name', 'LIKE', '%' . $this->search . '%');// Search by name
        })
        ->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.expenses.expensecategory.expensecategorydashboard',compact('expensecategory'))->layout('livewire.admin.dashboard.layout.master');
    }
}
