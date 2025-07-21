<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Viewstock\Modal;

use App\Models\ShelfData;
use Livewire\Component;

class Viewshelfmodal extends Component
{
    public $selectedId,$shelfdetails;
    public $openshelfviewmodal=false;
    protected $listeners = ['viewshelfmodal' => 'openModal'];

    public function openModal($id){
        $this->selectedId=$id;
     $this->openshelfviewmodal=true;
     $this->shelfdetails=ShelfData::where('product_stock_id',$this->selectedId)->get();
    }
    public function closeModal(){
        $this->openshelfviewmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.product.productmanage.viewstock.modal.viewshelfmodal');
    }
}
