<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Do;

use App\Models\Customerpayment;
use App\Models\Doexpenses;
use App\Models\Saledispatch;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Fulldoview extends Component
{
    public $dono,$dispatch_date,$sales_rep,$total_revenue,$total_expenses,$total_credit,$total_receiving,$net_profit,$customerPayments,$expenses;
    public function mount($encryptedDoNo)
{
    try {
        $doNo = Crypt::decrypt($encryptedDoNo);
        $this->dono=$doNo;
        $doData=Saledispatch::where('do_no',$doNo)->first();
        $this->dispatch_date=$doData->date;
        $this->sales_rep=$doData->salePerson->name;
      $totals = Customerpayment::where('do_no', $doNo)
    ->select('do_no', 'order_no')
    ->selectRaw('MAX(total) as total') // assuming one total per do_no+order_no pair
    ->groupBy('do_no', 'order_no')
    ->get();

// Sum the total of each unique (do_no, order_no) pair
$this->total_revenue = $totals->sum('total');

        $this->total_expenses=Doexpenses::where('do_no',$doNo)->sum('amount');
        $this->total_credit=Customerpayment::where('do_no',$doNo)->where('type','credit')->sum('to_be_paid');

        $totalcash=Customerpayment::where('do_no',$doNo)->where('type','cash')->sum('paid_amount');
        $totalcheque=Customerpayment::where('do_no',$doNo)->where('type','cheque')->sum('paid_amount');

$this->total_receiving =$totalcash + $totalcheque;


    $this->net_profit=$this->total_revenue - $this->total_expenses;

    $this->customerPayments=Customerpayment::where('do_no',$doNo)->get();
    $this->expenses=Doexpenses::where('do_no',$this->dono)->get();

        // Use $doNo as needed
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        abort(404); // or handle error
    }
}

    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.do.fulldoview')->layout('livewire.admin.dashboard.layout.master');
    }
}
