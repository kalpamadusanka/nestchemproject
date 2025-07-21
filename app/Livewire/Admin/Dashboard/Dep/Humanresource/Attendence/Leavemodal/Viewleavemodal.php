<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Attendence\Leavemodal;

use Livewire\Component;

class Viewleavemodal extends Component
{

    public $emp_name,$leave_type,$from_date,$to_date,$no_of_date,$remaining_date,$reason;
    public $openleaveviewmodal=false;
    protected $listeners = ['openLeaveviewModal' => 'openviewModal'];

    public function openviewModal($id){
     $this->openleaveviewmodal=true;
     $leave = \App\Models\Leave::find($id);
     $this->emp_name = $leave->employee->username;
     $this->leave_type = $leave->leave_type;
     $this->from_date = $leave->from_date;
     $this->to_date = $leave->to_date;
     $this->no_of_date = $leave->no_of_date;
     $this->remaining_date = $leave->remaining_leave;
     $this->reason = $leave->reason;
    }

    public function closeModal(){
        $this->openleaveviewmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.attendence.leavemodal.viewleavemodal');
    }
}
