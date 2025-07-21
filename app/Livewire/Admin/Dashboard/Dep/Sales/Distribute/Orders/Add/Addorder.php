<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Add;

use App\Models\CanTransaction;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Loadingproduct;
use App\Models\Product;
use App\Models\Productstock;
use App\Models\Salesorder;
use App\Models\Salesorderitem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Addorder extends Component
{
    public $doNo, $invoice_no, $products, $total, $qty, $customerId;

    public $customer = '';
    public $searchTerm = '';
    public $suggestions = [];
    public $fetchedProducts;

    public $latitude, $longitude,$canfinaltotal;

    public $canTotal = 0;

    public $rules = [
        'invoice_no' => 'required',
        'customer' => 'required',

    ];

    public $canRecords = [
        ['size' => '20L', 'purchased' => 0, 'exchanged' => 0, 'price' => 0],
        ['size' => '10L', 'purchased' => 0, 'exchanged' => 0, 'price' => 0],
        ['size' => '4L', 'purchased' => 0, 'exchanged' => 0, 'price' => 0],
    ];



    public function updatedCustomer()
    {
        $this->suggestions = [];

        if (strlen($this->customer) >= 2) {
            $this->suggestions = Customer::where('company_name', 'like', '%' . $this->customer . '%')
                ->limit(5)
                ->pluck('company_name')
                ->toArray();
        }
    }

    public function selectSuggestion($username)
    {
        $this->customer = $username;
        $customerData = Customer::where('company_name', $username)->first();
        $this->customerId = $customerData->id;
        $this->suggestions = [];
    }
   public function generateInvoiceNo()
{
    $prefix = 'INV-' . now()->format('Ymd') . '-';
    $microtime = str_replace('.', '', microtime(true));
    $uniquePart = substr($microtime, -6); // Last 6 digits of microtime

    $this->invoice_no = $prefix . $uniquePart;
    return $this->invoice_no;
}
// Example: INV-20230627-456789

    public function UpdatedsearchTerm()
    {

        $this->mount($this->doNo);
    }

    public function mount($do_no)
    {
        $this->doNo = $do_no;


        // Fetch products as before
        $this->fetchedProducts = Loadingproduct::with(['productData', 'productStock'])
            ->whereHas('productData', function ($query) {
                $query->where('product_name', 'like', '%' . $this->searchTerm . '%');
            })
            ->where('do_no', $this->doNo)
            ->get();

        // Initialize products and set quantities from session if available
        $this->products = $this->fetchedProducts->map(function ($item) {
            // Use a unique identifier like product_id for the session key
            $productId = $item->productData->id;

            // Fetch quantity from session based on product_id
            $quantityFromSession = session()->get("product_quantities.{$productId}", 0);

            return [
                'selected' => false,
                'loading_id'=>$item->id,
                'product_name' => $item->productData->product_name ?? 'N/A',
                'total_qty' => $item->in_loading_stock,
                'stock_id' => $item->productStock->id,
                'uom' => $item->productData->uom ?? '',
                'quantity' => $quantityFromSession, // Set the quantity from session or 0 if not set
                'product_id' => $productId, // Store the product_id to reference it
            ];
        })->toArray();
    }

    public function resetForm()
    {
        session()->forget('product_quantities');
        $this->mount($this->doNo);
    }

    public function increaseQuantity($productId, $max)
    {
        // Find the product index by product_id
        $index = array_search($productId, array_column($this->products, 'product_id'));

        if ($index !== false) {
            if (!isset($this->products[$index]['quantity'])) {
                $this->products[$index]['quantity'] = 0;
            }

            if ($this->products[$index]['quantity'] < $max) {
                $this->products[$index]['quantity']++;
                $this->products[$index]['stock_id'];
                $this->updateTotal();
            }

            // Save updated quantity to session using product_id
            session()->put("product_quantities.{$productId}", $this->products[$index]['quantity']);
        }
    }

    public function decreaseQuantity($productId)
    {
        // Find the product index by product_id
        $index = array_search($productId, array_column($this->products, 'product_id'));

        if ($index !== false) {
            if (!isset($this->products[$index]['quantity'])) {
                $this->products[$index]['quantity'] = 0;
            }

            if ($this->products[$index]['quantity'] > 0) {
                $this->products[$index]['quantity']--;
                $this->products[$index]['stock_id'];

                $this->updateTotal();
            }

            // Save updated quantity to session using product_id
            session()->put("product_quantities.{$productId}", $this->products[$index]['quantity']);
        }
    }


    public function updateTotal()
    {
        $this->total = 0;
        $this->qty = 0;

        // Calculate total for products first
        foreach ($this->products as $product) {
            if (!isset($product['quantity'], $product['stock_id'])) {
                continue;
            }



            $stockData = Productstock::find($product['stock_id']);
            if ($stockData) {
                $this->total += ($product['quantity'] * $stockData->unit_price);
                $this->qty += $product['quantity'];
            }
        }
    }





    public function calculateCanTotal()
    {
        $canTotal = 0;
        $this->updateTotal();
        foreach ($this->canRecords as $record) {

            $canTotal += ($record['purchased'] * $record['price']);
            $canTotal -= ($record['exchanged'] * $record['price']);
        }

        $this->total += $canTotal;
        $this->canfinaltotal=$canTotal;
    }

    public function updateDeviceLocation($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }
    public function submit()
    {

        try {
            $this->validate();
            $filteredProducts = collect($this->products)
                ->filter(function ($product) {
                    return isset($product['quantity']) && $product['quantity'] > 0;
                });

            $user = Auth::user();
            $salesOrder = new Salesorder();
            $salesOrder->do_no = $this->doNo;
            $salesOrder->invoice_no = $this->invoice_no;

            $datePart = now()->format('Ymd'); // e.g., 20250506
            $uniquePart = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT); // Random 4-digit number or auto-increment
            $salesOrder->order_no = 'SO-' . $this->doNo . '-' . $datePart . '-' . $uniquePart;
            $salesOrder->customer = $this->customerId;
            $salesOrder->total_qty = $this->qty;
            $salesOrder->cantotal=$this->canfinaltotal;
            $salesOrder->total = $this->total;
            $salesOrder->due=$this->total;
            $salesOrder->added_by = $user->id;
            $salesOrder->latitude = $this->latitude;
            $salesOrder->longitude = $this->longitude;
            $salesOrder->status = 1;
            $salesOrder->save();

            foreach ($filteredProducts as $product) {
                Salesorderitem::create([
                    'order_no' => $salesOrder->order_no,
                    'loading_id'=>$product['loading_id'],
                    'do_no' => $this->doNo,
                    'product_id' => $product['product_id'],
                    'stock_id' => $product['stock_id'],
                    'quantity' => $product['quantity'],
                    'product_name' => $product['product_name'],
                    'added_by' => $user->id,
                ]);
                // $this->updateloadingproduct($product['loading_id'],$product['quantity']);
            }

            $this->saveCanrecords($this->doNo, $salesOrder->order_no);

            $this->reset('invoice_no', 'customer');
            $this->mount($this->doNo);
            session()->forget('product_quantities');
            $this->dispatch('salesAdded');
        } catch (\Throwable $th) {
            $this->dispatch('errorsalesAdded', message: $th->getMessage());
            DB::table('error_logs')->insert([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                'created_at' => now(),
            ]);
        }
    }



    public function updateloadingproduct($loadingId,$qty){
      try {
        $loadingData=Loadingproduct::where('id',$loadingId)->first();
        $loadingData->in_loading_stock -= $qty;
        $loadingData->save();
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
    public function saveCanrecords($doNo, $orderNo)
    {
        $user = Auth::user();
        foreach ($this->canRecords as $record) {
            CanTransaction::create([
                'order_no' => $orderNo,
                'do_no' => $doNo,
                'size' => $record['size'],
                'purchased_qty' => $record['purchased'],
                'exchanged_qty' => $record['exchanged'],
                'price_per_can' => $record['price'],
                'added_by' => $user->id,
            ]);
        }
    }


    public function render()
    {

        return view('livewire.admin.dashboard.dep.sales.distribute.orders.add.addorder')->layout('livewire.admin.dashboard.layout.master');
    }
}
