<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Do\Fund;

use App\Models\Dofundespenses;
use App\Models\Paymentaccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Dofund extends Component
{

     use WithPagination;

     public $allocatedAmount,$approvedAmount,$pendingApprove,$requestCountpending,$rejectedAmount,$rejectCountpending;
      protected $paginationTheme = 'bootstrap';
    public function showdoexpensesmodal(){
        $this->dispatch('showexpensesmodal');
    }

    public function acceptexpenses($id) {
    $expensesRecord = Dofundespenses::where('id', $id)->first();

    // First check if we can deduct the payment
    $paymentSuccess = $this->updatePayment($expensesRecord);

    // Only approve the expense if payment was successful
    if ($paymentSuccess) {
        $expensesRecord->approved = 1;
        $expensesRecord->save();
        $this->dispatch('expensesapproved');
        $this->dispatch('amountdeducted');
    }
    else{
         $this->dispatch('insufficientbalance');
    }
}

public function updatePayment($expensesRecord) {
    $paymentAccount = Paymentaccount::where('id', $expensesRecord->payment_account)->first();

    if ($paymentAccount->balance >= $expensesRecord->amount) {
        $paymentAccount->balance -= $expensesRecord->amount;
        $paymentAccount->save();

        return true; // Return success
    } else {

        return false; // Return failure
    }
}

    public function rejectexpenses($id){
        $expensesRecord=Dofundespenses::where('id',$id)->first();
        $expensesRecord->approved = 2;
        $expensesRecord->save();
        $this->dispatch('expensesrejected');
    }

    public function mount(){
      $this->allocatedAmount = Dofundespenses::whereMonth('created_at', Carbon::now()->month)
    ->whereYear('created_at', Carbon::now()->year)
    ->whereIn('approved', [1, 0])
    ->sum('amount');

    $this->approvedAmount= Dofundespenses::whereMonth('created_at', Carbon::now()->month)
    ->whereYear('created_at', Carbon::now()->year)
    ->where('approved', 1)
    ->sum('amount');

     $this->pendingApprove=Dofundespenses::whereMonth('created_at', Carbon::now()->month)
    ->where('approved', 0)
    ->sum('amount');

      $this->requestCountpending= Dofundespenses::whereDate('created_at', Carbon::today())
    ->where('approved', 0)
    ->count();

    $this->rejectedAmount = Dofundespenses::whereDate('created_at', Carbon::today())
    ->where('approved', 2)
    ->sum('amount');

    $this->rejectCountpending= Dofundespenses::whereDate('created_at', Carbon::today())
    ->where('approved', 2)
    ->count();
    }



    public function render()
    {
        $user=Auth::user();
        $doexpenses=Dofundespenses::whereNotNull('status')->paginate(1);
        return view('livewire.admin.dashboard.dep.accounts.do.fund.dofund',compact('doexpenses','user'))->layout('livewire.admin.dashboard.layout.master');
    }
}
