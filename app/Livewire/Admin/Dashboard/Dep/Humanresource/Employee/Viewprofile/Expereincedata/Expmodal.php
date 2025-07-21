<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewprofile\Expereincedata;

use App\Models\Empworkexperiencedetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Expmodal extends Component
{
    public $selectedid,$employer,$position,$timeframe,$start_date,$end_date;
    public $viewexpdatamodal=false;
    protected $listeners = ['openexpereincemodal' => 'openModal'];
    protected $rules =[
        'employer'=>'required',
        'position'=>'required',
        'start_date'=>'required',
        'end_date'=>'required',
     ];

    public function openModal($id){
        $this->selectedid=$id;
        $this->viewexpdatamodal=true;
    }
    public function closeModal(){
        $this->viewexpdatamodal=false;
    }

    public function submit(){
     $this->validate();
     $user=Auth::user();
     $expData=new Empworkexperiencedetails();
     $expData->empid=$this->selectedid;
     $expData->employer=$this->employer;
     $expData->position=$this->position;
     $this->timeframe = $this->start_date . ' - ' . $this->end_date;
     $expData->daterange=$this->timeframe;
     $expData->added_by=$user->id;
     $expData->status=1;
     $expData->save();
     // dd($expData);
     $this->dispatch('expdataadded',$this->selectedid);
     $this->closeModal();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewprofile.expereincedata.expmodal');
    }
}
