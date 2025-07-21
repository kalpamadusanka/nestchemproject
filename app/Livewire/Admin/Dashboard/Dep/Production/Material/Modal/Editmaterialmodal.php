<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Modal;

use App\Models\Material;
use App\Models\Materialcategory;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Editmaterialmodal extends Component
{
    public $openeditmaterialmodal=false;

    public $item_name,$code,$uom,$min_stock,$exp_date,$description,$category,$qty,$selectedID,$warehouse,$shelf_details;

    protected $listeners = ['openmaterialEditmodal' => 'openModal'];

    public function openModal($id){
        // dd($id);
        $this->selectedID=$id;
        $this->openeditmaterialmodal=true;
        $materialData=Material::find($id);
        $this->item_name=$materialData->name;
        $this->code=$materialData->code;
        $this->uom=$materialData->unit;
        $this->min_stock=$materialData->min_stock;
        $this->description=$materialData->description;
        $this->category=$materialData->category_id;
        $this->warehouse=$materialData->warehouse_id;
        $this->shelf_details=$materialData->shelf_no;

    }
    public function closeModal(){
        $this->openeditmaterialmodal=false;
    }

    public function submit(){
      try {
        $materialeditData=Material::where('id',$this->selectedID)->first();
        $materialeditData->update([
         'name'=>$this->item_name,
         'code'=>$this->code,
         'unit'=>$this->uom,
         'min_stock'=>$this->min_stock,
         'description'=>$this->description,
         'category_id'=>$this->category,
         'warehouse_id'=>$this->warehouse,
         'shelf_no'=>$this->shelf_details,
        ]);
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
        $materialcategory=Materialcategory::all();
        $warehouselist=Warehouse::all();
        return view('livewire.admin.dashboard.dep.production.material.modal.editmaterialmodal',compact('materialcategory','warehouselist'));
    }
}
