<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Supplier\Modal;

use App\Models\Supplier;
use Livewire\Component;

class Editsuppliermodal extends Component
{
    public $selectedId;
    public $opensuppliereditmodal=false;
    public $supplier,$contact_person,$email,$phone,$address;
    protected $listeners = ['editsuppliermodal' => 'openModal'];

    public function openModal($id){
     $this->selectedId=$id;
     $supplierData=Supplier::where('id',$id)->first();
     $this->supplier=$supplierData->supplier;
     $this->contact_person=$supplierData->contact_person;
     $this->email=$supplierData->email;
     $this->phone=$supplierData->phone;
     $this->address=$supplierData->address;
     $this->opensuppliereditmodal=true;
    //  dd($supplierData);
    }

    public function closeModal(){
        $this->opensuppliereditmodal=false;
    }

    public function submit(){
        $supplierEditData=Supplier::find($this->selectedId);
        $supplierEditData->supplier=$this->supplier;
        $supplierEditData->contact_person=$this->contact_person;
        $supplierEditData->email=$this->email;
        $supplierEditData->phone=$this->phone;
        $supplierEditData->address=$this->address;
        $supplierEditData->update();
        $this->closeModal();
        $this->dispatch('supplierupdated');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.supplier.modal.editsuppliermodal');
    }
}
