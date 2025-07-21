<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Adjustment\Type;

use App\Models\Adjustmenttype;
use Livewire\Component;
use Livewire\WithPagination;

class Adjustmenttypedashboard extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    protected $listeners = ['adjustmenttypeadded' => 'render'];
    public function openadjustmenttypemodal(){
        $this->dispatch('adjustmentypemodal');
    }

    public function deletedata($id){
        Adjustmenttype::find($id)->delete();
        $this->render();
        }
    public function render()
    {
        $adjustmenttypes=Adjustmenttype::whereNotNull('status');
        if ($this->search) {
            $adjustmenttypes->where(function ($query) {
                $query->where('adjustment_type', 'like', '%' . $this->search . '%');

            });
        }
        $adjustmenttypes=$adjustmenttypes->paginate(10);
        return view('livewire.admin.dashboard.dep.production.material.adjustment.type.adjustmenttypedashboard',compact('adjustmenttypes'))->layout('livewire.admin.dashboard.layout.master');
    }
}
