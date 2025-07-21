<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Request;

use App\Models\Material;
use App\Models\Materialrequest as ModelsMaterialrequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Materialrequest extends Component
{
    use WithPagination;

    public $search,$stdate,$eddate,$daterange;
    protected $paginationTheme = 'bootstrap';


    protected $listeners = ['requestupdated' => 'render','materialIssuedconfirmed'=>'render'];
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

       public function transferred($id){
        $this->dispatch('materialissued',$id);


       }

       public function decline($id){
        $this->dispatch('declinedmodal',$id);

       }
    public function render()
    {
        $requestdata=ModelsMaterialrequest::where('status',1);
        if ($this->stdate && $this->eddate ) {
            $requestdata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $requestdata->where(function ($query) {
                $query->where('req_code', 'like', '%' . $this->search . '%');

            });
        }
        $requestdata=$requestdata->paginate(10);
        return view('livewire.admin.dashboard.dep.production.material.request.materialrequest',compact('requestdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
