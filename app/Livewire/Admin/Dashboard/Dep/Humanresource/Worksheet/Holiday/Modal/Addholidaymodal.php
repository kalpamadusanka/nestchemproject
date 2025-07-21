<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Holiday\Modal;

use App\Models\Holiday;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addholidaymodal extends Component
{
    public $holiday_name,$holiday;
    public $openholidaymodal=false;
    protected $listeners = ['openholidaymodal' => 'openModal'];

    protected $rules=[
        'holiday_name'=>'required',
        'holiday'=>'required'
    ];

    public function openModal(){
     $this->openholidaymodal=true;
    }
    public function closeModal(){
        $this->openholidaymodal=false;
    }

     public function submit(){
      $this->validate();
      $user=Auth::user();
      $holiday=new Holiday();
      $holiday->holiday=$this->holiday_name;
      $holiday->date=$this->holiday;
      $holiday->added_by=$user->id;
      $holiday->status=1;
      $holiday->save();
      $this->reset();
      $this->closeModal();
      $this->dispatch('holidayadded');
     }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.worksheet.holiday.modal.addholidaymodal');
    }
}
