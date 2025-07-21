<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Expenses;

use App\Models\Doexpenses;
use Livewire\Component;
use Livewire\WithPagination;

class Expensesdashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $doNo,$search,$total;
     protected $listeners = ['expensesadded' => 'render'];
    public function mount($do_no){
        $this->doNo=$do_no;
        $this->total=Doexpenses::where('do_no',$this->doNo)->sum('amount');
    }
    public function addexpenses(){
        $this->dispatch('addexpensesmodal',$this->doNo);
    }

    public function deleterecord($id){
        $expenses=Doexpenses::where('id',$id)->first();
        if($expenses){
            $expenses->delete();
            $this->dispatch('expensesdeleted');
            $this->render();
        }
    }
    public function render()
    {
        $expensesRecord = Doexpenses::where('do_no', $this->doNo)
    ->when($this->search, function ($query) {
        $query->where('note', 'like', '%' . $this->search . '%');
    })
    ->paginate(5);

        return view('livewire.admin.dashboard.dep.sales.distribute.orders.expenses.expensesdashboard',compact('expensesRecord'))->layout('livewire.admin.dashboard.layout.master');
    }
}
