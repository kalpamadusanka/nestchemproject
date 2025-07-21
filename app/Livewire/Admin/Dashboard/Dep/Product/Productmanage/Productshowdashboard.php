<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productmanage;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Productshowdashboard extends Component
{
    use WithPagination;

    public $search,$stdate,$eddate,$daterange;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['productAdded'=>'render'];

    public function applyDate(){
        try {
           if ($this->daterange) {
               list($startDate, $endDate) = explode(' to ', $this->daterange);


              $this->stdate=$startDate;
              $this->eddate=$endDate;

           }
        } catch (\Throwable $th) {
           //throw $th;
        }

       }
    public function render()
    {
        $productdata=Product::where('status',1);
        if ($this->stdate && $this->eddate ) {
            $productdata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $productdata->where(function ($query) {
                $query->where('product_code', 'like', '%' . $this->search . '%');

            });
        }
        $productdata=$productdata->paginate(10);
        return view('livewire.admin.dashboard.dep.product.productmanage.productshowdashboard',compact('productdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
