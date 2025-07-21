<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Supplier\Modal;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addsuppliermodal extends Component
{
    public $opensupplieraddmodal=false;

    public $supplier,$contact_person,$email,$phone,$address;

    protected $rules=[
      'supplier'=>'required',
      'contact_person'=>'required',
      'email'=>'required|email',
      'phone'=>'required',
      'address'=>'required',
    ];
    protected $listeners = ['opensuppliermodal' => 'openModal'];

    public function openModal(){
     $this->opensupplieraddmodal=true;
    }

    public function closeModal(){
        $this->opensupplieraddmodal=false;
    }

    public function submit(){
     $this->validate();
     $user=Auth::user();
     $supplier=new Supplier();
     $supplier->supplier=$this->supplier;
     $supplier->contact_person=$this->contact_person;
     $supplier->supplier_code='S-'.rand(1000,9999);
     $supplier->email=$this->email;
     $supplier->phone=$this->phone;
     $supplier->address=$this->address;
     $supplier->added_by=$user->id;
     $supplier->status=1;
     $supplier->save();
     $this->reset();
     $this->closeModal();
     $this->dispatch('supplieradded');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.supplier.modal.addsuppliermodal');
    }
}
