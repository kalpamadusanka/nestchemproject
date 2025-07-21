<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Load\Loadproduct;


use App\Models\Loadingactivity;
use App\Models\Loadingproduct;
use App\Models\Product;
use App\Models\Productstock;
use App\Models\Saledispatch;
use App\Models\Shelf;
use App\Models\ShelfData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ongoingloading extends Component
{
    public $do_no,$search,$doStatus,$activities;


    protected $listeners = ['loadingproducts'=>'render'];

    public function mount($do_no){
        $this->do_no=$do_no;
        $doData=Saledispatch::where('do_no',$do_no)->first();
        $this->doStatus=$doData->loading_store_keeper;

        $this->activities=Loadingactivity::where('do_no',$this->do_no)->where('type','loading')->get();

    }

    public function setnewload($do_no){
        $dostatusCheck=Saledispatch::where('do_no',$do_no)->first();
        if($dostatusCheck->loading_store_keeper != null){
          $this->dispatch('errorloadproductmodal');
        }
        else{
            $this->dispatch('openloadproductmodal',$do_no);
        }

    }
 /////////@if (auth()->user() && auth()->user()->role === 'Store keeper')
    public function verifyload(){
       try {
        $user=Auth::user();
        $currentDo=Saledispatch::where('do_no',$this->do_no)->first();
        $currentDo->loading_received_by=$user->id;
        $currentDo->loading_store_keeper=$user->id;
        $currentDo->save();
        $this->dispatch('loadingverified');
        $this->notifyload($this->do_no);
        $this->updatestock($this->do_no);
       } catch (\Throwable $th) {
        $this->dispatch('errorloadingverified', message: $th->getMessage());

        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
        ]);
       }
    }

    public function updatestock($doNo){

          $loadproduct=Loadingproduct::where('do_no',$doNo)->get();

        foreach($loadproduct as $product){

             $productStockshelf=ShelfData::where('shelf_no',$product->shelf)->where('product_stock_id',$product->product_stock_id)->first();

// ...

try {
    DB::beginTransaction();

    if ($productStockshelf->qty >= $product->in_loading_stock) {
        $deductionQty = $product->in_loading_stock;

        // Update Product Stock Shelf
        $productStockshelf->qty -= $deductionQty;
        if (!$productStockshelf->save()) {
            throw new \Exception('Failed to update product stock shelf');
        }

        // Update Shelf Capacity
        $shelfCapacity = Shelf::find($productStockshelf->shelf_no);
        if (!$shelfCapacity) {
            throw new \Exception('Shelf not found');
        }
        $shelfCapacity->current_stock -= $deductionQty;
        if (!$shelfCapacity->save()) {
            throw new \Exception('Failed to update shelf capacity');
        }

        // Update Product Stock
        $productStock = Productstock::find($product->product_stock_id);
        if (!$productStock) {
            throw new \Exception('Product stock not found');
        }
        $productStock->qty -= $deductionQty;
        if (!$productStock->save()) {
            throw new \Exception('Failed to update product stock');
        }

        // Update Product Data
        $productData = Product::find($product->product_id);
        if (!$productData) {
            throw new \Exception('Product not found');
        }
        $productData->qty -= $deductionQty;
        if (!$productData->save()) {
            throw new \Exception('Failed to update product data');
        }

        DB::commit();
        $this->dispatch('loadverified');
    } else {
        throw new \Exception('Insufficient quantity in stock shelf');
    }
} catch (\Exception $e) {
    DB::rollBack();
       DB::table('error_logs')->insert([
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'created_at' => now(),
        ]);
    $this->dispatch('invalidQty', [
                'product_id' => $product->productData->product_code,
                'message' => 'Invalid qty in shelf for product : ' . $product->productData->product_code
            ]);

    // Or you can rethrow the exception if you want to handle it elsewhere
}


        }

    }

    public function notifyload($doNo){
        $loadactivity=new Loadingactivity();
        $loadactivity->do_no=$doNo;
        $loadactivity->type='loading';
        $loadactivity->activity='Load verified';
        $loadactivity->save();
    }

    public function deleteloadeditem($id){
       try {
        $loadedItem=Loadingproduct::find($id);
        $loadedItem->delete();
        $this->dispatch('loadproductdelete');
       } catch (\Throwable $th) {
        $this->dispatch('errorloadproductdelete', message: $th->getMessage());

        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
        ]);
       }
    }

    public function inventorycheck($doNo){
        $this->dispatch('inventoryviewmodal',$doNo);
    }
    public function render()
    {
        $loadedproducts=Loadingproduct::where('do_no',$this->do_no);
        if ($this->search) {
            $loadedproducts->where(function ($query) {
                $query->where('do_no', 'like', '%' . $this->search . '%')
                      ->orWhereHas('productData', function ($q) {
                          $q->where('product_code', 'like', '%' . $this->search . '%')
                            ->orWhere('product_name', 'like', '%' . $this->search . '%');
                      });
            });
        }
        $loadedproducts=$loadedproducts->paginate(100);
        return view('livewire.admin.dashboard.dep.sales.load.loadproduct.ongoingloading',compact('loadedproducts'))->layout('livewire.admin.dashboard.layout.master');
    }
}
