<?php

namespace App\Livewire\Admin\Dashboard\Dep\Manufacture\Order\Modal;

use App\Models\Manufacturedom;
use App\Models\Manufactureline;
use App\Models\Momaterial;
use App\Models\Product;
use App\Models\Productstock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Editmanufacturemodal extends Component
{
    public $openeditmanufacturemodal=false;
    public $showConfirmationModal = false;
    public $selectedmanufactureno,$manufactureproduct,$productgroup,$barcode,$barcodeType,$doc,$quantity,$startDate,$endDate,$manufacturestatus,$description;
    protected $listeners = ['manufacturemodalopen' => 'openModal'];

    public function openModal($manufactureno){
        $this->selectedmanufactureno=$manufactureno;
        $manufactureData=Manufactureline::where('mo_no',$this->selectedmanufactureno)->first();
        $this->manufactureproduct=$manufactureData->productData->product_name;
        $this->productgroup=$manufactureData->productGroup->product_group;
        $this->barcode=$manufactureData->barcode;
        $this->barcodeType=$manufactureData->barcode_type;
        $this->doc=$manufactureData->files;
        $this->quantity=$manufactureData->qty;
        $this->startDate=$manufactureData->st_date;
        $this->endDate=$manufactureData->ed_date;
        $this->manufacturestatus=$manufactureData->mo_status;
        $this->description=$manufactureData->description;

    $this->openeditmanufacturemodal=true;
    }

    public function closeModal(){
        $this->openeditmanufacturemodal=false;
    }



public function confirmSubmit()
{
    if ($this->manufacturestatus === 'finished') {
        $this->showConfirmationModal = true;
    } else {
        $this->submit();
    }
}

public function cancelConfirmation()
{
    $this->showConfirmationModal = false;
}
    public function submit(){

        if($this->manufacturestatus == 'finished'){
            $selectedRecord=Manufactureline::where('mo_no',$this->selectedmanufactureno)->first();
            $selectedRecord->st_date=$this->startDate;
            $selectedRecord->ed_date=$this->endDate;
            $selectedRecord->description=$this->description;
            $selectedRecord->mo_status=$this->manufacturestatus;
            $selectedRecord->save();
            $this->updateMomaterialstock($this->selectedmanufactureno);
            $this->updatestockquantity($selectedRecord);
            $this->updateProduct($selectedRecord);
            $this->dispatch('manufactureorderAdded');
            $this->closeModal();
            $this->showConfirmationModal = false;
        }
        else{
            $selectedRecord=Manufactureline::where('mo_no',$this->selectedmanufactureno)->first();
        $selectedRecord->st_date=$this->startDate;
        $selectedRecord->ed_date=$this->endDate;
        $selectedRecord->description=$this->description;
        $selectedRecord->mo_status=$this->manufacturestatus;
        $selectedRecord->save();
        $this->dispatch('manufactureorderAdded');
        $this->closeModal();
        $this->showConfirmationModal = false;
        }


    }

    public function updateMomaterialstock($moLineId){
       $moline=Manufacturedom::where('mo_line_id',$moLineId)->get();
       foreach($moline as $m){
          $material=Momaterial::where('id',$m->material_id)->first();
          if($material->quantity > $m->qty){
            $material->quantity -= $m->qty;
            $material->save();
          }
          else{
            $this->dispatch('materialstockwarning');
          }

       }
    }
    public function updatestockquantity($selectedRecord){
        $user=Auth::user();
     $setRecord=new Productstock();
     $setRecord->product_id=$selectedRecord->product;
     $setRecord->barcode=$selectedRecord->barcode;
     $setRecord->qty=$selectedRecord->qty;
     $setRecord->product_group=$selectedRecord->product_group;
     $setRecord->added_by=$user->id;
     $setRecord->status=1;
     $setRecord->save();
    }

    public function updateProduct($selectedRecord){
    $product=Product::find($selectedRecord->product);
    $product->qty += $selectedRecord->qty;
    $product->save();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.manufacture.order.modal.editmanufacturemodal');
    }
}
