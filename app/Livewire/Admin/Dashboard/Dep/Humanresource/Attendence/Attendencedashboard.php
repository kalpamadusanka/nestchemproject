<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Attendence;

use App\Models\Leave;
use Livewire\Component;
use Livewire\WithPagination;

class Attendencedashboard extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $total_leaveform,$total_plannedleave,$total_unplannedleave,$total_pendingleave;
    protected $listeners = ['employeeleaveadded' => 'render','employeeleaveupdated'=>'render','leavedataupdated'=>'render'];
    public function openleavemodal(){
        $this->dispatch('openLeaveModal');
    }

    public function approve($id){
        // dd($id);
        $leave = Leave::find($id);
        $leave->leave_status = 'approved';
        $leave->save();
        $this->dispatch('employeeleaveupdated');
        $this->mount();
    }
    public function reject($id){
        $leave = Leave::find($id);
        $leave->leave_status = 'closed';
        $leave->save();
        $this->dispatch('employeeleaveupdated');
        $this->mount();
    }

    public function deleteleave($id){
        $leave = Leave::find($id);
        $leave->delete();
        $this->dispatch('employeeleaveupdated');
        $this->mount();
    }

    public function editleave($id){
        $this->dispatch('openLeaveeditModal',$id);
    }

    public function viewleave($id){
        $this->dispatch('openLeaveviewModal',$id);
    }

    public function mount(){
      $this->total_leaveform=Leave::count();
      $this->total_plannedleave=Leave::where('leave_status','approved')->count();
      $this->total_unplannedleave=Leave::where('leave_status','closed')->count();
      $this->total_pendingleave=Leave::where('leave_status','pending')->count();
    }
    public function render()
    {
        $leaves = Leave::where('status',1)->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.attendence.attendencedashboard',compact('leaves'))->layout('livewire.admin.dashboard.layout.master');
    }
}
