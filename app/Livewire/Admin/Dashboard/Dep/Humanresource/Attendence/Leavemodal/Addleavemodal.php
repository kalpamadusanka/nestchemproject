<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Attendence\Leavemodal;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addleavemodal extends Component
{
    public $employees,$empname,$leave_type,$from_date,$to_date,$no_of_date,$remaining_date,$reason;
    public $openleavemodal=false;
    protected $listeners = ['openLeaveModal' => 'openModal'];

    protected $rules=[
        'empname'=>'required',
        'leave_type'=>'required',
        'from_date'=>'required',
        'to_date'=>'required',
        'no_of_date'=>'required',
        'remaining_date'=>'required',
        'reason'=>'required',
    ];

    public function openModal(){
        $this->openleavemodal=true;
    }
    public function closeModal(){
        $this->openleavemodal=false;
    }

    public function mount(){
        $this->employees=Employee::all();
    }
    public function submit(){
      $this->validate();
      $leave=new Leave();
      $leave->empid=$this->empname;
      $leave->leave_type=$this->leave_type;
      $leave->from_date=$this->from_date;
      $leave->to_date=$this->to_date;
      $leave->no_of_date=$this->no_of_date;
      $leave->remaining_leave=$this->remaining_date;
      $leave->to_date=$this->to_date;
      $leave->reason=$this->reason;
      $leave->added_by=Auth::user()->id;
      $leave->leave_status='pending';
      $leave->status=1;
      $leave->save();
      $this->closeModal();
      $this->dispatch('employeeleaveadded');

    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.attendence.leavemodal.addleavemodal');
    }
}
