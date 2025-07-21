<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Po\Modal;

use App\Models\Popayment;
use App\Models\Purchaseorder;
use Livewire\Component;

class Viewfilemodal extends Component
{
    public $openfilepreviewmodal=false;

    public $documents;
    protected $listeners = ['viewfilemodal' => 'openModal'];

    public function openModal($id){

      $this->openfilepreviewmodal = true;
     try {
        $purchaseOrder=Popayment::where('id',$id)->first();
        if($purchaseOrder->file == null){
          $this->dispatch('documentnotfound');
        }
        else{
          $this->documents=$purchaseOrder->file;
        }
     } catch (\Throwable $th) {

     }

    }
    public function closeModal(){
        $this->openfilepreviewmodal = false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.po.modal.viewfilemodal');
    }
}
