<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Datacollection;

use App\Models\Hrdata;
use Livewire\Component;
use Livewire\WithPagination;

class Datadashboard extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$stdate,$eddate,$daterange;
    protected $listeners = ['hrdataadded' => 'render','removedhrdata'=>'render'];
    public function openadddatamodal(){
      $this->dispatch('openaddDataModal');
    }

    public function viewfiles($id){
        $this->dispatch('openviewDataModal', $id);
    }
    public function uploadfile($id){
        $this->dispatch('openuploadfileModal', $id);
    }

    public function deletedata($id){
        $hrdata=Hrdata::find($id);
        $hrdata->delete();
        $this->dispatch('removedhrdata');
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
    public function render()
    {
        $hrdata =Hrdata::whereNotNull('status');
        if ($this->search) {
            $hrdata->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');

            });
        }
        if ($this->stdate && $this->eddate) {
            $hrdata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }

        $hrdata = $hrdata->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.datacollection.datadashboard',compact('hrdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
