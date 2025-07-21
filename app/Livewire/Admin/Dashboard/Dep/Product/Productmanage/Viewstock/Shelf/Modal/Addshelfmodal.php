<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productmanage\Viewstock\Shelf\Modal;

use App\Models\Shelf;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Addshelfmodal extends Component
{
    public $openshelfaddmodal=false;
    public $shelf_no,$capacity,$warehouse,$description;
    protected $listeners = ['openshelfadd' => 'openModal'];

    protected $rules=[
     'shelf_no'=>'required',
     'capacity'=>'required',
     'warehouse'=>'required',
    ];

    public function openModal(){
    $this->openshelfaddmodal=true;
    }
    public function closeModal(){
        $this->openshelfaddmodal=false;
    }
    public function submit(){

        try {
            $this->validate();
            $user=Auth::user();
            $shlefNew=new Shelf();
            $shlefNew->shelf_no=$this->shelf_no;
            $shlefNew->capacity=$this->capacity;
            $shlefNew->warehouse=$this->warehouse;
            $shlefNew->description=$this->description;
            $shlefNew->current_stock=0;
            $shlefNew->added_by=$user->id;
            $shlefNew->status=1;
            $result=$shlefNew->save();
            if($result){
                $this->reset();
                $this->dispatch('shelfAdded');
            }

        } catch (\Throwable $th) {
            $this->dispatch('errorshelfAdded', message: $th->getMessage());
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
        $warehouses=Warehouse::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.product.productmanage.viewstock.shelf.modal.addshelfmodal',compact('warehouses'));
    }
}
