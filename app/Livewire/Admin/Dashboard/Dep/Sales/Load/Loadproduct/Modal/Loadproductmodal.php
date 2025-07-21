<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Load\Loadproduct\Modal;

use App\Models\Loadingactivity;
use App\Models\Loadingproduct;
use App\Models\Product;
use App\Models\Saledispatch;
use App\Models\ShelfData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Loadproductmodal extends Component
{
    public $openloadproduct=false;
    public $currentuser,$search,$doNo,$note;
    public $products = [];
    public $selected,$quantity,$shelf_id;

    protected $listeners = ['openloadproductmodal' => 'openModal'];

    protected $rules = [
        'products.*.selected' => 'boolean',
        'products.*.quantity' => 'required',

        'products.*.product_name' => 'required|string',
    ];

    public function mount(){
        $this->currentuser=Auth::user()->name;
        $this->loadProducts();

    }
    public function loadProducts()
    {
        $fetchedProducts = Product::with(['productStocks.shelfData.shelfCheck'])
            ->where('product_name', 'like', '%' . $this->search . '%')
            ->get();

        // Transform the fetched products into our working array format
        $this->products = $fetchedProducts->map(function($product) {
            // Get available shelves with quantities
            $availableShelves = collect();
            foreach ($product->productStocks as $stock) {
                foreach ($stock->shelfData as $shelfData) {
                    if ($shelfData->qty > 0 && $shelfData->shelfCheck) {
                        $availableShelves->push([
                            'id' => $shelfData->shelfCheck->id,
                            'shelf_no' => $shelfData->shelfCheck->shelf_no,
                            'qty' => $shelfData->qty
                        ]);
                    }
                }
            }

            return [
                'id' => $product->id,
                'selected' => false,
                'quantity' => 0,
                'shelf_id' => $availableShelves->isNotEmpty() ? $availableShelves->first()['id'] : null,
                'product_name' => $product->product_name,
                'product_group' => optional($product->productGroup)->product_group,
                'total_qty' => $product->qty,
                'uom' => $product->uom,
                'available_shelves' => $availableShelves,
                // Keep the original product data if needed
                'original_product' => $product
            ];
        })->toArray();
    }

    public function openModal($do_no){
        $this->doNo=$do_no;
        $this->openloadproduct=true;
    }

    public function closeModal(){
        $this->openloadproduct=false;
    }

    public function submit()
    {
        try {
            $user=Auth::user();
            $saledispatch = Saledispatch::where('do_no', $this->doNo)->first();
            $saledispatch->loading_prepared_by = $user->id;
            $saledispatch->load_status=1;
            $saledispatch->save();

            $this->notifyload($this->doNo);
            $this->updatedoNote($this->doNo,$this->note);

            foreach ($this->products as $product) {
                // Save only if selected is truthy (checkbox is checked)
                if (!empty($product['selected'])) {
                   $this->validate();
                    // Get the product model
                    $productModel = Product::where('product_name', $product['product_name'])->first();

                    if (!$productModel) {
                        continue; // Skip if product not found
                    }

                    $productStockId = ShelfData::where('shelf_no', $product['shelf_id'])
                        ->whereHas('productStockcCheck', function ($query) use ($productModel) {
                            $query->where('product_id', $productModel->id);
                        })
                        ->value('product_stock_id');


                    Loadingproduct::create([
                        'do_no'            => $this->doNo,
                        'product_id'       => $productModel->id,
                        'product_stock_id' => $productStockId,
                        'shelf'         => $product['shelf_id'],
                        'qty'         => $product['quantity'],
                        'in_loading_stock'         => $product['quantity'],
                    ]);


                }
            }

            $this->reset();
            $this->dispatch('loadingproducts');

        } catch (\Throwable $th) {
            $this->dispatch('errorloadingproducts', message: $th->getMessage());
            DB::table('error_logs')->insert([
                'message'    => $th->getMessage(),
                'file'       => $th->getFile(),
                'line'       => $th->getLine(),
                'trace'      => $th->getTraceAsString(),
                'created_at' => now(),
            ]);
        }
    }

    public function notifyload($doNo){
        $loadactivity=new Loadingactivity();
        $loadactivity->do_no=$doNo;
        $loadactivity->type='loading';
        $loadactivity->activity='Load prepared';
        $loadactivity->save();
    }

    public function updatedoNote($doNo,$note){
        $getDo=Saledispatch::where('do_no',$doNo)->first();
        $getDo->note=$note;
        $getDo->save();
    }

    public function render()
    {
        $this->mount();

        return view('livewire.admin.dashboard.dep.sales.load.loadproduct.modal.loadproductmodal');
    }
}
