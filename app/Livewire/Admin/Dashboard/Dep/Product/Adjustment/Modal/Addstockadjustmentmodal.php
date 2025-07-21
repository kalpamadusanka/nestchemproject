<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Adjustment\Modal;

use App\Models\Product;
use App\Models\Productstock;
use App\Models\Shelf;
use App\Models\ShelfData;
use App\Models\Stockadjustment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Addstockadjustmentmodal extends Component
{

    public $products,$item,$shelfs,$uom,$price,$instock,$shelf,$selected,$type,$ref_no,$adjust_date,$adjust_qty,$selectedshelf;
    public $openadjustmentmodal=false;
    protected $listeners = ['openstockadjustment' => 'openModal'];

    public function openModal(){
      $this->openadjustmentmodal=true;

    }

    public function mount(){
        $this->products=Product::where('status',1)->get();
        $this->shelfs=Shelf::where('status',1)->get();
    }

    public function UpdatedItem($value){
        $productData=Product::where('id',$value)->first();
        $this->selected=$value;
        $this->uom=$productData->uom;
        $this->instock=$productData->qty;
    }
    public function UpdatedShelf($value){
     try {
        $shelfData=ShelfData::where('shelf_no',$value)->first();
     $this->price=$shelfData->productStockcCheck->unit_price;
     $this->selectedshelf=$shelfData->product_stock_id;

     } catch (\Throwable $th) {
       $this->dispatch('productstocknotavailable');
     }

    }

    public function closeModal(){
        $this->openadjustmentmodal=false;
    }

    public function submit(){

        try {
            $user=Auth::user();
            $adjustment=new Stockadjustment();
            $adjustment->ref_no=$this->ref_no;
            $adjustment->date=$this->adjust_date;
            $adjustment->product_id=$this->selected;
            $adjustment->shelf_no=$this->shelf;
            $adjustment->uom=$this->uom;
            $adjustment->type=$this->type;
            $adjustment->adjustment_qty=$this->adjust_qty;
            $adjustment->newqty=$this->instock - $this->adjust_qty;
            $adjustment->unit_price=$this->price;
            $adjustment->in_stock=$this->instock;
            $adjustment->approved=0;
            $adjustment->added_by=$user->id;
            $adjustment->status=1;
            $adjustment->save();

            $this->reset();
            $this->closeModal();
            $this->dispatch('adjustmentadded');
        } catch (\Throwable $th) {
            $this->dispatch('erroradjustmentadded', message: $th->getMessage());
        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
        ]);
        }

    }


    public function render()
    {
        $this->mount();
        return view('livewire.admin.dashboard.dep.product.adjustment.modal.addstockadjustmentmodal');
    }
}
