<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales;

use Livewire\Component;

class Salesdashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.salesdashboard')->layout('livewire.admin.dashboard.layout.master');
    }
}
