<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Unload;

use App\Models\Loadingproduct;
use App\Models\Saledispatch;
use Livewire\Component;
use Livewire\WithPagination;

class Unloaddashboard extends Component
{
      use WithPagination;

    public $search,$stdate,$eddate,$daterange;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['docreated'=>'render'];



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
    public function render()
    {
         $createddo=Saledispatch::where('status',1);
        if ($this->stdate && $this->eddate ) {
            $createddo->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $createddo->where(function ($query) {
                $query->where('do_no', 'like', '%' . $this->search . '%');

            });
        }
        $createddo=$createddo->paginate(20);
        return view('livewire.admin.dashboard.dep.sales.unload.unloaddashboard',compact('createddo'))->layout('livewire.admin.dashboard.layout.master');
    }
}
