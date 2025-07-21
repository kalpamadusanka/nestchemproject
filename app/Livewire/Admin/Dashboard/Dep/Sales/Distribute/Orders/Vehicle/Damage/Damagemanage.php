<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Vehicle\Damage;

use App\Models\Damagerecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Damagemanage extends Component
{
    public $doNo;

    public $damagerecord,$loguser;

        protected $listeners = ['damagerecordAdded' => 'mount'];
    public function mount($doNo){
       try {
         $this->loguser=Auth::user();
    $this->doNo=$doNo;
    $this->damagerecord=Damagerecord::where('do_no',$this->doNo)->get();
       } catch (\Throwable $e) {
         DB::table('error_logs')->insert([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'created_at' => now(),
            ]);
       }
    }

    public function deleteDamage($id){
        $dmagerecord=Damagerecord::where('id',$id)->first();
        $dmagerecord->delete();
        $this->mount($this->doNo);
        $this->dispatch('damagerepdeleted');
    }

    public function damagereportmodal(){
        $this->dispatch('opendmagereportmodal',$this->doNo);
    }

    public function updateStatus($id, $status)
{
    $record = Damagerecord::find($id);

    if ($record) {

        $record->status = $status;
        $record->save();
    }
    $this->mount($this->doNo);
    // Optionally refresh the record list

}

    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.vehicle.damage.damagemanage');
    }
}
