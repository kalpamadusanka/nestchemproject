<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Warehouse\Modal;

use App\Models\Warehouse;
use Livewire\Component;

class Warehouseeditmodal extends Component
{

    public $warehousename,$selectedid;
    public $openwarehouseeditmodal=false;
    protected $listeners = ['openwarehouseEditModal' => 'openModal'];

    public function openModal($id){
        $this->selectedid=$id;
      $this->openwarehouseeditmodal=true;
      $warehouseData=Warehouse::where('id',$id)->first();
       $this->warehousename=$warehouseData->warehouse_name;
    }
    public function submit(){
        // dd($this->warehousename);
        $warehouseData=Warehouse::where('id',$this->selectedid)->first();
        $warehouseData->warehouse_name=$this->warehousename;
        $warehouseData->update();
        $this->closeModal();
        $this->dispatch('warehousedataupdated');
    }

    public function closeModal(){
        $this->openwarehouseeditmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.material.warehouse.modal.warehouseeditmodal');
    }
}
