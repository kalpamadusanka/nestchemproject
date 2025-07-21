<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Track;

use App\Models\Salesorder;
use Livewire\Component;

class Trackingorder extends Component
{

    public $saleId,$latitude,$longitude;

    public function mount($saleorder){
      $this->saleId=$saleorder;
      $saleData=Salesorder::where('id',$this->saleId)->first();
      $this->latitude=$saleData->latitude;
      $this->longitude=$saleData->longitude;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.track.trackingorder')->layout('livewire.admin.dashboard.layout.master');
    }
}
