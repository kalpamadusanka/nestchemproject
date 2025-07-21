<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Modal;

use App\Models\Companyassets;
use Livewire\Component;

class Viewassetsmodal extends Component
{

    public $code,$item,$assigned_by,$description,$selectedId;
    public $viewassetsmodal=false;
    protected $listeners = ['viewassetdetailsmodal' => 'openModal'];

    public function openModal($id){
      $this->viewassetsmodal=true;
      $this->selectedId=$id;
      $assets=Companyassets::find($id);
      $this->code=$assets->code;
      $this->item=$assets->item;
      $this->assigned_by=$assets->added_user->name;
      $this->description=$assets->description;
      // dd($this->selectedId);
    }

    public function closeModal(){
        $this->viewassetsmodal=false;
    }

    public function submit(){
        $editassets=Companyassets::find($this->selectedId);
        $editassets->description=$this->description;
        $editassets->update();
        $this->closeModal();

    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.assets.modal.viewassetsmodal');
    }
}
