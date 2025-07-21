<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Modal;

use App\Models\Material;
use App\Models\Materialcategory;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Addmaterialmodal extends Component
{
    public $openmaterialaddmodal=false;

    public $item_name,$code,$uom,$min_stock,$exp_date,$description,$category,$qty,$shelf_details,$warehouse;
    protected $listeners = ['openmaterialAddmodal' => 'openModal'];

    protected $rules=[
     'item_name'=>'required',
     'code'=>'required|unique:raw_materials',
     'uom'=> 'required|in:kg,liters,pieces',
     'category'=>'required',
     'min_stock'=>'required',
     'warehouse'=>'required',

    ];

    public function openModal(){
     $this->openmaterialaddmodal=true;
    }

    public function closeModal(){
        $this->openmaterialaddmodal=false;
    }
    public function submit(){
      $this->validate();


      try {
        $user=Auth::user();
        $material=new Material();
        $material->name=$this->item_name;
        $material->code=$this->code;
        $material->qty=0;
        $material->unit=$this->uom;
        $material->warehouse_id=$this->warehouse;
        $material->shelf_no=$this->shelf_details;
        $material->category_id=$this->category;
        $material->min_stock=$this->min_stock;
        $material->description=$this->description;
        $material->added_by=$user->id;
        $material->status=1;
        $material->save();
        $this->reset();
        $this->closeModal();
        $this->dispatch('materialAdded');
      } catch (\Throwable $th) {
        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
  ]);
      }
      // $this->emit('closeModal');

    }
    public function render()
    {
        $materialcategory=Materialcategory::all();
        $warehouselist=Warehouse::all();
        return view('livewire.admin.dashboard.dep.production.material.modal.addmaterialmodal',compact('materialcategory','warehouselist'));
    }
}
