<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute;

use App\Models\Saledispatch;
use App\Models\Salesorder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Distributedashboard extends Component
{
    use WithPagination;

    public $search,$stdate,$eddate,$daterange;
    public bool $isJobChecked = false;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['docreated'=>'render','dostarted'=>'render','doended'=>'render'];
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

    public function start($do){
     $doData=Saledispatch::where('do_no',$do)->first();
     $doData->start_time=Carbon::now();
     $doData->save();
     $this->dispatch('dostarted');
    }

    public function end($do){
        $doData=Saledispatch::where('do_no',$do)->first();
        $doData->end_time=Carbon::now();
        $doData->save();
        $this->dispatch('doended');
    }
    public function render()
    {
        $user=Auth::user();


        if($this->isJobChecked){
            $createddo=Saledispatch::where('status',1)->whereNotNull('loading_store_keeper')->where('sale_represntative',$user->id);
            if ($this->stdate && $this->eddate ) {
                $createddo->whereBetween('created_at', [$this->stdate, $this->eddate]);
            }
            if ($this->search) {
                $createddo->where(function ($query) {
                    $query->where('do_no', 'like', '%' . $this->search . '%');

                });
            }
        }
        else{
            $createddo=Saledispatch::where('status',1)->whereNotNull('loading_store_keeper');
        if ($this->stdate && $this->eddate ) {
            $createddo->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $createddo->where(function ($query) {
                $query->where('do_no', 'like', '%' . $this->search . '%');

            });
        }

        }
        $createddo=$createddo->paginate(100);

        return view('livewire.admin.dashboard.dep.sales.distribute.distributedashboard',compact('createddo','user'))->layout('livewire.admin.dashboard.layout.master');
    }
}
