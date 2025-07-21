<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Modal;

use App\Models\Employee;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addworkmodal extends Component
{
    public $employees;
    public  $empname,$task,$deadline,$total_hours,$note;
    public $openworkmodal=false;

    protected $rules=[
        'empname' =>'required',
        'total_hours' =>'required',
    ];
    protected $listeners = ['openworksheetmodal' => 'openModal'];

    public function openModal(){
        $this->openworkmodal=true;
    }

    public function closeModal(){
        $this->openworkmodal=false;
    }

    public function mount(){
        $this->employees = Employee::all();
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $todaywork=new Worksheet();
        $todaywork->employee=$this->empname;
        $todaywork->task=$this->task;
        $todaywork->deadline=$this->deadline;
        $todaywork->worked_hours=$this->total_hours;
        $todaywork->date=Carbon::now();
        $todaywork->note=$this->note;
        $todaywork->added_by=$user->id;
        $todaywork->status=1;
        $todaywork->save();
        $this->reset();
        $this->closeModal();
        $this->dispatch('worksheetdataadded');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.worksheet.modal.addworkmodal');
    }
}
