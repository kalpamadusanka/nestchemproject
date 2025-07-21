<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Track;

use Livewire\Component;

class Trackdashboard extends Component
{
    public $latitude;
    public $longitude;

    protected $listeners = ['updateDeviceLocation'];

    public function updateDeviceLocation($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;

        // Optional: save to DB
        // auth()->user()->update([
        //     'latitude' => $lat,
        //     'longitude' => $lng,
        // ]);
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.track.trackdashboard')->layout('livewire.admin.dashboard.layout.master');
    }
}
