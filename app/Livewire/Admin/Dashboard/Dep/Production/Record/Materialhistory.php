<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Record;

use App\Models\Poitems;
use Livewire\Component;
use Livewire\WithPagination;

class Materialhistory extends Component
{
    use WithPagination;

    public $search;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $purchasedata=Poitems::where('status',1);
        if ($this->search) {
            $purchasedata->where(function ($query) {
                $query->where('item', 'like', '%' . $this->search . '%');

            });
        }
        $purchasedata=$purchasedata->paginate(10);
        return view('livewire.admin.dashboard.dep.production.record.materialhistory',compact('purchasedata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
