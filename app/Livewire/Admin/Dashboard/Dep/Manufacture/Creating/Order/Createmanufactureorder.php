<?php

namespace App\Livewire\Admin\Dashboard\Dep\Manufacture\Creating\Order;

use App\Models\Manufacturedom;
use App\Models\Manufactureline;
use App\Models\Manufactureproductgroup;
use App\Models\Materialrequest;
use App\Models\Momaterial;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Milon\Barcode\Facades\DNS1DFacade;


class Createmanufactureorder extends Component
{
    use WithFileUploads;

    public $files = [];

    public $fileNames = [];

    public $product_group,$product,$qty,$st_date,$ed_date,$assigned_user,$manufacture_line_no;


    public $reference,$assignedperson;
    public $description,$barcodevalue;
    public $barcodeText,$materials;
    public $barcodeType = 'C128'; // Default barcode type
    public $barcodePreview;

    protected $rules = [
        // Your existing validation rules
        'product_group'=>'required',
        'product'=>'required',
        'barcodeType'=>'required',
        'qty'=>'required',
        'st_date'=>'required',
        'ed_date'=>'required',
        'assigned_user'=>'required',
        'barcodeText' => 'required',
        'selectedMaterials' => 'required|array|min:1',
        'selectedMaterials.*.quantity' => 'required|numeric|min:1',
    ];

    // In your Livewire component
public $selectedMaterial = '';
public $materialQuantity = 1;
public $selectedMaterials = [];


public function addMaterial()
{

    if ($this->selectedMaterial && $this->materialQuantity > 0) {
        $material = Momaterial::Where('id',$this->selectedMaterial)->first();

        // Check if material already exists in the array
        $existingIndex = collect($this->selectedMaterials)->search(function ($item) use ($material) {
            return $item['id'] == $material->id;
        });

        if ($existingIndex !== false) {
            // Update quantity if material already exists
            $this->selectedMaterials[$existingIndex]['quantity'] += $this->materialQuantity;
        } else {
            // Add new material
            $this->selectedMaterials[] = [
                'id' => $material->id,
                'code' => $material->material_id,
                'quantity' => $this->materialQuantity
            ];
        }

        // Reset selection

    }
}

public function removeMaterial($index)
{
    unset($this->selectedMaterials[$index]);
    $this->selectedMaterials = array_values($this->selectedMaterials); // Reindex array
}
    public function mount(){
        $this->materials = Momaterial::all();
        $this->manufacture_line_no = 'MO-' . date('YmdHis');
        $this->assignedperson=User::where('role', 'Superadmin')->get();
    }

    public function updatedBarcodeText()
    {

        $this->generateBarcode();
    }

    public function updatedBarcodeType()
    {
        $this->generateBarcode();
    }

    public function generateBarcode()
    {
      try {
        if (!empty($this->barcodeText)) {
            $this->barcodePreview = DNS1DFacade::getBarcodeSVG(
                $this->barcodeText,
                $this->barcodeType,
                2,
                60,
                'black',
                false
            );
        } else {
            $this->barcodePreview = null;
        }
      } catch (\Throwable $th) {
        //throw $th;
      }
    }

    public function updatedFiles()
    {
        // This will be triggered whenever files are selected
    }


    public function submit()
    {
        $user = Auth::user();

        // Start a database transaction
        DB::beginTransaction();

        try {
            $this->validate();

            // Create and save the manufacture line
            $manufacture = new Manufactureline();
            $manufacture->mo_no = $this->manufacture_line_no;
            $manufacture->product_group = $this->product_group;
            $manufacture->product = $this->product;
            $manufacture->barcode = $this->barcodeText;
            $manufacture->barcode_type = $this->barcodeType;

            if ($this->files) {
                $fileNames = [];
                foreach ($this->files as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('manufacture_files', $fileName,'public');
                    $fileNames[] = $fileName;

                }
                $manufacture->files = json_encode($fileNames);
            }

            $manufacture->qty = $this->qty;
            $manufacture->st_date = $this->st_date;
            $manufacture->ed_date = $this->ed_date;
            $manufacture->assigned = $this->assigned_user;
            $manufacture->mo_status = ($this->st_date == Carbon::today()->toDateString()) ? 'ongoing' : '';
            $manufacture->description = $this->description;
            $manufacture->added_by = $user->id;
            $manufacture->status = 1;

            $manufacture->save();

            // Process materials
            $materialsSaved = true;
            $materialErrors = [];

            foreach ($this->selectedMaterials as $material) {
                $materialId = $material['id'];
                $quantity = $material['quantity'];

                $materialCheck = Momaterial::where('id', $materialId)->first();

                if (!$materialCheck) {
                    $materialsSaved = false;
                    $materialErrors[] = "Material ID {$materialId} not found";
                    continue;
                }

                $materialStock = Momaterial::where('material_id', $materialCheck->material_id)->sum('quantity');

                if ($materialStock >= $quantity) {
                    Manufacturedom::create([
                        'mo_line_id' => $manufacture->mo_no, // Use the saved mo_no
                        'material_id' => $materialId,
                        'qty' => $quantity,
                        'added_by' => $user->id,
                        'status' => 1,
                    ]);
                } else {
                    $materialsSaved = false;
                    $materialErrors[] = "Insufficient stock for material ID {$materialId}";
                }
            }

            if (!$materialsSaved) {
                // Rollback the transaction if any material couldn't be saved
                DB::rollBack();

                // Delete any uploaded files
                // if (isset($fileNames)) {
                //     foreach ($fileNames as $fileName) {
                //         Storage::delete('public/manufacture_files/' . $fileName);
                //     }
                // }

                $this->dispatch('materialstockwarning', messages: $materialErrors);
                return;
            }

            // Commit the transaction if everything succeeded
            DB::commit();

            $this->dispatch('manufactureorderAdded');
            $this->reset();

        } catch (\Throwable $th) {
            // Rollback the transaction on any error
            DB::rollBack();

            // Delete any uploaded files
            // if (isset($fileNames)) {
            //     foreach ($fileNames as $fileName) {
            //         Storage::delete('public/manufacture_files/' . $fileName);
            //     }
            // }

            $this->dispatch('errormanufactureorderAdded', message: $th->getMessage());

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
        $products=Product::where('status',1)->get();
        $this->mount();

        return view('livewire.admin.dashboard.dep.manufacture.creating.order.createmanufactureorder',compact('productgroup','products'))->layout('livewire.admin.dashboard.layout.master');
    }
}
