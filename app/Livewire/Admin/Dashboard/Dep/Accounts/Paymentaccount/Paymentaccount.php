<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount;

use App\Models\Paymentaccount as ModelsPaymentaccount;
use Livewire\Component;
use Livewire\WithPagination;

class Paymentaccount extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = ['paymentaccountadded' => 'render','funddeposite'=>'render','cashoutsuccess'=>'render'];
    public function openpaymentaccountaddmodal(){
        $this->dispatch('paymentaccountaddmodal');
    }
    public function activerecord($id){
        $paymentaccount = ModelsPaymentaccount::find($id);
        $paymentaccount->status=1;
        $paymentaccount->update();
        $this->render();
    }
    public function deactiverecord($id){
        $paymentaccount = ModelsPaymentaccount::find($id);
        $paymentaccount->status=0;
        $paymentaccount->update();
        $this->render();
    }
    public function deletedata($id){
        $paymentaccount = ModelsPaymentaccount::find($id);
        $paymentaccount->delete();
        $this->render();
    }

    public function editpaymentacc($id){
      $this->dispatch('editpaymentaccount',$id);
    }

    public function opendepositmodal($id){
        $this->dispatch('opendipositmodal',$id);
    }

    public function cashout($id): void{
        $this->dispatch('openCashOutModal',$id);
    }

    public function render()
    {
        $accountdata=ModelsPaymentaccount::whereNotNull('status');
        if ($this->search) {
            $accountdata->where(function ($query) {
                $query->where('account_name', 'like', '%' . $this->search . '%');

            });
        }
        $accountdata=$accountdata->paginate(10);
        return view('livewire.admin.dashboard.dep.accounts.paymentaccount.paymentaccount',compact('accountdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
