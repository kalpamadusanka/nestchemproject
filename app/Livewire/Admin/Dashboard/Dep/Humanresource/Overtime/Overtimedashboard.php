<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Overtime;

use App\Models\Overtimerequest;
use Livewire\Component;
use Livewire\WithPagination;

class Overtimedashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = ['overtime_requestadded' => 'render'];

    public function addovertimerequest(){
        $this->dispatch("openovertimerequestmodal");
    }

    public function addovertimecategory(){
     $this->dispatch("openovertimecategorymodal");
    }
    public function approverecord($id){
     $overtimestatus=Overtimerequest::find($id);
     $overtimestatus->approval_status=1;
     $overtimestatus->update();
     $this->render();
    }
    public function deleterequest($id){
        $overtimestatus=Overtimerequest::find($id);
        $overtimestatus->approval_status=0;
        $overtimestatus->delete();
        $this->render();
    }
    public function render()
    {
        $overtimerequest = Overtimerequest::where('status', 1)
    ->when($this->search, function ($query) {
        $query->where(function ($q) {
            $q->where('created_at', 'like', '%' . $this->search . '%') // Example field
              ->orWhereHas('employee', function ($q) {
                  $q->where('username', 'like', '%' . $this->search . '%'); // Assuming 'name' is in Employee model
              });
        });
    })
    ->paginate(10);

        return view('livewire.admin.dashboard.dep.humanresource.overtime.overtimedashboard',compact('overtimerequest'))->layout('livewire.admin.dashboard.layout.master');
    }
}
