<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Assettype;

use App\Models\Assetstype;
use Livewire\Component;
use Livewire\WithPagination;

class Assetstypes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = ['assetstypeadded' => 'render'];
    public function openassetstypemodal(){
        $this->dispatch('openassetstypemodal');
    }

    public function activeassettype($id){
        $assetstype=Assetstype::find($id);
        $assetstype->status=1;
        $assetstype->update();
        $this->dispatch('assetstypeupdated');
    }
    public function deactiveassetstype($id){
        $assetstype=Assetstype::find($id);
        $assetstype->status=0;
        $assetstype->update();
        $this->dispatch('assetstypeupdated');
    }

    public function deleteassetstype($id){
        $assetstype=Assetstype::find($id);
        $assetstype->delete();
        $this->dispatch('assetstypeupdated');
    }
    public function render()
    {
        $assetstype= Assetstype::whereNotNull('status')
        ->when($this->search, function ($query, $search) {
            return $query->where('assets_type', 'like', '%' . $search . '%') // Search by asset name
                ->orWhere('description', 'like', '%' . $search . '%'); // Search by asset description
        })
        ->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.assets.assettype.assetstypes',compact('assetstype'))->layout('livewire.admin.dashboard.layout.master');
    }
}
