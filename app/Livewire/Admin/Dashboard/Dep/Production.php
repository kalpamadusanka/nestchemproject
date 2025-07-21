<?php

namespace App\Livewire\Admin\Dashboard\Dep;

use Livewire\Component;

class Production extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production')->layout('livewire.admin.dashboard.layout.master');
    }
}
