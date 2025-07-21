<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Attendence\Monitorattendence;

use App\Models\Empattendence;
use Livewire\Component;
use Livewire\WithPagination;

class Attendencemonitordashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search,$totalworkedhour;

    protected $listeners = ['attendenceadded' => 'render'];
    public function openattendencemodal(){
        $this->dispatch('openattendenceModal');
    }

    public function deleteattendencedata($id){
        Empattendence::find($id)->delete();
        $this->dispatch('attendencedeleted');
    }
    public function deactiveattendencerecord($id){
        $attendenceEdit=Empattendence::find($id);
        $attendenceEdit->status=0;
        $attendenceEdit->update();
        $this->dispatch('attendencedeleted');
    }
    public function activeattendencerecord($id){
        $attendenceEdit=Empattendence::find($id);
        $attendenceEdit->status=1;
        $attendenceEdit->update();
        $this->dispatch('attendencedeleted');
    }
    public function render()
    {
        $attendenceData =Empattendence::whereNotNull('status');
        if ($this->search) {
            $attendenceData->where(function ($query) {
                $query->where('worked_hours', 'like', '%' . $this->search . '%')
                      ->orWhereHas('employeeData', function ($query) {
                          $query->where('username', 'like', '%' . $this->search . '%');
                      });
            });
            $this->totalworkedhour=$attendenceData->sum('worked_hours');
        }

        $attendenceData = $attendenceData->paginate(10);


        return view('livewire.admin.dashboard.dep.humanresource.attendence.monitorattendence.attendencemonitordashboard',compact('attendenceData'))->layout('livewire.admin.dashboard.layout.master');
    }
}
