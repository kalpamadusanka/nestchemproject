<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Po\Modal;

use App\Models\Popayment;
use Livewire\Component;

class Viewpaymentmodal extends Component
{
    public $openpaymentmodal=false;
    public $selectedId;
    protected $listeners = ['viewpaymentsmodal' => 'openModal'];

    public function openModal($id){
     $this->selectedId = $id;
     $this->openpaymentmodal = true;
    }
    public function closeModal(){
        $this->openpaymentmodal = false;
    }

    public function viewdoc($id){

        $this->dispatch('viewfilemodal',$id);
        $this->closeModal();
    }
    public function submit(){

    }
    public function render()
    {
        $payments=Popayment::where('purchase_order_id', $this->selectedId)->get();
        return view('livewire.admin.dashboard.dep.production.po.modal.viewpaymentmodal',compact('payments'));
    }
}
