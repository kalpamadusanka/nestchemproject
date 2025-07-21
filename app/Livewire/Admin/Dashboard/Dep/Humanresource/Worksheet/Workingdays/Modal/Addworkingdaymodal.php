<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Workingdays\Modal;

use App\Models\Workday;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addworkingdaymodal extends Component
{
    public $date;
    public $openworkingdaymodal=false;

    protected $rules=['date' =>'required'];
    protected $listeners = ['workdaymodalopen' => 'openModal'];

    public function openModal(){
        $this->openworkingdaymodal=true;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $workingday=new Workday();
        $workingday->workday='Work day';
        $workingday->date=$this->date;
        $workingday->added_by=$user->id;
        $workingday->status=1;
        $workingday->save();
        $this->reset();
        $this->closeModal();
        $this->dispatch('workingdaysadded');
    }
    public function closeModal(){
        $this->openworkingdaymodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.worksheet.workingdays.modal.addworkingdaymodal');
    }
}
