<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders;

use App\Models\Salesorder;
use Livewire\Component;
use Livewire\WithPagination;

class Doordersdashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $doNo,$search,$stdate,$eddate,$daterange;

    public function mount($do_no){
        $this->doNo=$do_no;
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

    public function orderedproduct($id){
        $this->dispatch('vieworderedproductmodal',$id);
    }
    public function tracklocation($id){
        $this->dispatch('vieworderedlocationmodal',$id);
    }
    public function render()
    {
        $salesorder=Salesorder::where('status',1)->where('do_no',$this->doNo);
        if ($this->stdate && $this->eddate ) {
            $salesorder->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $salesorder->where(function ($query) {
                $query->where('do_no', 'like', '%' . $this->search . '%');

            });
        }
        $salesorder=$salesorder->paginate(10);
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.doordersdashboard',compact('salesorder'))->layout('livewire.admin.dashboard.layout.master');
    }
}
