<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewprofile\Familydata;

use App\Models\Empfamilydetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Familymodal extends Component
{

    public $personname,$relationship,$contact,$dob;
    public $selectedid;
    public $viewfamilydatamodal=false;
    protected $listeners = ['openfamilymodal' => 'openModal'];

    protected $rules =[
        'personname'=>'required',
        'relationship'=>'required',
        'contact'=>'required',
        'dob'=>'required',
      ];

    public function openModal($id){
        $this->selectedid=$id;
        $this->viewfamilydatamodal=true;
    }
    public function closeModal(){
        $this->viewfamilydatamodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $familydata=new Empfamilydetails();
        $familydata->empid=$this->selectedid;
        $familydata->name=$this->personname;
        $familydata->relationship=$this->relationship;
        $familydata->phone=$this->contact;
        $familydata->dob=$this->dob;
        $familydata->added_by=$user->id;
        $familydata->status=1;
        $familydata->save();

        $this->dispatch('familydetailsadded',$this->selectedid);
        $this->closeModal();


    }

    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewprofile.familydata.familymodal');
    }
}
