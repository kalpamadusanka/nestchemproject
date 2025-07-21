<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Adjustment\Type\Modal;

use App\Models\Adjustmenttype;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Addadjustmenttypemodal extends Component
{
    public $adjustment_type,$description,$type;
    public $openadjustmenttypemodal=false;

    protected $rules=[
        'adjustment_type'=>'required',
        'type'=>'required',
    ];
    protected $listeners = ['adjustmentypemodal' => 'openModal'];

    public function openModal(){
    $this->openadjustmenttypemodal = true;
    }
    public function closeModal(){
        $this->openadjustmenttypemodal = false;
    }

    public function submit(){
    $this->validate();

    try {
        $user=Auth::user();
        $adjustmenttype=new Adjustmenttype();
        $adjustmenttype->adjustment_type=$this->adjustment_type;
        $adjustmenttype->type=$this->type;
        $adjustmenttype->description=$this->description;
        $adjustmenttype->added_by=$user->id;
        $adjustmenttype->status=1;
        $adjustmenttype->save();
        $this->closeModal();
        $this->reset();
        $this->dispatch('adjustmenttypeadded');
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
        return view('livewire.admin.dashboard.dep.production.material.adjustment.type.modal.addadjustmenttypemodal');
    }
}
