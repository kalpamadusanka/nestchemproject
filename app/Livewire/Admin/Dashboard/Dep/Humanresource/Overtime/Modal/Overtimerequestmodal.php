<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Overtime\Modal;

use App\Models\Employee;
use App\Models\Overtimecategory;
use App\Models\Overtimerequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Overtimerequestmodal extends Component
{

    public $openovertimerequestmodal=false;
    public $note,$emp,$category,$start_time,$end_time;
    protected $listeners = ['openovertimerequestmodal' => 'openModal'];

    protected $rules =[
      'emp'=>'required',
      'category'=>'required',
      'start_time'=>'required',
      'end_time'=>'required',

    ];


    public function openModal(){
     $this->openovertimerequestmodal=true;
    }
    public function closeModal(){
        $this->openovertimerequestmodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
      $overtimereq=new Overtimerequest();
      $overtimereq->employee_id=$this->emp;
      $overtimereq->category_id=$this->category;
      $overtimereq->start_time=$this->start_time;
      $overtimereq->end_time=$this->end_time;
      $overtimereq->approval_status=0;
      $overtimereq->note=$this->note;
      $overtimereq->added_by=$user->id;
      $overtimereq->status=1;
      $overtimereq->save();
      $this->closeModal();
      $this->reset();
      $this->dispatch('overtime_requestadded');

    }

    public function render()
    {
        $categories=Overtimecategory::all();
        $employees = Employee::all();
        return view('livewire.admin.dashboard.dep.humanresource.overtime.modal.overtimerequestmodal',compact('categories','employees'));
    }
}
