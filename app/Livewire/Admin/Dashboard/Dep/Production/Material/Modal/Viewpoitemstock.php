<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Modal;

use App\Models\Material;
use App\Models\Materialstock;
use App\Models\Poitems;
use Livewire\Component;

class Viewpoitemstock extends Component
{
    public $selectedID,$purchaseorderitems;
    public $openstockitemsmodal=false;
    protected $listeners = ['viewstockruningmodal' => 'openModal'];

    public function openModal($id){

   $this->selectedID = $id;
   $this->openstockitemsmodal = true;

   $this->purchaseorderitems= Materialstock::where('material_id', $this->selectedID )
   ->whereHas('materialData', function ($query) {
    $query->where('status', 1);
})->get();


    }
    public function closeModal(){
        $this->openstockitemsmodal = false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.material.modal.viewpoitemstock');
    }
}
