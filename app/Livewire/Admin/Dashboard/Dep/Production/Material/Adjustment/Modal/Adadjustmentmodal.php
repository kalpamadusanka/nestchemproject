<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Adjustment\Modal;

use App\Models\Adjustmenttype;
use App\Models\Material;
use App\Models\Materialadjustment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Adadjustmentmodal extends Component
{
    public $adjustment_type,$quantity,$reason,$materialid,$itemqty,$reference_number,$lot,$batch;
    public $openadjustmentmodal=false;

    protected $rules=[
    'adjustment_type'=>'required',
    'quantity'=>'required',
    'reason'=>'required',
    ];
    protected $listeners = ['openadjustmentaddmodal' => 'openModal'];

    public function openModal($materialId){
    $this->openadjustmentmodal=true;
    $this->materialid=$materialId;
    $item=Material::find($materialId);
    $this->itemqty=$item->qty;

    }
    public function closeModal(){
        $this->openadjustmentmodal=false;
    }

    public function submit(){
    $this->validate();

    try {
        $user=Auth::user();
        $materialadjustment=new Materialadjustment();
        $materialadjustment->material_id=$this->materialid;
        $materialadjustment->adjustment_type=$this->adjustment_type;


        $adjustmenttypecheck=Adjustmenttype::find($this->adjustment_type);
        if($adjustmenttypecheck->type == 'increase'){

            $materialadjustment->previous_stock= $this->itemqty;
            $newstockqty=$this->itemqty + $this->quantity;
            $materialadjustment->new_stock=$newstockqty;

        }
        else{
            $materialadjustment->previous_stock= $this->itemqty;
            $newstockqty=$this->itemqty - $this->quantity;
            $materialadjustment->new_stock=$newstockqty;
        }

        $materialadjustment->quantity=$this->quantity;
        $materialadjustment->reason=$this->reason;
        $materialadjustment->lot=$this->lot;
        $materialadjustment->batch=$this->batch;

        $materialadjustment->adjustment_date = Carbon::now();
        $materialadjustment->reference_number=$this->reference_number;
        $materialadjustment->approved=0;
        $materialadjustment->added_by=$user->id;
        $materialadjustment->status=1;
        $materialadjustment->save();

        $this->reset();
        $this->dispatch('adjustmentadded');
        $this->closeModal();

    } catch (\Throwable $th) {
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
        $adjustmenttype=Adjustmenttype::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.production.material.adjustment.modal.adadjustmentmodal',compact('adjustmenttype'));
    }
}
