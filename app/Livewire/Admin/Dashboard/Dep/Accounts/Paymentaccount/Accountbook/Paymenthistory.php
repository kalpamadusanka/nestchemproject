<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Paymentaccount\Accountbook;

use App\Models\Paymentacchistory;
use Livewire\Component;
use Livewire\WithPagination;

class Paymenthistory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$totalCashIn,$totalCashOut,$daterange,$stdate,$eddate;
    public $account_id;

    public function deletedata($id){
       $paymenthistory= Paymentacchistory::find($id)->delete();
       $paymenthistory->delete();
       $this->render();

    }
    public function applyDate(){
        try {
           if ($this->daterange) {
               list($startDate, $endDate) = explode(' to ', $this->daterange);


              $this->stdate=$startDate;
              $this->eddate=$endDate;

           }
        } catch (\Throwable $th) {
           //throw $th;
        }

    }


    public function mount($account_id)
    {
        $this->account_id = $account_id;
    }
    public function render()
    {
        $paymenthistorydata=Paymentacchistory::where('account_id',$this->account_id);
        if ($this->search) {
            $paymenthistorydata->where(function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%');

            });
        }
        if ($this->stdate && $this->eddate) {
            $paymenthistorydata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        $this->totalCashIn = (clone $paymenthistorydata)->where('type', 'in')->sum('amount');
        $this->totalCashOut = (clone $paymenthistorydata)->where('type', 'out')->sum('amount');
        $paymenthistorydata=$paymenthistorydata->paginate(10);

        return view('livewire.admin.dashboard.dep.accounts.paymentaccount.accountbook.paymenthistory',compact('paymenthistorydata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
