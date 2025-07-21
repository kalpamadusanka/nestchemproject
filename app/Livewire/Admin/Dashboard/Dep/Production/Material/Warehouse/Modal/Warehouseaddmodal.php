<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Warehouse\Modal;


use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Warehouseaddmodal extends Component
{

    public $warehousename;

    protected $rules =[
     'warehousename' => 'required'
    ];
    public $openwarehouseaddmodal=false;
    protected $listeners = ['openwarehouseAddModal' => 'openModal'];
    public function openModal(){
     $this->openwarehouseaddmodal=true;
    }

    public function closeModal(){
        $this->openwarehouseaddmodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
     $warehouseData=new Warehouse();
     $warehouseData->warehouse_name=$this->warehousename;
     $warehouseData->warehouse_code='WH-'.rand(1000,9999);
     $warehouseData->added_by=$user->id;
     $warehouseData->status=1;
     $warehouseData->save();
     $this->reset();
     $this->closeModal();
     $this->dispatch('warehouseAdded');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.material.warehouse.modal.warehouseaddmodal');
    }
}
