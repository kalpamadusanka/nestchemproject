<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product;

use Livewire\Component;

class Productdashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.dep.product.productdashboard')->layout('livewire.admin.dashboard.layout.master');
    }
}
