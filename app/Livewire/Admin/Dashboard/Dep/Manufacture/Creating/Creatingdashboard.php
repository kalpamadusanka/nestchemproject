<?php

namespace App\Livewire\Admin\Dashboard\Dep\Manufacture\Creating;

use App\Models\Manufactureline;
use Livewire\Component;

class Creatingdashboard extends Component
{

    protected $listeners = ['manufacturerecordupdated' => 'render'];
    public function openManufactureModal($manufactureno){
        $this->dispatch('manufacturemodalopen', $manufactureno);
    }
    public function rendercomponent(){

        $this->render();
    }
    public function render()
    {
        $manufactureline=Manufactureline::all();
        return view('livewire.admin.dashboard.dep.manufacture.creating.creatingdashboard',compact('manufactureline'))->layout('livewire.admin.dashboard.layout.master');
    }
}
