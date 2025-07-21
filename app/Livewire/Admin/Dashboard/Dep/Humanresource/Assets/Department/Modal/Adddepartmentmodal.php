<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Department\Modal;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Adddepartmentmodal extends Component
{
    public $opendepartmentmodal=false;

    public $department;

    protected $rules =[
        'department' => 'required'
    ];
    protected $listeners = ['opendepartmentmodal' => 'openmodal'];
    public function openmodal(){
    $this->opendepartmentmodal=true;
    }
    public function closeModal(){
        $this->opendepartmentmodal=false;
    }

    public function submit(){
    $this->validate();
    $user=Auth::user();
    $department=new Department();
    $department->department_name=$this->department;
    $department->added_by=$user->id;
    $department->status=1;
    $department->save();
    $this->reset();
    $this->closeModal();
    $this->dispatch('departmentadded');

    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.assets.department.modal.adddepartmentmodal');
    }
}
