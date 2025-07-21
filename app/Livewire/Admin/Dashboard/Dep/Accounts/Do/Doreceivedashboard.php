<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Do;

use App\Models\Doexpenses;
use App\Models\Dofinalize;
use App\Models\Dofundespenses;
use App\Models\Expenses;
use App\Models\Fuelrecord;
use App\Models\Saledispatch;
use App\Models\Salesorder;
use Livewire\Component;
use Livewire\WithPagination;

class Doreceivedashboard extends Component
{
    use WithPagination;
 protected $paginationTheme = 'bootstrap';

 public $orderTotal,$fuelamount,$totalexpenses,$netprofit;
    public function mount(){
     $this->orderTotal=Dofinalize::where('status',1)->sum('total');
     $this->fuelamount=Fuelrecord::where('status',1)->sum('amount');
     $doexpenses=Dofinalize::where('status',1)->sum('expenses');
     $hrexpenses=Expenses::where('status',1)->sum('amount');
     $this->totalexpenses=$doexpenses;

     $this->netprofit=$this->orderTotal - $this->totalexpenses;
    }
    public function render()
    {
        $doendorders=Saledispatch::whereNotNull('end_time')->paginate(10);
        return view('livewire.admin.dashboard.dep.accounts.do.doreceivedashboard',compact('doendorders'))->layout('livewire.admin.dashboard.layout.master');
    }
}
