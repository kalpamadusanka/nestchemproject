<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Adjustment;

use App\Models\Material;
use App\Models\Materialadjustment;
use App\Models\Materialstock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Adjustmentdashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $itemCode;
    public $materialid,$daterange,$stdate,$eddate;
    public function mount($material_id)
    {

        $this->materialid = $material_id;
        $item=Material::find($material_id);
        $this->itemCode = $item->code;
    }
    protected $listeners = ['adjustmentadded' => 'render','materialadjustsuccess'=>'render'];
    public function addadjustmentmodal(){
        $this->dispatch('openadjustmentaddmodal',$this->materialid);
    }

    public function applyDate(){
        try {
           if ($this->daterange) {
               list($startDate, $endDate) = explode(' to ', $this->daterange);


              $this->stdate=$startDate;
              $this->eddate=$endDate;

           }
        } catch (\Throwable $th) {
           //throw $th;
        }

    }

    public function approveadjustment($id){
        $user=Auth::user();
        $adjustment=Materialadjustment::find($id);
        $adjustment->approved=1;
        $adjustment->approved_by=$user->id;
        $adjustment->update();
        $this->render();

        $this->changestock($adjustment);
    }

    public function changestock($adjustment){
        try {
            $materialId=$adjustment->material_id;
            $adjustmenttype=$adjustment->adjustmentType->type;
            if($adjustmenttype == 'increase'){
                $materialStock=Materialstock::where('material_id',$materialId)->where('lot',$adjustment->lot)->where('batch',$adjustment->batch)->first();
                if($materialStock){
                    $materialStock->qty += $adjustment->quantity;
                    $materialStock->save();
                }
                else{
                    $randomStock = Materialstock::where('material_id', $materialId)->inRandomOrder()->first();
                    $randomStock->qty += $adjustment->quantity;
                    $randomStock->save();
                }

            }
            else{
                $materialStock=Materialstock::where('material_id',$materialId)->where('lot',$adjustment->lot)->where('batch',$adjustment->batch)->first();
                if($materialStock){
                    $materialStock->qty -= $adjustment->quantity;
                    $materialStock->save();
                }
                else{
                    $randomStock = Materialstock::where('material_id', $materialId)->inRandomOrder()->first();
                    $randomStock->qty -= $adjustment->quantity;
                    $randomStock->save();
                }
            }
            $this->dispatch('materialadjustsuccess');
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

    public function deletedata($id){
        $Mmaterialadjustment=Materialadjustment::find($id);
        $Mmaterialadjustment->delete();
        $this->render();
    }
    public function render()
    {
        $adjustmentdata=Materialadjustment::where('material_id',$this->materialid );
        if ($this->search) {
            $adjustmentdata->where(function ($query) {
                $query->where('reason', 'like', '%' . $this->search . '%');

            });
        }
        if ($this->stdate && $this->eddate) {
            $adjustmentdata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }

        $adjustmentdata=$adjustmentdata->paginate(10);
        return view('livewire.admin.dashboard.dep.production.material.adjustment.adjustmentdashboard',compact('adjustmentdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
