<?php

namespace App\Livewire\Admin\Dashboard\Dep\Manufacture\Material;

use App\Models\Materialrequest;
use App\Models\Momaterial;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Requestdashboard extends Component
{
    use WithPagination;

    public $search,$stdate,$eddate,$daterange;
    protected $paginationTheme = 'bootstrap';

    public function deletedata($id){
      $requestdata=Materialrequest::find($id);
      $requestdata->delete();
      $this->render();
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

       public function release($id){
        $user=Auth::user();
        $requestedData=Materialrequest::find($id);

        $momaterial = Momaterial::where('material_id', $requestedData->material_id)->first();

if ($momaterial) {
    // Update existing record: Add the new quantity to the current quantity
    $momaterial->quantity += $requestedData->quantity;
    $momaterial->save();

    $this->dispatch('updatedqty');
} else {
    // Insert new record
    $momaterial = new Momaterial();
    $momaterial->material_id = $requestedData->material_id;
    $momaterial->quantity = $requestedData->quantity;
    $momaterial->uom = $requestedData->uom;
    $momaterial->status = 1;
    $momaterial->added_by = $user->id;
    $momaterial->save();

    $this->dispatch('releasedmaterial');
}
$requestedData->status = 0;
$requestedData->save();
$this->render();
       }
    public function render()
    {

        $requestdata=Materialrequest::whereNotNull('status');
        if ($this->stdate && $this->eddate ) {
            $requestdata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $requestdata->where(function ($query) {
                $query->where('req_code', 'like', '%' . $this->search . '%');

            });
        }
        $requestdata=$requestdata->paginate(10);
        return view('livewire.admin.dashboard.dep.manufacture.material.requestdashboard',compact('requestdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
