<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Viewstock;

use App\Models\Productstock;
use App\Models\ShelfData;
use Livewire\Component;
use Livewire\WithPagination;

class Viewproductstockdashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $stdate,$eddate,$daterange,$search,$selectedproductId;


    protected $listeners = ['productstockrecordupdated' => 'render'];
    public function mount($productid){
      $this->selectedproductId=$productid;
    }
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
    public function getshelfData($id){
        $this->dispatch('viewshelfmodal',$id);
    }

    public function assignshelfData($id){
        $this->dispatch('assignshelfmodal',$id);
    }
    public function editRecord($id){
        $this->dispatch('editstockmodal',$id);
    }
    public function render()
    {
        $productdata=Productstock::where('product_id',$this->selectedproductId);
        if ($this->stdate && $this->eddate ) {
            $productdata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $productdata->where(function ($query) {
                $query->where('barcode', 'like', '%' . $this->search . '%');

            });
        }
        $productdata=$productdata->paginate(10);
        return view('livewire.admin.dashboard.dep.product.productmanage.viewstock.viewproductstockdashboard',compact('productdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
