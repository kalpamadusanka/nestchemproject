<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Viewstock\Modal;

use App\Models\Productstock;
use App\Models\Shelf;
use App\Models\ShelfData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Assignshelfmodal extends Component
{
    public $shelf_no,$qty,$selectedId;
    public $openshelfassignmodal=false;
    protected $rules=[
     'shelf_no'=>'required',
     'qty'=>'required',
    ];

    protected $listeners = ['assignshelfmodal' => 'openModal'];

    public function openModal($id){

        $this->selectedId=$id;
        $shelfQtySum = ShelfData::where('product_stock_id', $id)->sum('qty');
        $productStock=Productstock::where('id',$id)->first();

        if($productStock->qty > $shelfQtySum){
            $this->openshelfassignmodal=true;
        }
        else{
            $this->dispatch('qtyassignederror');
        }
    }

    public function submit(){
        try {
            $this->validate();
            $user=Auth::user();

        $currentData=Productstock::where('id',$this->selectedId)->first();
        if($currentData->qty >= $this->qty){
            $shelfcheck=Shelf::where('id',$this->shelf_no)->first();

            if($shelfcheck->capacity > $shelfcheck->current_stock){
                $shelfassign=new ShelfData();
                $shelfassign->shelf_no=$this->shelf_no;
                $shelfassign->product_stock_id=$this->selectedId;
                $shelfassign->qty=$this->qty;
                $shelfassign->added_by=$user->id;
                $shelfassign->status=1;
                $shelfassign->save();
                $this->shelfCurrentrstockupdate($shelfassign);
            }
            else{
                $this->dispatch('shelfover');
            }

            $this->reset();
            $this->dispatch('assignedshelf');
        }
        else{
            $this->dispatch('qtyerror');
        }

           } catch (\Throwable $th) {
            $this->dispatch('errorassignedshelf', message: $th->getMessage());
            DB::table('error_logs')->insert([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                'created_at' => now(),
            ]);
           }
    }

    public function shelfCurrentrstockupdate($shelfassign){
        $shelfData=Shelf::where('id',$shelfassign->shelf_no)->first();
        $shelfData->current_stock += $shelfassign->qty;
        $shelfData->save();
    }

    public function closeModal(){
        $this->openshelfassignmodal=false;
    }
    public function render()
    {
        $shelflist=Shelf::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.product.productmanage.viewstock.modal.assignshelfmodal',compact('shelflist'));
    }
}
