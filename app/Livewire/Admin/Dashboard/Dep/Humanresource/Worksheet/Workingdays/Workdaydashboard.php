<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Workingdays;

use App\Models\Workday;
use Livewire\Component;
use Livewire\WithPagination;

class Workdaydashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = ['workingdaysadded' => 'render','workdayupdated'=>'render'];
    public function addworkingdays(){
     $this->dispatch('workdaymodalopen');
    }

    public function active($id){
      $workday = Workday::find($id);
      $workday->status = 1;
      $workday->update();
      $this->dispatch('workdayupdated');
      $this->render();
    }

    public function deactive($id){
        $workdaydeactive = Workday::find($id);
        $workdaydeactive->status = 0;
        $workdaydeactive->update();
        $this->dispatch('workdayupdated');
        $this->render();
    }

    public function deleteworkday($id){
        $workday = Workday::find($id);
        $workday->delete();
        $this->dispatch('workdayupdated');
        $this->render();
    }


    public function render()
    {
        $workdays = Workday::whereNotNull('status')
        ->where(function ($query) {
            $query->where('workday', 'LIKE', '%' . $this->search . '%');// Search by name
        })
        ->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.worksheet.workingdays.workdaydashboard',compact('workdays'))->layout('livewire.admin.dashboard.layout.master');
    }
}
