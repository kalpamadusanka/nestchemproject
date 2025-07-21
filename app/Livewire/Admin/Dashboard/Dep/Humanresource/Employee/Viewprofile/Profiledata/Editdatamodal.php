<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewprofile\Profiledata;

use App\Models\Employee;
use Livewire\Component;

class Editdatamodal extends Component
{

    public $selectedid;
    public $firstname,$lastname,$address,$city,$contact,$birthday,$postalcode;
    public $empalldatamodal=false;
    protected $listeners = ['openinfomodal' => 'openModal'];

    public function openModal($id){
        $this->selectedid=$id;
      $this->empalldatamodal=true;
      $userData=Employee::where('user_id',$id)->first();
      $this->firstname=$userData->firstname;
      $this->lastname=$userData->lastname;
      $this->address=$userData->address;
      $this->city=$userData->city;
      $this->contact=$userData->contact;
      $this->birthday=$userData->birthday;
      $this->postalcode=$userData->postal_code;
    }
    public function submit(){
        $user=Employee::where('user_id',$this->selectedid)->first();
        $user->firstname=$this->firstname;
        $user->lastname=$this->lastname;
        $user->address=$this->address;
        $user->city=$this->city;
        $user->contact=$this->contact;
        $user->birthday=$this->birthday;
        $user->postal_code=$this->postalcode;
        // dd($user);
        $user->save();
        $this->empalldatamodal=false;
        $this->dispatch('empdataadded',$this->selectedid);
    }
    public function closeModal(){
        $this->empalldatamodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewprofile.profiledata.editdatamodal');
    }
}
