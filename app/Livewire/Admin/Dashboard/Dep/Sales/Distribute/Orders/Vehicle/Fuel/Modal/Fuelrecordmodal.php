<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Vehicle\Fuel\Modal;

use App\Models\Fuelrecord;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Fuelrecordmodal extends Component
{

       public $date;
public $amount;
public $cost;
public $odometer;
public $notes,$dono;
    public $openfuelmodal=false;
     protected $listeners = ['viewfuelmodal' => 'openModal'];

     public function openModal($doNo){
     $this->dono=$doNo;
      $this->openfuelmodal=true;
     }



public function saveFuelRecord()
{
    $this->validate([
        'date' => 'required|date',
        'amount' => 'required|numeric|min:0',
        'cost' => 'required|numeric|min:0',
        'odometer' => 'required|numeric|min:0',
    ]);

    try {
        Fuelrecord::create([
            'do_no' => $this->dono,
            'date' => $this->date,
            'amount' => $this->amount,
            'cost' => $this->cost,
            'odometer' => $this->odometer,
            'status'=>1,
            'notes' => $this->notes,
        ]);

        $this->resetForm();
        $this->closeModal();
        $this->dispatch('fuelRecordAdded',$this->dono);
    } catch (\Exception $e) {
        // Log error if needed
        logger()->error('Fuel Record Save Failed: ' . $e->getMessage());

        // Dispatch an error event
          DB::table('error_logs')->insert([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'created_at' => now(),
            ]);
        $this->dispatch('fuelRecordFailed', ['message' => 'Failed to save fuel record. Please try again.']);
    }
}


private function resetForm()
{
    $this->reset([
        'date', 'amount', 'cost', 'odometer', 'notes'
    ]);
}

public function closeModal()
{
    $this->openfuelmodal = false;
    $this->resetForm();
}
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.vehicle.fuel.modal.fuelrecordmodal');
    }
}
