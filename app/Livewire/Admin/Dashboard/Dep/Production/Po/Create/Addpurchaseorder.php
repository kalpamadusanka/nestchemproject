<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Po\Create;

use App\Models\Material;
use App\Models\Paymentaccount;
use App\Models\Poitems;
use App\Models\Purchaseorder;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Addpurchaseorder extends Component
{
    public $rows = [];
    public $subtotal = 0;
    public $total = 0;
    public $suggestions = [];
    public $amounttax = 'exclusive';
    public $tax_rate = 0;
    public $order_number,$date,$currency,$reference,$delivery_address,$attention,$telephone,$note,$contactID;
    public $contact = '';
    public $showDropdown = false;
    public $suppliers = [];
    public $paymentAccounts = [];


    public function updated($propertyName)
    {
        if (preg_match('/^rows\.(\d+)\.item$/', $propertyName, $matches)) {
            $index = $matches[1];
            $this->fetchSuggestions($index);
        }
        $this->calculateAmount();
        $this->calculateSubtotal();
        $this->calculateTotal();
    }



    public function calculateAmount()
    {

        try {
            foreach ($this->rows as $index => &$row) {
                $quantity = $row['quantity'] ?? 0;
                $unit_price = $row['unit_price'] ?? 0;
                $discount = $row['discount'] ?? 0;
                $tax_rate = $row['tax_rate'] ?? 0;

                $amountBeforeTax = $quantity * $unit_price * (1 - ($discount / 100));

                if ($this->amounttax == 'exclusive') {
                    // Tax Exclusive: Calculate amount without tax
                    $row['amount'] = $amountBeforeTax;
                } else {
                    // Tax Inclusive: Calculate amount with tax already included
                    $row['amount'] = $amountBeforeTax * (1 + ($tax_rate / 100));
                }
            }
        } catch (\Throwable $th) {
            DB::table('error_logs')->insert([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                'created_at' => now(),
      ]);
        }


        $this->calculateSubtotal();
        $this->calculateTotal();
    }

    public function calculateSubtotal()
    {
        // Sum of the amounts from each row
        $this->subtotal = array_sum(array_map(function ($row) {
            return $row['amount'] ?? 0;
        }, $this->rows));
    }

    public function calculateTotal()
    {
        if ($this->amounttax == 'exclusive') {
            // Tax Exclusive: Simply use the subtotal
            $this->total = $this->subtotal;
        } else {
            // Tax Inclusive: Use the subtotal since the tax is already included
            $this->total = $this->subtotal;
        }
    }





    public function fetchSuggestions($index)
    {
        $query = $this->rows[$index]['item'] ?? '';

        if (strlen($query) > 1) {
            $this->suggestions[$index] = $this->getMatchingItems($query);
        } else {
            $this->suggestions[$index] = [];
        }
    }

    private function getMatchingItems($query)
    {
        return Material::where('name', 'like', "%$query%")
        ->orWhere('code', 'like', "%$query%")
        ->limit(5)
        ->pluck('code')
        ->toArray();

    }

    public function selectItem($index, $item)
    {
        $this->rows[$index]['item'] = $item;
        $this->suggestions[$index] = [];
    }
    public function mount(){
        $this->paymentAccounts = Paymentaccount::all();
     $this->order_number = 'PO-' . date('YmdHis');
     $this->rows = [
        ['item' => '', 'description' => '', 'quantity' => 0, 'unit_price' => 0, 'discount' => 0, 'account' => '', 'tax_rate' => 0, 'amount' => 0],
    ];
    }

    public function updatedContact($value)
    {
        if (strlen($value) >= 2) {
            $this->suppliers = Supplier::where('contact_person', 'like', '%' . $value . '%')->get();
            $this->showDropdown = true;
        } else {
            $this->showDropdown = false;
        }
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function selectSupplier($supplierId)
    {
        $supplier = Supplier::find($supplierId);
        $this->contact = $supplier->contact_person;
        $this->contactID = $supplier->id;
        $this->showDropdown = false;
    }

    public function addRow()
    {
        $this->rows[] = [
            'item' => '',
            'description' => '',
            'quantity' => 0,
            'unit_price' => 0,
            'discount' => 0,
            'account' => '',
            'tax_rate' => 0,
            'lot'=>'',
            'batch'=>'',
            'exp_date'=>'',
            'amount' => 0,
        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reindex the array
    }

    public function submit(){
        $this->validate([
            'contact' => 'required',
            'date' => 'required|date',
            'order_number' => 'required|unique:purchase_order,order_no',
            'amounttax' => 'required',
            'subtotal' => 'numeric|min:0',
            'total' => 'numeric|min:0',
            'rows.*.item' => 'required',
            'rows.*.quantity' => 'required|numeric|min:1',
            'rows.*.unit_price' => 'required|numeric|min:0',
            'rows.*.amount' => 'required|numeric|min:0',
            'rows.*.lot' => 'required',
            'rows.*.batch' => 'required',
            'rows.*.exp_date' => 'required',

        ]);


      try {
        $user=Auth::user();

        $purchaseOrder = Purchaseorder::create([
            'contact_person_id' => $this->contactID,
            'date' => $this->date,
            'order_no' => $this->order_number,
            'reference' => $this->reference,
            'currency' => 'LKR',
            'amount_tax_status' => $this->amounttax,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'due_amount'=>$this->total,
            'delivery_address' => $this->delivery_address,
            'attention' => $this->attention,
            'telephone' => $this->telephone,
            'note' => $this->note,
            'po_status'=>'awaiting_approve',
            'added_by'=>$user->id,
            'status'=>1,
        ]);

        foreach ($this->rows as $row) {
            Poitems::create([
                'purchase_order_id' => $purchaseOrder->id,
                'item' => $row['item'],
                'description' => $row['description'],
                'quantity' => $row['quantity'],
                'unit_price' => $row['unit_price'],
                'discount' => $row['discount'],
                'account_id' => $row['account'] ?: null,
                'tax_rate' => $row['tax_rate'],
                'lot' => $row['lot'],
                'batch' => $row['batch'],
                'exp_date' => $row['exp_date'],
                'amount' => $row['amount'],
                'added_by'=>$user->id,
                'status'=>1,
            ]);
        }
        $this->dispatch('poadded');
      } catch (\Throwable $th) {
        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
  ]);
      }

        $this->reset(); // Reset the form
        $this->mount(); // Reset rows
    }
    public function render()
    {
        $attentionlist = User::whereIn('role', [
            'Superadmin',
            'Accountant',
            'Assistance accountant',
            'Material Import Coordinator',
            'Production Manager'
        ])->get();
        return view('livewire.admin.dashboard.dep.production.po.create.addpurchaseorder',compact('attentionlist'))->layout('livewire.admin.dashboard.layout.master');
    }
}
