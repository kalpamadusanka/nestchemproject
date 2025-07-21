<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Trialbalance;

use Livewire\Component;

class Trialsheet extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.trialbalance.trialsheet')->layout('livewire.admin.dashboard.layout.master');
    }
}
