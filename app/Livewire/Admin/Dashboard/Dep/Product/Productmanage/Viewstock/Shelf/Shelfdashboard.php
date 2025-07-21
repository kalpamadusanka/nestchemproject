<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Viewstock\Shelf;

use App\Models\Shelf;
use Livewire\Component;
use Livewire\WithPagination;

class Shelfdashboard extends Component
{
    use WithPagination;

    public $search;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['shelfAdded' => 'render'];

    public function openshelfaddmodal(){
        $this->dispatch('openshelfadd');
    }
    public function render()
    {
        $productdata=Shelf::where('status',1);
        if ($this->search) {
            $productdata->where(function ($query) {
                $query->where('shelf_no', 'like', '%' . $this->search . '%');

            });
        }
        $productdata=$productdata->paginate(10);
        return view('livewire.admin.dashboard.dep.product.productmanage.viewstock.shelf.shelfdashboard',compact('productdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
