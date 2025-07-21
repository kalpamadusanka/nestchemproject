<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productgroup\Modal;

use App\Models\Manufactureproductgroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Productgroupmodal extends Component
{
    public $openproductgroupmodal=false;

    public $group_name,$code;

    protected $rules=[
     'group_name'=>'required',
     'code'=>'required',
    ];

    protected $listeners = ['addproductgroupmodal' => 'openModal'];

    public function openModal(){
      $this->openproductgroupmodal=true;

    }

    public function submit(){
     try {
        $user=Auth::user();
        $this->validate();
        $productgroup=new Manufactureproductgroup();
        $productgroup->code=$this->code;
        $productgroup->product_group=$this->group_name;
        $productgroup->added_by=$user->id;
        $productgroup->status=1;
        $productgroup->save();
        $this->dispatch('productgroupadded');
        $this->reset();
     } catch (\Throwable $th) {
        $this->dispatch('errorproductgroupadded', message: $th->getMessage());
        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
        ]);
     }
     $this->closeModal();
    }

    public function closeModal(){
        $this->openproductgroupmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.product.productgroup.modal.productgroupmodal');
    }
}
