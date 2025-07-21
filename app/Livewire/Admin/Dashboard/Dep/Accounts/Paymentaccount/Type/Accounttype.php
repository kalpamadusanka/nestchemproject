<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Type;

use App\Models\Paymentaccounttype;
use Livewire\Component;

class Accounttype extends Component
{
    public $search;

    protected $listeners = ['accounttypeadded' => 'render'];

    public function openaccountypeaddmodal(){
        $this->dispatch('openaccountypeaddmodal');
    }

    public function deactiverecord($id){
        $accounttype=Paymentaccounttype::find($id);
        $accounttype->status=0;
        $accounttype->save();
        $this->render();
    }
    public function activerecord($id){
        $accounttype=Paymentaccounttype::find($id);
        $accounttype->status=1;
        $accounttype->save();
        $this->render();
    }

    public function deletedata($id){
        $accounttype=Paymentaccounttype::find($id);
        $accounttype->delete();
        $this->render();
    }
    public function render()
    {
        $accounttypedata=Paymentaccounttype::whereNotNull('status');
        if ($this->search) {
            $accounttypedata->where(function ($query) {
                $query->where('account_type', 'like', '%' . $this->search . '%');

            });
        }
        $accounttypedata=$accounttypedata->paginate(10);
        return view('livewire.admin.dashboard.dep.accounts.paymentaccount.type.accounttype',compact('accounttypedata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
