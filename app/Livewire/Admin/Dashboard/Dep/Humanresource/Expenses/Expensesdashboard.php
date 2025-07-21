<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses;

use App\Models\Expenses;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Expensesdashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$total_expenses,$company_expenses,$employee_expenses;

    public $stdate,$eddate,$daterange;
    protected $listeners = ['expensesadded' => 'render','expensesdeleted'=>'render'];
    public function addexpenses(){
        $this->dispatch('openexpensesModal');
    }
    public function applyDate(){
        try {
           if ($this->daterange) {
               list($startDate, $endDate) = explode(' to ', $this->daterange);
              $this->stdate=$startDate;
              $this->eddate=$endDate;
           }
        } catch (\Throwable $th) {
           //throw $th;
        }

    }
    public function viewexpensedoc($id){
        $this->dispatch('openexpensedocModal',$id);
    }

    public function viewexpensedetails($id){
        $this->dispatch('openexpensedetailsModal',$id);
    }

    public function deleteexpenses($id){
        $deleteexpenses=Expenses::find($id);
        if($deleteexpenses->doc){

               $existingPath = "expensesdoc/{$deleteexpenses->doc}";
               if (Storage::disk('public')->exists($existingPath)) {
                   Storage::disk('public')->delete($existingPath);
               }

        }
        $deleteexpenses->delete();
        $this->dispatch('expensesdeleted');
    }

    public function render()
    {
        $this->total_expenses = Expenses::whereNotNull('status')->sum('amount');
        $this->company_expenses = Expenses::whereNotNull('status')->where('expense_for','company')->sum('amount');
        $this->employee_expenses =Expenses::whereNotNull('status')
        ->where('expense_for', '!=', 'company')
        ->sum('amount');



        $expenses =Expenses::whereNotNull('status');
        if ($this->search) {
            $expenses->where(function ($query) {
                $query->where('expense_for', 'like', '%' . $this->search . '%');

            });
        }
        if ($this->stdate && $this->eddate) {
            $expenses->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }

        $expenses = $expenses->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.expenses.expensesdashboard',compact('expenses'))->layout('livewire.admin.dashboard.layout.master');
    }
}
