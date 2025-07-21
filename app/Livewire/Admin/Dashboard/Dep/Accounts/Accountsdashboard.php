<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts;

use Livewire\Component;

class Accountsdashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.accountsdashboard')->layout('livewire.admin.dashboard.layout.master');
    }
}
