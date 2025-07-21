<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Category\Modal;

use App\Models\Materialcategory;
use Livewire\Component;

class Editcategorymodal extends Component
{
    public $openmaterialcategory=false;

    public $category_name,$value,$selectedmaterialId;
    protected $listeners = ['openeditmaterialmodal' => 'openModal'];

    protected $rules=[
        'category_name'=>'required|unique:material_category',
    ];

    public function openModal($id){
        $this->selectedmaterialId=$id;
     $this->openmaterialcategory=true;
      $categorydata=Materialcategory::where('id',$id)->first();
      $this->category_name=$categorydata->category_name;
      $this->value=$categorydata->value;

    }

    public function closeModal(){
        $this->openmaterialcategory=false;
    }

    public function submit(){
       $materialcategory=Materialcategory::find($this->selectedmaterialId);
       $materialcategory->category_name=$this->category_name;
       $materialcategory->value=$this->value;
       $materialcategory->update();
       $this->dispatch('materialcategoryupdated');
       $this->closeModal();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.material.category.modal.editcategorymodal');
    }
}
