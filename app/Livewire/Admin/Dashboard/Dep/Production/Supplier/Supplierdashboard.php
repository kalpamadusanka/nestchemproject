<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class Supplierdashboard extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['supplieradded' => 'render','supplierupdated'=>'render'];
    public function supplieraddmodal(){
        $this->dispatch('opensuppliermodal');
    }

    public function editsupplierdata($id){
    $this->dispatch('editsuppliermodal',$id);

    }

    public function deletesupplierdata($id){
        $supplierrecord=Supplier::find($id);
        $supplierrecord->status=0;
        $supplierrecord->save();
        $this->dispatch('supplierupdated');
        // $this->dispatch('supplierdeleted');

    }
    public function render()
    {
        $supplierdata=Supplier::where('status',1);
        if ($this->search) {
            $supplierdata->where(function ($query) {
                $query->where('supplier', 'like', '%' . $this->search . '%');

            });
        }
        $supplierdata=$supplierdata->paginate(10);
        return view('livewire.admin.dashboard.dep.production.supplier.supplierdashboard',compact('supplierdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
