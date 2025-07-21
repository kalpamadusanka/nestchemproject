<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Warehouse;

use App\Models\Warehouse;
use Livewire\Component;

class Warehousedashboard extends Component
{

    public $search;

    protected $listeners = ['warehousedataupdated' => 'render','warehouseAdded'=>'render'];
    public function openwarehouseaddmodal(){
        $this->dispatch('openwarehouseAddModal');
    }

    public function editwarehousedata($id){
        $this->dispatch('openwarehouseEditModal',$id);
    }

    public function deletewarehousedata($id){
        $warehouse= Warehouse::find($id);
        $warehouse->status=0;
        $warehouse->update();
        $this->render();

    }
    public function render()
    {
        $warehousedata=Warehouse::where('status',1);
        if ($this->search) {
            $warehousedata->where(function ($query) {
                $query->where('warehouse_name', 'like', '%' . $this->search . '%');

            });
        }
        $warehousedata=$warehousedata->paginate(10);

        return view('livewire.admin.dashboard.dep.production.material.warehouse.warehousedashboard',compact('warehousedata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
