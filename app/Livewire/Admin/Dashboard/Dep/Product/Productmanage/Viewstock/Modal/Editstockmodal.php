<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Viewstock\Modal;

use App\Models\Productstock;
use Livewire\Component;

class Editstockmodal extends Component
{
    public $exp_date,$lot,$selectedId,$unitprice;
    public $openstockeeditmodal=false;

    protected $listeners = ['editstockmodal' => 'openModal'];
    public function openModal($id){
      $this->selectedId=$id;
      $productStockrecord=Productstock::where('id',$this->selectedId)->first();
      $this->lot=$productStockrecord->lot;
      $this->exp_date=$productStockrecord->exp_date;
      $this->unitprice=$productStockrecord->unit_price;
      $this->openstockeeditmodal=true;
    }

    public function submit(){
        $productStock=Productstock::where('id',$this->selectedId)->first();
        $productStock->lot=$this->lot;
        $productStock->exp_date=$this->exp_date;
        $productStock->unit_price=$this->unitprice;
        $productStock->save();
        $this->dispatch('productstockrecordupdated');
    }

    public function closeModal(){
        $this->openstockeeditmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.product.productmanage.viewstock.modal.editstockmodal');
    }
}
