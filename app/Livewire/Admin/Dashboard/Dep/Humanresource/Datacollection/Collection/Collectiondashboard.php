<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Datacollection\Collection;

use App\Models\Datacollection;
use Livewire\Component;
use Livewire\WithPagination;

class Collectiondashboard extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = ['datacollectionadded'=>'render','datacollectionupdated'=>'render'];
    public function opencollectionmodal(){
        $this->dispatch('opendatacollectionmodal');
    }

    public function activecollection($id){
        $datacollection = Datacollection::find($id);
        $datacollection->status = 1;
        $datacollection->update();
        $this->dispatch('datacollectionupdated');
    }

    public function deactivecollection($id){
        $datacollection = Datacollection::find($id);
        $datacollection->status = 0;
        $datacollection->update();
        $this->dispatch('datacollectionupdated');
    }

    public function deletecollection($id){
        $datacollection = Datacollection::find($id);
        $datacollection->delete();
        $this->dispatch('datacollectionupdated');
    }


    public function render()
    {
        $dataCollection =Datacollection::whereNotNull('status')
        ->where(function ($query) {
            $query->where('collection_name', 'LIKE', '%' . $this->search . '%');// Search by name
        })
        ->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.datacollection.collection.collectiondashboard',compact('dataCollection'))->layout('livewire.admin.dashboard.layout.master');
    }
}
