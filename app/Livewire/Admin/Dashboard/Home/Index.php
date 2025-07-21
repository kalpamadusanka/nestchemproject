<?php

namespace App\Livewire\Admin\Dashboard\Home;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.home.index')->layout('livewire.admin.dashboard.layout.master');
    }
}
