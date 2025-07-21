<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Vehicle;

use App\Models\Saledispatch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Vehicleinfodashboard extends Component
{
    public $doNo,$area,$selectedDriver;


    public function mount($do_no){
     $this->doNo=$do_no;
     $saleDispatch=Saledispatch::where('do_no',$this->doNo)->first();
     $this->area=$saleDispatch->area;
     $this->selectedDriver = $saleDispatch->driver;

    }
     public function addfuelrecord(){

      $this->dispatch('viewfuelmodal',$this->doNo);
    }
    public function render()
    {

        return view('livewire.admin.dashboard.dep.sales.distribute.orders.vehicle.vehicleinfodashboard')->layout('livewire.admin.dashboard.layout.master');
    }
}
