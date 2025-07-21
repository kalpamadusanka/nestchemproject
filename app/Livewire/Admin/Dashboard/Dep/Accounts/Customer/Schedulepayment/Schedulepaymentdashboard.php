<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Schedulepayment;

use App\Models\Customerreceivepayment;
use App\Models\Notifypaymentschedule;
use App\Models\Schedulepayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Schedulepaymentdashboard extends Component
{
       use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $todayscheduleCount,$totalschedule,$todaycompleted,$todaypayments;
        protected $listeners = ['markasreceived' => 'render'];

    public function mount(){
      $today = Carbon::today()->toDateString(); // Gets today's date in 'Y-m-d' format
      $this->todayscheduleCount = Schedulepayment::whereDate('date', $today)->count();
      $this->totalschedule=Schedulepayment::where('status',1)->count();
       $this->todaycompleted = Schedulepayment::whereDate('date', $today)->whereNotNull('taken_by')->count();

       $this->todaypayments=Customerreceivepayment::where('status',1)->take(3)->get();
    }
    public function render()
    {
        $schedulepayment = Notifypaymentschedule::where('status',1);
        $schedulepayment=$schedulepayment->paginate(10);
        return view('livewire.admin.dashboard.dep.accounts.customer.schedulepayment.schedulepaymentdashboard',compact('schedulepayment'))->layout('livewire.admin.dashboard.layout.master');
    }

    public function markasreceived($paymentscheduleid){
        $user=Auth::user();
      $schedulepayment=Schedulepayment::find($paymentscheduleid);
      $schedulepayment->taken_by=$user->id;
      $result= $schedulepayment->save();
    if($result){
        $this->dispatch('markasreceived');
        $this->mount();
    }

    }
}
