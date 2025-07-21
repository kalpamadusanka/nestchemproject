<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Adjustment;

use App\Models\Product;
use App\Models\Productstock;
use App\Models\ShelfData;
use App\Models\Stockadjustment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Productadjustment extends Component
{
    use WithPagination;

    public $search,$stdate,$eddate,$daterange;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['adjustmentapproved'=>'render','adjustmentdeleted'=>'render'];
    public function openstockadjustmentmodal(){
        $this->dispatch('openstockadjustment');
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

    public function approve($id){
        $user=Auth::user();
        $adjustment=Stockadjustment::find($id);
        $adjustment->approved = $user->id;
        $adjustment->save();
        $this->updatestock($id);
        $this->dispatch('adjustmentapproved');
    }

    public function updatestock($id){
        $adjustData=Stockadjustment::where('id',$id)->first();
        $shelfdata=ShelfData::where('shelf_no',$adjustData->shelf_no)->first();
        $productStock=Productstock::where('product_id',$adjustData->product_id)->first();

        if($shelfdata && $productStock){
            $productonShelf=ShelfData::where('shelf_no',$shelfdata->shelf_no)->where('product_stock_id',$productStock->id)->first();
            $productonShelf->qty = $productonShelf->qty - $adjustData->adjustment_qty;
            $productonShelf->save();

            $product=Product::where('id',$adjustData->product_id)->first();
            $product->qty=$product->qty - $adjustData->adjustment_qty;
            $product->save();

            $productStock->qty = $productStock->qty - $adjustData->adjustment_qty;
            $productStock->save();
            $this->dispatch('stockadjustmentsuccess');

        }
        else{
            $this->dispatch('productstocknotavailable');
        }
    }

    public function deleteadjustmentdata($id){
        $adjustment=Productadjustment::find($id);
        $adjustment->delete();
        $this->dispatch('adjustmentdeleted');
    }
    public function render()
    {
        $productadjustment=Stockadjustment::where('status',1);
        if ($this->stdate && $this->eddate ) {
            $productadjustment->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $productadjustment->where(function ($query) {
                $query->where('ref_no', 'like', '%' . $this->search . '%');

            });
        }
        $productadjustment=$productadjustment->paginate(10);
        return view('livewire.admin.dashboard.dep.product.adjustment.productadjustment',compact('productadjustment'))->layout('livewire.admin.dashboard.layout.master');
    }
}
