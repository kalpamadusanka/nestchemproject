<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Vehicle\Fuel;

use App\Models\Fuelrecord;
use Livewire\Component;

class Fuelmanage extends Component
{
    public $dono,$fuelRecord;
    protected $listeners = ['fuelRecordAdded' => 'mount'];
    public function mount($doNo){
      $this->dono=$doNo;
      $this->fuelRecord=Fuelrecord::where('do_no',$doNo)->get();
    }

    public function deleteRecord($id){
        $fuelrecord=Fuelrecord::where('id',$id)->first();
        $fuelrecord->delete();
        $this->mount($this->dono);
        $this->dispatch('fuelrecorddeleted');
      }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.vehicle.fuel.fuelmanage');
    }
}
