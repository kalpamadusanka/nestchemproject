<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Department;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Adddepartment extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = ['departmentadded' => 'render','departmentupdated'=>'render'];
    public function opendepartmentmodal(){
        $this->dispatch('opendepartmentmodal');
    }

    public function activedepartment($id){
        $department=Department::find($id);
        $department->status=1;
        $department->update();
        $this->dispatch('departmentupdated');

    }
    public function deletedepartment($id){
        $department=Department::find($id);
        $department->delete();
        $this->dispatch('departmentupdated');
    }

    public function deactivedepartment($id){
        $department=Department::find($id);
        $department->status=0;
        $department->update();
        $this->dispatch('departmentupdated');
    }
    public function render()
    {
        $departments= Department::whereNotNull('status')
        ->when($this->search, function ($query, $search) {
            return $query->where('department_name', 'like', '%' . $search . '%'); // Search by asset name // Search by asset description
        })
        ->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.assets.department.adddepartment',compact('departments'))->layout('livewire.admin.dashboard.layout.master');
    }
}
