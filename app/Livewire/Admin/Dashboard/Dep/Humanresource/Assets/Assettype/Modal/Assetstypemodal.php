<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets\Assettype\Modal;

use App\Models\Assetstype;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Assetstypemodal extends Component
{

    public $assets_type,$description;
    public $openassetstypemodal=false;
    protected $listeners = ['openassetstypemodal' => 'openModal'];

    protected $rules=[
    'assets_type'=>'required',
    'description'=>'required'
    ];

    public function openModal(){
      $this->openassetstypemodal=true;
    }

    public function closeModal(){
        $this->openassetstypemodal=false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $assetstype=new Assetstype();
        $assetstype->assets_type=$this->assets_type;
        $assetstype->description=$this->description;
        $assetstype->added_by=$user->id;
        $assetstype->status=1;
        $assetstype->save();
        $this->reset();
        $this->closeModal();
        $this->dispatch('assetstypeadded');
    }


    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.assets.assettype.modal.assetstypemodal');
    }
}
