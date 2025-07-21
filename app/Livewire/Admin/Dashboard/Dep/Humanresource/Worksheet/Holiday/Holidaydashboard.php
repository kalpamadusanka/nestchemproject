<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Holiday;

use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;

class Holidaydashboard extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = ['holidayadded' => 'render','holidayupdated'=>'render'];
    public function addholiday(){
      $this->dispatch('openholidaymodal');
    }

    public function deactive($id){
        $holiday = Holiday::find($id);
        $holiday->status = 0;
        $holiday->update();
        $this->dispatch('holidayupdated');
    }
    public function active($id){
        $holiday = Holiday::find($id);
        $holiday->status = 1;
        $holiday->update();
        $this->dispatch('holidayupdated');
    }

    public function deleteholiday($id){
        $holiday = Holiday::find($id);
        $holiday->delete();
        $this->dispatch('holidayupdated');
    }
    public function render()
    {
        $holidays = Holiday::whereNotNull('status')
        ->where(function ($query) {
            $query->where('holiday', 'LIKE', '%' . $this->search . '%');// Search by name
        })
        ->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.worksheet.holiday.holidaydashboard',compact('holidays'))->layout('livewire.admin.dashboard.layout.master');
    }
}
