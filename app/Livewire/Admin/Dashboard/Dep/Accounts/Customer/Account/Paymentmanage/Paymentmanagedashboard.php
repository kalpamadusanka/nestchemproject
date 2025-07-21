<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account\Paymentmanage;

use App\Models\Customerreceivepayment;
use App\Models\Paymentaccount;
use Livewire\Component;
use Livewire\WithPagination;

class Paymentmanagedashboard extends Component
{
       use WithPagination;
       public $openpaymentaccmodal=false;

       protected $listeners = ['paymentallocated' => 'render'];
    protected $paginationTheme = 'bootstrap';
     public $totalpayment,$totalallocated,$totalunallocated,$newpaymentcount,$allocationpendingcount;
     public $amount,$payment_date,$customername,$paymentAccounts,$paymentid,$search;
      public $perPage = 10;
      protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount(){
        $this->totalpayment=Customerreceivepayment::where('approved',1)->sum('amount');
        $this->totalallocated=Customerreceivepayment::whereNotNull('allocated')->sum('amount');
        $this->totalunallocated=Customerreceivepayment::whereNull('allocated')->sum('amount');
       $this->newpaymentcount = Customerreceivepayment::whereDate('created_at', today())->count();
       $this->allocationpendingcount=Customerreceivepayment::where('approved',1)->whereNull('allocated')->count();
    }

    public function allocatepayment($unallocatedid){

    $this->dispatch('openallocatemodal',$unallocatedid);
    }
    public function render()
    {
     $unallocatedQuery = Customerreceivepayment::whereNull('allocated')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('amount', 'like', '%'.$this->search.'%')
                      ->orWhere('invoice_no', 'like', '%'.$this->search.'%');
                    // Add other searchable fields as needed
                });
            });

        $unallocatecount = $unallocatedQuery->count();
        $unallocatedpayment = $unallocatedQuery->paginate($this->perPage);

        // Query for allocated payments with search
        $allocatedQuery = Customerreceivepayment::whereNotNull('allocated')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('amount', 'like', '%'.$this->search.'%')
                      ->orWhere('invoice_no', 'like', '%'.$this->search.'%');
                    // Add other searchable fields as needed
                });
            });

        $allocatecount = $allocatedQuery->count();
        $allocatedpayment = $allocatedQuery->paginate($this->perPage);
        return view('livewire.admin.dashboard.dep.accounts.customer.account.paymentmanage.paymentmanagedashboard',compact('unallocatecount','unallocatedpayment','allocatecount','allocatedpayment'))->layout('livewire.admin.dashboard.layout.master');
    }
}
