<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Po\Modal;

use App\Models\Purchaseorder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Editpurchasemodal extends Component
{

    public $openpurchasedmodal=false;
    public $attention,$note,$selectedId;
    protected $listeners = ['editpurchaseorder' => 'openModal'];
    public function openModal($id){
        $this->selectedId=$id;
        $this->openpurchasedmodal = true;
     $purchaseorder=Purchaseorder::where('id',$id)->first();
     $this->attention=$purchaseorder->attention;
     $this->note=$purchaseorder->note;
    }
    public function closeModal(){
        $this->openpurchasedmodal = false;
    }
    public function submit(){
        try {
            $purchaseData=Purchaseorder::where('id',$this->selectedId)->first();
            $purchaseData->attention=$this->attention;
            $purchaseData->note=$this->note;
            $purchaseData->save();
            $this->closeModal();
            $this->dispatch('dataupdated');
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
        $attentionlist = User::whereIn('role', [
            'Superadmin',
            'Accountant',
            'Assistance accountant',
            'Material Import Coordinator',
            'Production Manager'
        ])->get();

        return view('livewire.admin.dashboard.dep.production.po.modal.editpurchasemodal',compact('attentionlist'));
    }
}
