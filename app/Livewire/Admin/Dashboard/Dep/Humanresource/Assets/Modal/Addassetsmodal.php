<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Modal;

use App\Models\Assetstype;
use App\Models\Companyassets;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addassetsmodal extends Component
{
    public $employees,$types,$department;
    public $empname,$code,$item,$type,$departmentname,$description;
    protected $listeners = ['openassetsmodal' => 'openModal'];
    public $openaddassetsmodal=false;

    protected $rules =[
     'empname'=>'required',
     'code' => 'required|unique:company_assets',
     'item'=>'required',
     'type'=>'required',
     'departmentname'=>'required',

    ];

    public function openModal(){
        $this->openaddassetsmodal=true;
    }
    public function mount(){
        $this->employees=Employee::all();
        $this->types=Assetstype::where('status',1)->get();
        $this->department=Department::where('status',1)->get();
    }
    public function closeModal(){
        $this->openaddassetsmodal=false;
    }
    public function submit(){
        $this->validate();
        $user=Auth::user();
        $companyassets=new Companyassets();
        $companyassets->empid=$this->empname;
        $companyassets->code=$this->code;
        $companyassets->item=$this->item;
        $companyassets->type=$this->type;
        $companyassets->department=$this->departmentname;
        $companyassets->description=$this->description;
        $companyassets->added_by=$user->id;
        $companyassets->status=1;
        $companyassets->save();
        $this->closeModal();
        $this->reset();
        $this->dispatch('comapnyassetsadded');
        $this->mount();
    }
    public function render()
    {
        $this->mount();
        return view('livewire.admin.dashboard.dep.humanresource.assets.modal.addassetsmodal');
    }
}
