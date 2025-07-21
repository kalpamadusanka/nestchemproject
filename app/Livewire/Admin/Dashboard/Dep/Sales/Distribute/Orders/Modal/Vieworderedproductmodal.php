<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Modal;

use App\Models\Salesorder;
use App\Models\Salesorderitem;
use Livewire\Component;

class Vieworderedproductmodal extends Component
{
    public $salesorderItem;
    public $opensalesproduct=false;
    protected $listeners = ['vieworderedproductmodal' => 'openModal'];

    public function openModal($id){
      $this->opensalesproduct=true;
      $saleDetails=Salesorder::where('id',$id)->first();
      $this->salesorderItem=Salesorderitem::where('order_no',$saleDetails->order_no)->get();

    }

    public function closeModal(){
        $this->opensalesproduct=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.modal.vieworderedproductmodal');
    }
}
