<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Attendence\Monitorattendence\Modal;

use App\Models\Empattendence;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addattendencemodal extends Component
{
    public $employees;
    public $empname,$intime,$outtime,$note;
    public $openattendencemodal=false;

    protected $listeners = ['openattendenceModal' => 'openModal'];

    protected $rules=[
     'empname'=>'required',
     'intime'=>'required',
     'outtime'=>'required',

    ];

    public function openModal(){
    $this->openattendencemodal=true;
    }
    public function mount(){
        $this->employees = Employee::all();
    }
    public function closeModal(){
        $this->openattendencemodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $attendence=new Empattendence();
        $attendence->employee=$this->empname;
        $attendence->timein=$this->intime;
        $attendence->timeout=$this->outtime;
        $timeIn = Carbon::parse($this->intime);
        $timeOut = Carbon::parse($this->outtime);
        $workedMinutes = abs($timeOut->diffInMinutes($timeIn));
        $workedHours = $workedMinutes / 60;
        $attendence->worked_hours = $workedHours;
        $attendence->note=$this->note;
        $attendence->added_by=$user->id;
        $attendence->status=1;
        $attendence->save();
        $this->closeModal();
        $this->dispatch('attendenceadded');
        // $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.attendence.monitorattendence.modal.addattendencemodal');
    }
}
