<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Datacollection\Collection\Modal;

use App\Models\Datacollection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Addcollectionmodal extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $collection_name,$description;
  public $viewaddcollectionmodal=false;

   protected $rules=[
        'collection_name'=>'required',
        'description'=>'required',

   ];
    protected $listeners = ['opendatacollectionmodal' => 'openModal'];

    public function openModal(){
     $this->viewaddcollectionmodal=true;
    }

    public function closeModal(){
        $this->viewaddcollectionmodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $datacollection=new Datacollection();
        $datacollection->collection_name=$this->collection_name;
        $datacollection->description=$this->description;
        $datacollection->added_by=$user->id;
        $datacollection->status=1;
        $datacollection->save();
        $this->dispatch('datacollectionadded');
        $this->reset();
        $this->closeModal();

    }


    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.datacollection.collection.modal.addcollectionmodal');
    }
}
