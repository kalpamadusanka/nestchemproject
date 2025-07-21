<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Paymentmethods;

use App\Models\Paymentmethods;
use Livewire\Component;
use Livewire\WithPagination;

class Paymentmethoddashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['paymentmethodadded' => 'render','paymentmethodupdated'=>'render'];

    public $search;

    public function openpaymentmethodmodal(){
        $this->dispatch('openpaymentmethodmodal');
    }

    public function activepaymentmethod($id){
        $paymentmethod = Paymentmethods::find($id);
        $paymentmethod->status = 1;
        $paymentmethod->update();
        $this->dispatch('paymentmethodupdated');
    }

    public function deactivepaymentmethod($id){
        $paymentmethod = Paymentmethods::find($id);
        $paymentmethod->status = 0;
        $paymentmethod->update();
        $this->dispatch('paymentmethodupdated');

    }

    public function deletepaymentmethod($id){
        $paymentmethod = Paymentmethods::find($id);
        $paymentmethod->delete();
        $this->dispatch('paymentmethodupdated');
    }
    public function render()
    {
        $paymentmethods =Paymentmethods::whereNotNull('status')
        ->where(function ($query) {
            $query->where('payment_method', 'LIKE', '%' . $this->search . '%');// Search by name
        })
        ->paginate(10);

        return view('livewire.admin.dashboard.dep.humanresource.expenses.paymentmethods.paymentmethoddashboard',compact('paymentmethods'))->layout('livewire.admin.dashboard.layout.master');
    }
}
