<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Vehicle\Trip;

use App\Models\Trip;
use Carbon\Carbon;
use Livewire\Component;

class Tripmanage extends Component
{
    public $doNo;
     public $startkm,$finalFuel;
    public $endkm;
    public $fuel;
    public $activeTrip = null;

    protected $rules=[
        'startkm'=>'required',
        'fuel'=>'required',
    ];

public function mount($doNo)
{
    $this->doNo = $doNo;
   $this->activeTrip = Trip::where('do_no',$doNo)->whereNull('end_km')->first();
        if ($this->activeTrip) {
            $this->startkm = $this->activeTrip->start_km;
            $this->fuel = $this->activeTrip->initial_fuel;
        }
        else{
            $active=Trip::where('do_no',$doNo)->first();
             $this->startkm = $active->start_km ?? 0;
             $this->endkm=$active->end_km ?? 0;
            $this->fuel = $active->initial_fuel ?? 0;
               $this->finalFuel = $active->final_fuel ?? 0;
            $this->activeTrip=Trip::where('do_no',$doNo)->first();
        }

}



    public function submit()
    {
       $this->validate();

     $triprecord = Trip::where('do_no', $this->doNo)
    ->whereDate('created_at', Carbon::today())
    ->first();

if (!$triprecord) {
    $triprecord = new Trip();
    $triprecord->do_no = $this->doNo;
$triprecord->start_km = $this->startkm;
$triprecord->initial_fuel = $this->fuel;

$triprecord->status=1;
$result=$triprecord->save();

if($result){
$this->dispatch('dovehiclerecordered');
$this->mount($this->doNo);
}
}
else{
    $startkm=$triprecord->start_km;
    $distance=$this->endkm - $startkm;
$triprecord->update([
    'end_km' => $this->endkm,
    'distance' => $distance,
    'final_fuel'=>$this->finalFuel,
]);
$this->dispatch('dovehicleendkmupdated');
$this->mount($this->doNo);
}


    }
// or simply:

    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.vehicle.trip.tripmanage');
    }
}
