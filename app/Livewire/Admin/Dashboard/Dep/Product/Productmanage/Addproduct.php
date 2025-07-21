<?php

namespace App\Livewire\Admin\Dashboard\Dep\Product\Productmanage;

use App\Models\Manufactureproductgroup;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Addproduct extends Component
{
    use WithFileUploads;

    public $product_images = [];
    public $temp_images = [];
    public $featured_image_index;

    public $product_name,$product_code,$qty,$uom,$alert_qty,$product_group;
    // ... your other properties ...

    protected $rules = [
        'product_images.*' => 'image|max:2048',
        'product_name'=>'required',
        'product_code'=>'required | unique:product',
        'uom'=>'required',
        'alert_qty'=>'required',
        'product_group'=>'required',
    ];

    public function updatedProductImages()
    {
        $this->validate([
            'product_images.*' => 'image|max:2048',
        ]);

        // Create temporary preview URLs
        $this->temp_images = [];
        foreach ($this->product_images as $image) {
            $this->temp_images[] = $image->temporaryUrl();
        }
    }

    public function removeTempImage($index)
    {
        array_splice($this->temp_images, $index, 1);
        array_splice($this->product_images, $index, 1);
    }

    public function submit(){
         $user=Auth::user();
        try {
            $this->validate();
            $product=new Product();
            $product->product_name = $this->product_name;
            $product->product_code=$this->product_code;

            if($this->product_images){
                foreach ($this->product_images as $image) {


                    $extension = $image->getClientOriginalExtension();
                    $uniqueFilename = time() . '_' . uniqid() . '.' . $extension;

                    // Store the image in the public disk (storage/app/public/product)
                    $image->storeAs('product', $uniqueFilename, 'public');

                    // Store the filename directly (without JSON encoding)
                    $product->product_image = $uniqueFilename;
                }


            }


            $product->qty=0;
            $product->uom=$this->uom;
            $product->alert_qty=$this->alert_qty;
            $product->added_by=$user->id;
            $product->product_group=$this->product_group;
            $product->status=1;
            $product->save();
            $this->reset();
            $this->dispatch('productAdded');

        } catch (\Throwable $th) {
            $this->dispatch('errorproductAdded', message: $th->getMessage());
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
        $productgroup=Manufactureproductgroup::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.product.productmanage.addproduct',compact('productgroup'))->layout('livewire.admin.dashboard.layout.master');
    }
}
