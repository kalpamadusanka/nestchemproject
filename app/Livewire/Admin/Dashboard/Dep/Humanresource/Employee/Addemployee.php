<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addemployee extends Component
{
    public $username,$email,$contact,$postalcode,$country,$city,$address,$lastname,$firstname,$userId,$gender,$birthday;
public $suggestions = [];

    public function showSuggestions()
    {
        $this->suggestions = User::where('name', 'like', $this->username . '%')->limit(5)->get();
    }

    public function hideSuggestions()
    {
        $this->suggestions = [];
    }

    public function updatedUsername()
    {
        // Keep the suggestions updated when the username is changed
        $this->suggestions = User::where('name', 'like', $this->username . '%')->limit(5)->get();

    }
    public function selectOption($id){
       $this->userId=$id;
       $this->username = User::find($id)->name;
       $this->email=User::find($id)->email;
    }
    public function submit(){
      $currentuser=Auth::user();
      $employee=new Employee();
      $employee->username=$this->username;
      $employee->email=$this->email;
      $employee->firstname=$this->firstname;
      $employee->lastname=$this->lastname;
      $employee->address=$this->address;
      $employee->city=$this->city;
      $employee->country=$this->country;
      $employee->postal_code=$this->postalcode;
      $employee->contact=$this->contact;
      $employee->gender=$this->gender;
      $employee->birthday=$this->birthday;
      $employee->user_id=$this->userId ?? 0;
      $employee->added_by=$currentuser->id;
      $employee->status=1;
      $result=$employee->save();
      if($result){
        $this->dispatch('employeedetailsadded');
        $this->reset();

      }
      else{
        $this->dispatch('employeedetailserror');
      }


    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.addemployee')->layout('livewire.admin.dashboard.layout.master');
    }
}
