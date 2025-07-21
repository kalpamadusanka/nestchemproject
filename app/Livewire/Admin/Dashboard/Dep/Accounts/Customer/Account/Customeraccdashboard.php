<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Customeraccdashboard extends Component
{
     use WithPagination;
     protected $paginationTheme = 'bootstrap';
     public $searchTerm;
     public function searchCustomer()
{
    // The search will automatically update due to wire:model
}
    public function render()
    {
          $customeracc = Customer::when($this->searchTerm, function ($query) {
        $query->where('company_name', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('email', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('phone', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('contact_person', 'like', '%'.$this->searchTerm.'%');
    })->paginate(10);
        return view('livewire.admin.dashboard.dep.accounts.customer.account.customeraccdashboard',compact('customeracc'))->layout('livewire.admin.dashboard.layout.master');
    }
}
