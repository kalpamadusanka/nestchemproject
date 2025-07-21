<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewemployee;

use App\Models\Employee;
use Livewire\Component;

class Editmodal extends Component
{
    public $firstname,$lastname,$address,$city,$contact,$userid;
    public $viewuserdetailmodal=false;
    protected $listeners = ['editemployeemodal' => 'openModal'];

    protected $rules = [
        'firstname' => 'required',
        'lastname'=>'required',
        'address' => 'required',
        'city'=>'required',
        'contact'=>'required',

    ];

    public function openModal($id)
    {

        $this->userid=$id;
      $this->viewuserdetailmodal=true;
      $userData=Employee::where('user_id',$id)->first();
      $this->firstname=$userData->firstname;
      $this->lastname=$userData->lastname;
      $this->address=$userData->address;
      $this->city=$userData->city;
      $this->contact=$userData->contact;

    }
    public function submit(){
        $this->validate();
       $user=Employee::where('user_id',$this->userid)->first();
       $user->firstname=$this->firstname;
       $user->lastname=$this->lastname;
       $user->address=$this->address;
       $user->city=$this->city;
       $user->contact=$this->contact;
       $user->save();
       $this->viewuserdetailmodal=false;
    }
    public function closeModal(){
        $this->viewuserdetailmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewemployee.editmodal');
    }
}
