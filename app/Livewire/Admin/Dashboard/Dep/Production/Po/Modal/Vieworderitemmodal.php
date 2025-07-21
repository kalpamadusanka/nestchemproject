<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Po\Modal;

use App\Models\Poitems;
use Livewire\Component;

class Vieworderitemmodal extends Component
{

    public $selectedId,$purchaseorderitems;
    public $openorderitemsmodal=false;

    protected $listeners = ['viewporderitemmodal' => 'openModal'];

    public function openModal($id){
     $this->openorderitemsmodal = true;
     $this->selectedId = $id;
     $this->purchaseorderitems=Poitems::where('purchase_order_id', $this->selectedId)->get();
    }
    public function closeModal(){
        $this->openorderitemsmodal = false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.po.modal.vieworderitemmodal');
    }
}
