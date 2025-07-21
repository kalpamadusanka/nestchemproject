<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account;

use App\Models\Customer;
use App\Models\Customerpayment;
use App\Models\Customerreceivepayment;
use App\Models\Salesorder;
use App\Models\Schedulepayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;

class Viewpaymentdashboard extends Component
{
     use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $totalSum,$paidAmount,$dueAmount,$cusID;
    public $amount,$date,$payment_method,$totalDue;

    protected $listeners = ['paymentschedule' => 'render','paymentrecordadd'=>'render','paymentrecordapproved'=>'render'];

    protected $rules=[
     'amount'=>'required',
     'date'=>'required',
     'payment_method'=>'required',
    ];
    public function mount($encryptedcusId)
    {
        $customerId = Crypt::decrypt($encryptedcusId);
        $this->cusID=$customerId;
     $this->totalSum = Salesorder::where('customer', $customerId)
             ->get()
             ->sum(function ($order) {
                //  return $order->total + abs($order->cantotal);
                  return $order->total;
             });
            $this->paidAmount=Customerreceivepayment::where('customer',$customerId)->sum('amount');
            $this->dueAmount=Salesorder::where('customer', $customerId)
             ->get()
             ->sum(function ($order) {
                //  return $order->total + abs($order->cantotal);
                  return $order->due;
             });
             $this->totalDue=Customer::where('id',$this->cusID)->first();
    }

    public function approvepayment($id){
        $payment=Customerreceivepayment::find($id);
        $payment->status = 1;
        $payment->approved=1;
        $result= $payment->save();
        if($result){
            $this->customerDueamountupdate($payment->customer,$payment->amount);
            $this->dispatch('paymentrecordapproved',$payment->id);
        }
        else{
            $this->dispatch('paymentrecordapprovederror');
        }
    }
      public function customerDueamountupdate($customerId,$amount){
        $customerData=Customer::find($customerId);
        $customerData->to_be_paid -= $amount;
        $result=$customerData->save();



    }

   public function submit(){
    $this->validate();

    $user = Auth::user();

    // Get sum of all existing scheduled payments for this customer
    $existingScheduledAmount = Schedulepayment::where('customer', $this->cusID)
        ->where('status', 1) // assuming 1 means active/pending
        ->sum('amount');

    // Calculate total after adding the new amount
    $totalAfterSchedule = $existingScheduledAmount + $this->amount;


    // Check if it exceeds the total due
    if ($this->amount > $this->totalDue->to_be_paid) {
         $this->dispatch('paymentScheduleError', message: 'Total scheduled payments cannot exceed the total due amount.');
        return;

    }
    if($this->totalDue->to_be_paid < $totalAfterSchedule){
     $this->dispatch('paymentScheduleError', message: 'Total scheduled payments cannot exceed the total due amount.');
        return;
    }
    else{
$schedule = new Schedulepayment();
    $schedule->customer = $this->cusID;
    $schedule->amount = $this->amount;
    $schedule->date = $this->date;
    $schedule->payment_method = $this->payment_method;
    $schedule->added_By = $user->id;
    $schedule->status = 1;

    $result = $schedule->save();

    if($result) {
        $this->dispatch('paymentschedule');
    } else {
        $this->dispatch('paymentscheduleerror');
    }
    }


}

public function openpaymodal(){
    $this->dispatch('paynowmodal',$this->cusID);
}

public function printreceipt($id){
      $this->dispatch('paymentrecordapproved',$id);
}
    public function render()
    {

         $paymentsdata=Customerreceivepayment::where('customer',$this->cusID);
        $paymentsdata=$paymentsdata->paginate(10);

        $schedulepaymentsdata=Schedulepayment::where('customer',$this->cusID);
        $schedulepaymentsdata=$schedulepaymentsdata->paginate(10);
        return view('livewire.admin.dashboard.dep.accounts.customer.account.viewpaymentdashboard',compact('paymentsdata','schedulepaymentsdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
