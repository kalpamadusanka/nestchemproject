<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Load\Loadproduct\Modal;

use App\Models\CanTransaction;
use App\Models\Loadingproduct;
use App\Models\Salesorder;
use Livewire\Component;

class Loadinventorymodal extends Component
{
    public $opencurrentinventory=false;
    public $selectedDO,$inventoryItem,$totalAmount,$canTotal,$purchasedCans,$exchangedCans,$totalQtySold;
    protected $listeners = ['inventoryviewmodal' => 'openModal'];
    public function openModal($doNo){
        $this->selectedDO=$doNo;
    $this->opencurrentinventory=true;
    $this->inventoryItem=Loadingproduct::where('do_no',$doNo)->get();

    $salesOrders = Salesorder::where('do_no', $doNo)->get();
    $canTransactions = CanTransaction::where('do_no', $doNo)->get();

    $this->totalAmount = $salesOrders->sum('total');
    $this->canTotal = $salesOrders->sum('cantotal');
    $this->totalQtySold = $salesOrders->sum('total_qty');

    $this->purchasedCans = $canTransactions->sum('purchased_qty');
    $this->exchangedCans = $canTransactions->sum('exchanged_qty');

    }
    public function closeModal(){
        $this->opencurrentinventory=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.load.loadproduct.modal.loadinventorymodal');
    }
}
