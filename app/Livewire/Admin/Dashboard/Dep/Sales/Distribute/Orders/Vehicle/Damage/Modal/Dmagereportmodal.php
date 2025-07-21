<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Vehicle\Damage\Modal;

use App\Models\Damagerecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dmagereportmodal extends Component
{
     public $doNo;
    public $opendamagemodal=false;

public $problem;


protected $rules = [
    'problem' => 'required|string|min:10|max:1000',

];
     protected $listeners = ['opendmagereportmodal' => 'openModal'];

     public function openModal($doNo){
        $this->doNo=$doNo;
        $this->opendamagemodal=true;
     }
     public function closeModal(){
        $this->opendamagemodal=false;
     }

   public function saveFuelRecord()
{
    $this->validate();
    $user=Auth::user();

    try {
        // Attempt to create the record
        $damageRecord = Damagerecord::create([
            'do_no' => $this->doNo,
            'problem' => $this->problem,
            'reported_by'=>$user->id,
            // Add other fields as needed
        ]);

        // If successful
        $this->closeModal();
        $this->dispatch('damagerecordAdded', $this->doNo);
        $this->reset();



    } catch (\Exception $e) {
        // If creation fails
          DB::table('error_logs')->insert([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'created_at' => now(),
            ]);
        $this->dispatch('recordAddFailed', 'Failed to add record: ' . $e->getMessage());

        // Optional: Show error message


        // You might want to keep the modal open to let the user retry
        // $this->opendamagemodal = true;
    }
}

    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.vehicle.damage.modal.dmagereportmodal');
    }
}
