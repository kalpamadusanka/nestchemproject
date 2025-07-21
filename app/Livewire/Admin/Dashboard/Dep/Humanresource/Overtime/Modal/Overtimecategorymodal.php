<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Overtime\Modal;

use App\Models\Overtimecategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Overtimecategorymodal extends Component
{
    public $openovertimecategorymodal=false;

    public $category_name;
    protected $listeners = ['openovertimecategorymodal' => 'openModal'];

    protected $rules=[
      'category_name'=>'required|unique:overtime_category'
    ];

    public function openModal(){
        $this->openovertimecategorymodal=true;
    }
    public function closeModal(){
        $this->openovertimecategorymodal=false;
    }
    public function submit(){
        $this->validate();
        $user=Auth::user();
        $overtimecategory=new Overtimecategory();
        $overtimecategory->category_name=$this->category_name;
        $overtimecategory->added_by=$user->id;
        $overtimecategory->status=1;
        $overtimecategory->save();
        $this->closeModal();
    }

    public function deleteCategory($id){
        $overtimecategory=Overtimecategory::find($id);
        $overtimecategory->delete();
        // $this->closeModal();
        $this->render();
    }
    public function render()
    {
        $categories=Overtimecategory::all();
        return view('livewire.admin.dashboard.dep.humanresource.overtime.modal.overtimecategorymodal',compact('categories'));
    }
}
