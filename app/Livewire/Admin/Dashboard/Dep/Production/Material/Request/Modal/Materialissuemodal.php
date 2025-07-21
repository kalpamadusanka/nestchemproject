<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Request\Modal;

use App\Models\Material;
use App\Models\Materialrequest;
use App\Models\Materialstock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Materialissuemodal extends Component
{

    public $selectedId,$lot,$batch;
    public $openmaterialissuemodal=false;

    protected $rules=[
        'lot'=>'required',
        'batch'=>'required'
    ];
    protected $listeners = ['materialissued' => 'openModal'];

    public function openModal($id){
        $this->selectedId = $id;
        $this->openmaterialissuemodal = true;
    }

    public function submit(){
        $this->validate();
        $reqData= Materialrequest::find($this->selectedId);
        $user=Auth::user();

        $materialData=Material::where('code', $reqData->material_id)->first();
        if($reqData->uom == $materialData->unit){


            $materialstock=Materialstock::where('material_id',$materialData->id)->where('lot',$this->lot)->where('batch',$this->batch)->first();
            if($materialstock){
                if($materialstock->qty > $reqData->quantity){

                    $reqData->req_status='transferred';
                    $reqData->transferred_by=$user->id;
                    $reqData->update();

                    $materialstock->qty -= $reqData->quantity;
                    $materialstock->save();
                    $this->dispatch('materialIssuedconfirmed');
                }
                else{
                    $this->dispatch('insufficientstock');
                }
            }
            else{
                $this->dispatch('stocknotfound');
            }

        }
        else{
            $this->dispatch('uommismatch');
        }
        $this->closeModal();
        $this->reset();
    }

    public function closeModal(){
        $this->openmaterialissuemodal = false;
    }

    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.material.request.modal.materialissuemodal');
    }
}
