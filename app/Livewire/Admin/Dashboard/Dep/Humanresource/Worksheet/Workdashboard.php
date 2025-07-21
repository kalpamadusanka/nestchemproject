<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet;

use App\Models\Worksheet;
use Livewire\Component;
use Livewire\WithPagination;

class Workdashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search,$stdate,$eddate,$daterange,$totalworkedhours;
    protected $listeners = ['worksheetdataadded' => 'render'];
    public function opentodaysworkmodal(){
      $this->dispatch('openworksheetmodal');
    }

    public function deactiveworkrecord($id){
     $workrecord=Worksheet::find($id);
     $workrecord->status=0;
     $workrecord->update();
     $this->dispatch('worksheetdataadded');
    }

    public function deleteworksheetdata($id){
      Worksheet::find($id)->delete();
      $this->dispatch('worksheetdataadded');
    }
    public function activerecord($id){
        $workrecord=Worksheet::find($id);
        $workrecord->status=1;
        $workrecord->update();
        $this->dispatch('worksheetdataadded');
    }

    public function editworksheetdata($id){
        $this->dispatch('editworksheetdata',$id);
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
        $workdata =Worksheet::whereNotNull('status');

        // Apply date filter if both dates are set
        if ($this->stdate && $this->eddate && $this->search) {
            $workdata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }

        if ($this->search) {
            $workdata->whereHas('employeeData', function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%');
            });
            $this->totalworkedhours=$workdata->sum('worked_hours');
        }
        $workdata = $workdata->paginate(10);

        return view('livewire.admin.dashboard.dep.humanresource.worksheet.workdashboard',compact('workdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
