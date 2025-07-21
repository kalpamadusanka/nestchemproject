<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Attendence\Leavemodal;

use App\Models\Employee;
use App\Models\Leave;
use Livewire\Component;

class Editleavemodal extends Component
{
    public $empname,$leave_type,$from_date,$to_date,$no_of_date,$remaining_date,$reason,$employees,$selectedid;
    public $openleaveeditmodal=false;
    protected $listeners = ['openLeaveeditModal' => 'openeditModal'];

    public function openeditModal($id){
       $this->selectedid=$id;
        $leaveData=Leave::find($id);

        $this->empname=$leaveData->empid;
        $this->leave_type=$leaveData->leave_type;
        $this->from_date=$leaveData->from_date;
        $this->to_date=$leaveData->to_date;
        $this->no_of_date=$leaveData->no_of_date;
        $this->remaining_date=$leaveData->remaining_leave;
        $this->reason=$leaveData->reason;
        $this->openleaveeditmodal=true;
    }
    public function mount(){
        $this->employees=Employee::all();
    }

    public function closeModal(){
        $this->openleaveeditmodal=false;
    }
    public function submit(){
     $leaveData=Leave::find($this->selectedid);
     $leaveData->empid=$this->empname;
     $leaveData->leave_type=$this->leave_type;
     $leaveData->from_date=$this->from_date;
     $leaveData->to_date=$this->to_date;
     $leaveData->no_of_date=$this->no_of_date;
     $leaveData->remaining_leave=$this->remaining_date;
     $leaveData->reason=$this->reason;
     $leaveData->save();
     $this->closeModal();
     $this->dispatch('leavedataupdated');
    }
    public function render()
    {

        return view('livewire.admin.dashboard.dep.humanresource.attendence.leavemodal.editleavemodal');
    }
}
