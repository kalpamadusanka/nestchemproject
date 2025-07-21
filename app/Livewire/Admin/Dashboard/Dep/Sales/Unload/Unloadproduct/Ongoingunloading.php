<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Unload\Unloadproduct;

use App\Models\Loadingactivity;
use App\Models\Loadingproduct;
use App\Models\Saledispatch;
use App\Models\Unloadingproduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Ongoingunloading extends Component
{
    use WithPagination;
    public $do_no, $search, $doStatus, $activities,$searchrecord;
    protected $paginationTheme = 'bootstrap';


     protected $listeners = ['unloadeddo' => 'render'];
    public $loadedproducts;
    public $quantities = [];

    public function mount($do_no)
    {
        $this->do_no = $do_no;
        $doData = Saledispatch::where('do_no', $do_no)->first();
        $this->doStatus = $doData->unloading_store_keeper;


        $this->activities = Loadingactivity::where('do_no', $this->do_no)->where('type', 'loading')->get();

  $this->loadedproducts = Loadingproduct::with('productData')
            ->where('do_no', $this->do_no)
            ->get();

        foreach ($this->loadedproducts as $index => $product) {
            $this->quantities[$index] = $product->in_loading_stock ?? 0;
        }
    }

    public function verifyunload(){
        $user=Auth::user();
        $doNew=Saledispatch::where('do_no',$this->do_no)->first();
        $doNew->unloading_store_keeper=$user->id;
        $doNew->unload_status=1;
        $doNew->save();
        $this->dispatch('unloadeddo');
    }

   public function increment($index)
{
    $stock = $this->loadedproducts[$index]->in_loading_stock ?? 0;

    if ($this->quantities[$index] < $stock) {
        $this->quantities[$index]++;
    }
}


     public function decrement($index)
     {
         if ($this->quantities[$index] > 0) {
             $this->quantities[$index]--;
         }
     }

    public function saveProducts()
    {
        $user = Auth::user();
        foreach ($this->loadedproducts as $index => $product) {
            $qty = $this->quantities[$index] ?? 0;


            $exists = Unloadingproduct::where('do_no', $this->do_no)
                ->where('product_id', $product->product_id)
                ->exists();

            if (!$exists) {
                Unloadingproduct::create([
                    'do_no' => $this->do_no,
                    'product_id' => $product->product_id,
                    'unload_qty' => $qty,
                    'added_by' => $user->id,
                    'received_by' => $user->id,
                ]);


            }
        }
        $docheck=Saledispatch::where('do_no',$this->do_no)->first();
        $docheck->unloading_prepared_by=$user->id;
        $docheck->unloading_received_by=$user->id;
        $docheck->save();

        $this->dispatch('unloadedsuccess');
       $this->mount($this->do_no);
    }

    public function render()
    {

        $loadedproducts = Loadingproduct::where('do_no', $this->do_no);
        if ($this->search) {
            $loadedproducts->where(function ($query) {
                $query->where('do_no', 'like', '%' . $this->search . '%')
                    ->orWhereHas('productData', function ($q) {
                        $q->where('product_code', 'like', '%' . $this->search . '%')
                            ->orWhere('product_name', 'like', '%' . $this->search . '%');
                    });
            });
        }
        $loadedproducts = $loadedproducts->paginate(100);

           $unloadedproducts = Unloadingproduct::where('do_no', $this->do_no);
        if ($this->searchrecord) {
            $loadedproducts->where(function ($query) {
                $query->where('do_no', 'like', '%' . $this->searchrecord . '%')
                    ->orWhereHas('productData', function ($q) {
                        $q->where('product_code', 'like', '%' . $this->searchrecord . '%')
                            ->orWhere('product_name', 'like', '%' . $this->searchrecord . '%');
                    });
            });
        }
        $unloadedproducts = $unloadedproducts->paginate(100);
        return view('livewire.admin.dashboard.dep.sales.unload.unloadproduct.ongoingunloading', compact('loadedproducts','unloadedproducts'))->layout('livewire.admin.dashboard.layout.master');
    }
}
