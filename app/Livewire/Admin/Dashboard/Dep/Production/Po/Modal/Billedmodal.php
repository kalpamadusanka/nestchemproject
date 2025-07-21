<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Po\Modal;

use App\Models\Material;
use App\Models\Paymentacchistory;
use App\Models\Paymentaccount;
use App\Models\Paymentmethods;
use App\Models\Poitems;
use App\Models\Popayment;
use App\Models\Purchaseorder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Billedmodal extends Component
{
    use WithFileUploads;
    public $selectedId;
    public $openbilledmodal = false;

    public $paymentmethod, $transactionno, $amountpurchase,$paymentacc,$amount,$dueAmount;

    protected $rules = [
        'paymentmethod' => 'required',
        'transactionno' => 'required',
    ];

    public $file;
    protected $listeners = ['openbilledmodal' => 'openModal'];

    public function openModal($id)
    {
        $this->selectedId = $id;
        $this->openbilledmodal = true;
        $purchaseOrder = Purchaseorder::find($id);
        $this->amountpurchase = $purchaseOrder->total;
        $this->dueAmount=$purchaseOrder->due_amount;
    }

    public function submit()
    {
        $this->validate();
        $user = Auth::user();


        try {
            $payment = new Popayment();
            $payment->purchase_order_id = $this->selectedId;
            $payment->payment_methodId = $this->paymentmethod;
            $payment->transactionId = $this->transactionno;
            $payment->amount = $this->amount;
            if ($this->file) {
                $extension = $this->file->getClientOriginalExtension();
                $uniqueFilename = time() . '.' . $extension;
                $storedPath = $this->file->storeAs('popaymentdoc', $uniqueFilename, 'public');
            }
            if($this->amount >= $this->amountpurchase){
              $payment->total_paid =1;
              $payment->due_amount=0;

            }
            else{
                $payment->total_paid =0;
                $payment->due_amount=$this->dueAmount - $this->amount;
            }
            $payment->file = $uniqueFilename ?? '';
            $payment->payment_account=$this->paymentacc;
            $payment->added_by = $user->id;
            $payment->status = 1;
            $result = $payment->save();



            $purchaseOrder = Purchaseorder::where('id', $this->selectedId)->first();
            $purchaseOrder->po_status = 'billed';
            $purchaseOrder->due_amount = $this->dueAmount - $this->amount;
            $purchaseOrder->update();

            if($result){
                $account = Paymentaccount::find($this->paymentacc);
                if ($account) {
                    // Deduct amount
                    $balanceBefore = $account->balance;
                    $account->balance -= $this->amount;
                    $account->save();
                }
                $accountbook = new Paymentacchistory();
                $accountbook->account_id = $account->id;
                $accountbook->transaction_id = $this->transactionno;
                $accountbook->payment_method = $this->paymentmethod;
                $accountbook->amount =$this->amount;
                $accountbook->balance_before = $balanceBefore;
                $accountbook->balance_after = $account->balance;
                $accountbook->transaction_type = 'debit';
                $accountbook->type = 'out';
                $accountbook->flow_type = 'purchase';
                $accountbook->description = 'Cash payment of ' . number_format($this->amount, 2) . ' by ' . $user->name;
                $accountbook->added_by = $user->id;
                $accountbook->status = 1;
                $accountbook->save();
            }

            $this->closeModal();
            $this->reset();
        } catch (\Throwable $th) {
            DB::table('error_logs')->insert([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                'created_at' => now(),
            ]);
        }

        $this->dispatch('billedsuccess');
    }

    public function closeModal()
    {
        $this->openbilledmodal = false;
    }

    public function render()
    {
        $paymentmthod = Paymentmethods::where('status', 1)->get();
        $paymentaccount=Paymentaccount::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.production.po.modal.billedmodal', compact('paymentmthod','paymentaccount'));
    }
}
