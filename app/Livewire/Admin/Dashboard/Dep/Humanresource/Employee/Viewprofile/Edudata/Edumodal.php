<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewprofile\Edudata;

use App\Models\Empedudetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edumodal extends Component
{

    public $selectedid,$institute,$subject,$timeframe,$start_date,$end_date;
    public $viewedudatamodal=false;
    protected $listeners = ['openedumodal' => 'openModal'];

    protected $rules =[
       'institute'=>'required',
       'subject'=>'required',
       'start_date'=>'required',
       'end_date'=>'required',
    ];

    public function openModal($id){
        $this->selectedid=$id;
     $this->viewedudatamodal=true;
    }
    public function closeModal(){
        $this->viewedudatamodal=false;
    }
    public function submit(){
      $this->validate();
      $user=Auth::user();
      $eduData=new Empedudetails();
      $eduData->empid=$this->selectedid;
      $eduData->institute=$this->institute;
      $eduData->subject=$this->subject;
      $this->timeframe = $this->start_date . ' - ' . $this->end_date;
      $eduData->daterange=$this->timeframe;
      $eduData->added_by=$user->id;
      $eduData->status=1;
      $eduData->save();
      $this->dispatch('edudataadded',$this->selectedid);
      $this->closeModal();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewprofile.edudata.edumodal');
    }
}
