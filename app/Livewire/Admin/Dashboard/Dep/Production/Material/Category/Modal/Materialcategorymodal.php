<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Category\Modal;

use App\Models\Materialcategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Materialcategorymodal extends Component
{
    public $openmaterialaddcategorymodal=false;

    public $category_name,$value;

    protected $rules=[
        'category_name'=>'required|unique:material_category',
    ];
    protected $listeners = ['openmaterialcategorymodal' => 'openModal'];

    public function openModal(){
     $this->openmaterialaddcategorymodal=true;
    }

    public function closeModal(){
        $this->openmaterialaddcategorymodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $materialcategory=new Materialcategory();
        $materialcategory->category_name=$this->category_name;
        $materialcategory->category_code='MC-'.rand(1000,9999);
        $materialcategory->value=$this->value ?? '';
        $materialcategory->added_by=$user->id;
        $materialcategory->status=1;
        $materialcategory->save();
        $this->reset();
        $this->closeModal();
        $this->dispatch('materialcategoryadded');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.material.category.modal.materialcategorymodal');
    }
}
