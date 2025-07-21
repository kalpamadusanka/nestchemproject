<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Expenses\Modal;

use App\Models\Doexpenses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Addexpensesmodal extends Component
{
    public $doNo,$date,$amount,$note;
     public $openaddexpensesmodal=false;
    protected $listeners = ['addexpensesmodal' => 'openModal'];

    protected $rules=[
       'date'=>'required',
       'amount'=>'required',
       'note'=>'required',
    ];

    public function openModal($do_no){
     $this->doNo=$do_no;
     $this->openaddexpensesmodal=true;
    }
    public function closeModal(){
        $this->openaddexpensesmodal=false;
    }
   public function saveFuelRecord()
{
        $this->validate();
    try {
        $user = Auth::user();
        $expenses = new Doexpenses();
        $expenses->do_no = $this->doNo;
        $expenses->amount = $this->amount;
        $expenses->note = $this->note;
        $expenses->date = $this->date;
        $expenses->reported_by = $user->id;
        $expenses->status = 1;
        $expenses->save();

       $this->dispatch('expensesadded');
       $this->closeModal();
    } catch (\Exception $th) {
          DB::table('error_logs')->insert([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                'created_at' => now(),
      ]);
       $this->dispatch('expensesadderror');

    }
}

    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.expenses.modal.addexpensesmodal');
    }
}
