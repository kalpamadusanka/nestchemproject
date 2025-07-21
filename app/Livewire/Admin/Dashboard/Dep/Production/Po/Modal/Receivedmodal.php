<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Po\Modal;

use App\Models\Material;
use App\Models\Materialstock;
use App\Models\Poitems;
use App\Models\Purchaseorder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Receivedmodal extends Component
{
    public $openreceivedmodal=false;
    public $selectedID,$received_date;
    protected $listeners = ['viewreceivedmodal' => 'openModal'];

    protected $rules=[
    'received_date'=>'required',
    ];
    public function openModal($id){
        $this->selectedID=$id;
        $this->openreceivedmodal = true;
    }
    public function closeModal(){
        $this->openreceivedmodal = false;
    }

    public function submit(){
        $this->validate();
        $user=Auth::user();
        $purchaseorder=Purchaseorder::find($this->selectedID);
        $purchaseorder->received_date=$this->received_date;
        $purchaseorder->received_status=1;
        $purchaseorder->recived_mark_by=$user->id;
        $purchaseorder->update();
        $this->reset();
        $this->closeModal();
        $this->dispatch('receivedsuccess');

        $this->updatestock($purchaseorder);

    }
    public function updatestock($purchaseorder){
        $user=Auth::user();
            if($purchaseorder){
            $poItems=Poitems::where('purchase_order_id',$purchaseorder->id)->get();
            foreach ($poItems as $poItem) {

                $materialData=Material::where('code',$poItem->item)->first();

                $materialStock=new Materialstock();
                $materialStock->material_id=$materialData->id;
                $materialStock->exp_date=$poItem->exp_date;
                $materialStock->lot=$poItem->lot;
                $materialStock->batch=$poItem->batch;
                $materialStock->qty=$poItem->quantity;
                $materialStock->expired=0;
                $materialStock->added_by=$user->id;
                $materialStock->status=1;
                $materialStock->save();


                $materialData->qty += $poItem->quantity;
                $materialData->save();

           }

           }
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.po.modal.receivedmodal');
    }
}
