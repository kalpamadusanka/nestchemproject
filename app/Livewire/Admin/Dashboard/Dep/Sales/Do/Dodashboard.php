<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Do;

use App\Models\Loadingproduct;
use App\Models\Saledispatch;
use Livewire\Component;
use Livewire\WithPagination;

class Dodashboard extends Component
{
    use WithPagination;

    public $search,$stdate,$eddate,$daterange;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['docreated'=>'render'];
    public function opendomodal(){
        $this->dispatch('opendomodal');
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
    public function deletedata($id){
      $selectedDo=Saledispatch::find($id);
      if($selectedDo->loading_store_keeper){
        $this->dispatch('errordeletedo');
      }
      else{
        $selectedDo->delete();
        $this->dispatch('deletedo');
        $this->loadingproductdelete($selectedDo->do_no);
      }
    }

    public function loadingproductdelete($doNo){
     $loadingProduct=Loadingproduct::where('do_no', $doNo)->delete();

    }
    public function render()
    {
        $saledispatch=Saledispatch::where('status',1);
        if ($this->stdate && $this->eddate ) {
            $saledispatch->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $saledispatch->where(function ($query) {
                $query->where('do_no', 'like', '%' . $this->search . '%');

            });
        }
        $saledispatch=$saledispatch->paginate(10);
        return view('livewire.admin.dashboard.dep.sales.do.dodashboard',compact('saledispatch'))->layout('livewire.admin.dashboard.layout.master');
    }
}
