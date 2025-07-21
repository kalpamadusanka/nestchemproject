<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Do\Finalpayment;

use App\Models\Customerpayment;
use App\Models\Doexpenses;
use App\Models\Dofinalize;
use App\Models\Dofundespenses;
use App\Models\Saledispatch;
use App\Models\Salesorder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Finalizepayment extends Component
{
    public $totalRevenue = 0;
    public $creditSales = 0;
    public $expectedCash = 0;
    public $receivedCash = 0;
    public $receivedCheque = 0;
    public $cashBalance = 0;
    public $chequeBalance = 0;
    public $activities = [];
    public $doNo, $chequetotal,$exFinalization;
    public $cashSale, $expenses, $receivedBy, $expectedcheque,$totalfund;
        public $isFinalized = false;
    public $existingFinalization,$totalExpenses,$customerdue;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($dono)
    {
         $this->doNo = $dono;
        $this->loadData();

        // Check if payment is already finalized
        $this->existingFinalization = Dofinalize::where('do_no', $this->doNo)->first();
        $this->exFinalization=$this->existingFinalization->approved ?? 0;

        $this->isFinalized = !is_null($this->existingFinalization);

        if ($this->isFinalized) {
            $this->receivedCash = $this->existingFinalization->received_cash;
            $this->receivedCheque = $this->existingFinalization->received_cheque;
            $this->calculateBalances();
        }


    }

    public function approved($doNo){
        $dofinal=Dofinalize::where('do_no',$doNo)->first();
        $dofinal->approved = 1;
        $dofinal->save();
        $this->mount($doNo);
        $this->render();
        $this->isFinalized = true;
        $this->dispatch('dofinalizesuccess');
    }

    public function loadData()
    {
        $saledispatch = Saledispatch::where('do_no', $this->doNo)->first();
        $this->receivedBy = $saledispatch->sale_represntative;

        $totals = Customerpayment::where('do_no', $this->doNo)
            ->select('do_no', 'order_no')
            ->selectRaw('MAX(total) as total')
            ->groupBy('do_no', 'order_no')
            ->get();

        $this->totalRevenue = $totals->sum('total');

        $creditsales = Customerpayment::where('do_no', $this->doNo)
            ->where('type', 'credit')
            ->select('do_no', 'order_no')
            ->selectRaw('MAX(total) as total')
            ->groupBy('do_no', 'order_no')
            ->get();
        $this->creditSales = $creditsales->sum('total');

        $chequeTotal = Customerpayment::where('do_no', $this->doNo)
            ->where('type', 'cheque')
            ->get();
        $this->chequetotal = $chequeTotal->sum('paid_amount');

        $cashsale = Customerpayment::where('do_no', $this->doNo)
            ->where('type', 'cash')
            ->get();
        $this->cashSale = $cashsale->sum('paid_amount');
$this->totalExpenses=Doexpenses::where('do_no',$this->doNo)->sum('amount');
$this->totalfund=Dofundespenses::where('do_no',$this->doNo)->sum('amount');
 $this->customerdue=Salesorder::where('do_no',$this->doNo)->sum('due');
        $this->expectedCash = $this->cashSale + $this->totalfund - ($this->totalExpenses);

        $this->expectedcheque = $this->chequetotal;

        $this->calculateBalances();
        $this->expenses = Doexpenses::where('do_no', $this->doNo)->sum('amount');


    }

    public function updatedReceivedCash()
    {
        $this->calculateBalances();
    }

    public function updatedReceivedCheque()
    {
        $this->calculateBalances();
    }

    public function calculateBalances()
    {
        $this->cashBalance = $this->expectedCash - $this->receivedCash;

        $this->chequeBalance = $this->expectedcheque - $this->receivedCheque;
    }

    public function finalizePayments()
    {
        $this->validate([
            'receivedCash' => 'required|numeric|min:0',
            'receivedCheque' => 'required|numeric|min:0'
        ]);

        $user = Auth::user();

        $finalization = Dofinalize::updateOrCreate(
            ['do_no' => $this->doNo],
            [
                'total' => $this->totalRevenue,
                'credit' => $this->creditSales,
                'cash' => $this->cashSale,
                'cheque' => $this->chequetotal,
                'expenses' => $this->expenses,
                'expected_cash' => $this->expectedCash,
                'received_cash' => $this->receivedCash,
                'expected_cheque' => $this->expectedcheque,
                'received_cheque' => $this->receivedCheque,
                'cash_difference' => $this->cashBalance,
                'cheque_difference' => $this->chequeBalance,
                'approved' => 0,
                'received_by' => $this->receivedBy,
                'status' => 1,
                'taken_by' => $user->id,
            ]
        );

        $this->isFinalized = true;
        $this->existingFinalization = $finalization;

        session()->flash('message', 'Payments finalized successfully!');
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.do.finalpayment.finalizepayment', [
            'isFinalized' => $this->isFinalized,
            'existingFinalization' => $this->existingFinalization
        ]);
    }
}
