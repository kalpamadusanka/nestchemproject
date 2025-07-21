<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Category;

use App\Models\Materialcategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Mcategorydashboard extends Component
{
    public $search;
    protected $listeners = ['materialcategoryadded' => 'render','materialcategoryupdated'=>'render'];
    public function addmaterialcategory(){
        $this->dispatch('openmaterialcategorymodal');
    }

    public function deletematerialcategory($id){


       try {
        $materialcategory=Materialcategory::find($id);
        $materialcategory->status=0;
        $materialcategory->save();
       $this->render();
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

    public function editmaterialcategory($id){
       $this->dispatch('openeditmaterialmodal',$id);
    }

    public function render()
    {
        $materialcategoryData=Materialcategory::where('status',1);
        if ($this->search) {
            $materialcategoryData->where(function ($query) {
                $query->where('category_name', 'like', '%' . $this->search . '%');

            });
        }
        $materialcategoryData=$materialcategoryData->paginate(10);
        return view('livewire.admin.dashboard.dep.production.material.category.mcategorydashboard',compact('materialcategoryData'))->layout('livewire.admin.dashboard.layout.master');
    }
}
