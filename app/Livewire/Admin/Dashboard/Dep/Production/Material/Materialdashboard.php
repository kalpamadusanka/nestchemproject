<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material;

use App\Models\Material;
use App\Models\Materialrequest;
use Livewire\Component;
use Livewire\WithPagination;

class Materialdashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    protected $listeners = ['materialAdded'=>'render','materialdeleted'=>'render','materialadjustsuccess'=>'render'];

    public $search;
    public function openmaterialaddmodal(){
        $this->dispatch('openmaterialAddmodal');
    }

    public function deletematerial($id){
        $material=Material::find($id);
        $material->delete();
        $this->dispatch('materialdeleted');
    }
    public function editmaterial($id){
        $this->dispatch('openmaterialEditmodal',$id);
    }
    public function poitemviews($id){
        $this->dispatch('viewstockruningmodal',$id);
    }
    public function render()
    {
        $materialdata=Material::where('status',1);
        if ($this->search) {
            $materialdata->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');

            });
        }
        $materialdata=$materialdata->paginate(10);



        return view('livewire.admin.dashboard.dep.production.material.materialdashboard',compact('materialdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
