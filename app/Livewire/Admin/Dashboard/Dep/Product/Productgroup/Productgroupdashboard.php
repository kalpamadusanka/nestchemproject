<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productgroup;

use App\Models\Manufactureproductgroup;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Productgroupdashboard extends Component
{

    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    public $search;

    public function productgroupaddmodal(){
        $this->dispatch('addproductgroupmodal');
    }

    public function deletedata($id){
      try {
        $data=Manufactureproductgroup::find($id);
        $data->delete();
        $this->dispatch('productgroupdeleted');
      } catch (\Throwable $th) {
        $this->dispatch('errorproductgroupdeleted', message: $th->getMessage());
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
        $requestdata=Manufactureproductgroup::whereNotNull('status');

        if ($this->search) {
            $requestdata->where(function ($query) {
                $query->where('product_group', 'like', '%' . $this->search . '%');

            });
        }
        $requestdata=$requestdata->paginate(10);
        return view('livewire.admin.dashboard.dep.product.productgroup.productgroupdashboard',compact('requestdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
