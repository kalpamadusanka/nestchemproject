<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Payment;

use App\Models\Customer;
use App\Models\Customerpayment;
use App\Models\Customerreceivepayment;
use App\Models\Salesorder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class Paymentdashboard extends Component
{
        use WithPagination;
           use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $orderId;


    public $totalAmount = 0;
    public $paymentType = 'credit';
    public $paymentAmount = 0;
    public $chequeNumber;
    public $bankName;
    public $chequeDate;
    public $chequeImage;
    public $showChequeFields = false;

    public $doNo,$customer;
    public $payments;
    public $pendingAmount;

    protected $rulesone = [
        'paymentAmount' => 'required|numeric|min:0',

    ];
      protected $rulestwo = [
        'paymentAmount' => 'required|numeric|min:0',

    ];
     protected $rulesthree = [
        'paymentAmount' => 'required|numeric|min:0',
        'chequeNumber' => 'required_if:paymentType,cheque',
        'bankName' => 'required_if:paymentType,cheque',
        'chequeDate' => 'required_if:paymentType,cheque',
        'chequeImage' => 'required_if:paymentType,cheque|image|max:2048',
    ];

    public function updatedPaymentType($value)
    {
        if ($value === 'credit') {
            $this->paymentAmount = 0;
            $this->showChequeFields = false;
        } elseif ($value === 'cheque') {
            $this->showChequeFields = true;
            $this->paymentAmount = $this->paymentAmount ?: '';
        } else {
            $this->showChequeFields = false;
            $this->paymentAmount = $this->paymentAmount ?: '';
        }
    }

    public function processPayment()
{
    // Validate based on payment type
    if ($this->paymentType === 'credit') {
    $this->validate($this->rulestwo);

    // Check if record already exists
    $existingPayment = Customerpayment::where('do_no', $this->doNo)
        ->where('order_no', $this->orderId)
        ->where('customer', $this->customer)
        ->first();



    if ($existingPayment && $existingPayment->to_be_paid == 0) {
        // Handle the error - maybe throw an exception or return with error message
session()->flash('errorsaved', 'A payment record with this DO number, order number, or customer already exists.!');
    }
     elseif($existingPayment && $existingPayment->to_be_paid > 0){
     $this->pendingAmount=$existingPayment->to_be_paid;
     $customerPayment = new Customerpayment();
    $customerPayment->do_no = $this->doNo;
    $customerPayment->order_no = $this->orderId;
    $customerPayment->invoice_no = 'INV-' . now()->format('YmdHis') . rand(100, 9999);
    $customerPayment->customer = $this->customer;
    $customerPayment->type = 'credit';
    $customerPayment->total = $this->totalAmount;
    $customerPayment->paid_amount = $this->paymentAmount ?? 0;
    $customerPayment->to_be_paid = $this->totalAmount;
    $customerPayment->status = 1;
     $receivedId = $this->store_received_payment($customerPayment->customer, $this->paymentAmount, $customerPayment->type,$customerPayment->invoice_no);
    $customerPayment->save();
     session()->flash('message', 'Payment processed successfully!');
      $this->loadPayments();
    }
    else{
$customerPayment = new Customerpayment();
    $customerPayment->do_no = $this->doNo;
    $customerPayment->order_no = $this->orderId;
     $customerPayment->invoice_no = 'INV-' . now()->format('YmdHis') . rand(100, 9999);
    $customerPayment->customer = $this->customer;
    $customerPayment->type = 'credit';
    $customerPayment->total = $this->totalAmount;
    $customerPayment->paid_amount = $this->paymentAmount ?? 0;
    $customerPayment->to_be_paid = $this->totalAmount;
    $customerPayment->status = 1;
     $receivedId = $this->store_received_payment($customerPayment->customer, $this->paymentAmount, $customerPayment->type,$customerPayment->invoice_no);
    $customerPayment->save();
     session()->flash('message', 'Payment processed successfully!');
      $this->loadPayments();
    }



} elseif ($this->paymentType === 'cash') {
    $this->validate($this->rulesone);

    // Check if record already exists
    $existingPayment = Customerpayment::where('do_no', $this->doNo)
        ->where('order_no', $this->orderId)
        ->where('customer', $this->customer)
        ->first();


     if ($existingPayment && $existingPayment->to_be_paid == 0) {
         session()->flash('errorsaved', 'A payment record with this DO number, order number, or customer already exists.!');

    }
     elseif($existingPayment && $existingPayment->to_be_paid > 0){
     $this->pendingAmount=$existingPayment->to_be_paid;
     $customerPayment = new Customerpayment();
    $customerPayment->do_no = $this->doNo;
    $customerPayment->order_no = $this->orderId;
     $customerPayment->invoice_no = 'INV-' . now()->format('YmdHis') . rand(100, 9999);
    $customerPayment->customer = $this->customer;
    $customerPayment->type = 'cash';
    $customerPayment->total = $this->totalAmount;
    $customerPayment->paid_amount = $this->paymentAmount ?? 0;
    $customerPayment->to_be_paid = $this->totalAmount - $this->paymentAmount;
    $customerPayment->status = 1;
    $receivedId = $this->store_received_payment($customerPayment->customer, $this->paymentAmount, $customerPayment->type,$customerPayment->invoice_no);
$customerPayment->received_id = $receivedId;
    $customerPayment->save();

     session()->flash('message', 'Payment processed successfully!');
      $this->loadPayments();
    }
    else{
 $customerPayment = new Customerpayment();
    $customerPayment->do_no = $this->doNo;
    $customerPayment->order_no = $this->orderId;
     $customerPayment->invoice_no = 'INV-' . now()->format('YmdHis') . rand(100, 9999);
    $customerPayment->customer = $this->customer;
    $customerPayment->type = 'cash';
    $customerPayment->total = $this->totalAmount;
    $customerPayment->paid_amount = $this->paymentAmount ?? 0;
    $customerPayment->to_be_paid = $this->totalAmount - $this->paymentAmount;
    $customerPayment->status = 1;
    $receivedId = $this->store_received_payment($customerPayment->customer, $this->paymentAmount, $customerPayment->type,$customerPayment->invoice_no);
$customerPayment->received_id = $receivedId;
    $customerPayment->save();

     session()->flash('message', 'Payment processed successfully!');
      $this->loadPayments();
    }



} elseif ($this->paymentType === 'cheque') {
    $this->validate($this->rulesthree);

    // Check if record already exists
    $existingPayment = Customerpayment::where('do_no', $this->doNo)
        ->where('order_no', $this->orderId)
        ->where('customer', $this->customer)
        ->first();

   if ($existingPayment && $existingPayment->to_be_paid == 0) {
        session()->flash('errorsaved', 'A payment record with this DO number, order number, or customer already exists.!');

    }
    elseif($existingPayment && $existingPayment->to_be_paid > 0){
     $this->pendingAmount=$existingPayment->to_be_paid;
     $customerPayment = new Customerpayment();
    $customerPayment->do_no = $this->doNo;
    $customerPayment->order_no = $this->orderId;
     $customerPayment->invoice_no = 'INV-' . now()->format('YmdHis') . rand(100, 9999);
    $customerPayment->customer = $this->customer;
    $customerPayment->type = 'cheque';
    $customerPayment->total = $this->totalAmount;
    $customerPayment->paid_amount = $this->paymentAmount ?? 0;
    $customerPayment->to_be_paid = $this->totalAmount - $this->paymentAmount;
     $customerPayment->cheque_date = $this->chequeDate;
$customerPayment->cheque_number = $this->chequeNumber;
$customerPayment->bank_name = $this->bankName;
    $customerPayment->status = 1;
    $receivedId = $this->store_received_payment($customerPayment->customer, $this->paymentAmount, $customerPayment->type,$customerPayment->invoice_no);
$customerPayment->received_id = $receivedId;
        $extension = $this->chequeImage->getClientOriginalExtension();
        $uniqueFilename = time() . '_' . uniqid() . '.' . $extension;
        $customerPayment->cheque_image = $uniqueFilename;
        $result=$customerPayment->save();
        if($result){
             $this->chequeImage->storeAs('cheque', $uniqueFilename, 'public');
        }


     session()->flash('message', 'Payment processed successfully!');
      $this->loadPayments();

    }
    else{
$customerPayment = new Customerpayment();
    $customerPayment->do_no = $this->doNo;
    $customerPayment->order_no = $this->orderId;
     $customerPayment->invoice_no = 'INV-' . now()->format('YmdHis') . rand(100, 9999);
    $customerPayment->customer = $this->customer;
    $customerPayment->type = 'cheque';
    $customerPayment->total = $this->totalAmount;
    $customerPayment->paid_amount = $this->paymentAmount ?? 0;
    $customerPayment->to_be_paid = $this->totalAmount - $this->paymentAmount;
     $customerPayment->cheque_date = $this->chequeDate;
$customerPayment->cheque_number = $this->chequeNumber;
$customerPayment->bank_name = $this->bankName;
$receivedId = $this->store_received_payment($customerPayment->customer, $this->paymentAmount, $customerPayment->type,$customerPayment->invoice_no);
$customerPayment->received_id = $receivedId;
    $customerPayment->status = 1;
        $extension = $this->chequeImage->getClientOriginalExtension();
        $uniqueFilename = time() . '_' . uniqid() . '.' . $extension;
        $customerPayment->cheque_image = $uniqueFilename;
        $result=$customerPayment->save();
        if($result){
             $this->chequeImage->storeAs('cheque', $uniqueFilename, 'public');
        }


     session()->flash('message', 'Payment processed successfully!');
      $this->loadPayments();

    }


$this->reset('paymentAmount', 'chequeDate','chequeNumber','bankName');


}

    // Show success message

}


    public function mount($saleorder){
       $saleRecord=Salesorder::where('id',$saleorder)->first();
       $this->orderId=$saleRecord->order_no;
       $this->doNo=$saleRecord->do_no;
       $this->totalAmount=$saleRecord->total;
       $this->customer=$saleRecord->customer;
         $this->loadPayments();
    }

  public function store_received_payment($customerId, $paymentAmount, $type,$invoiceNo) {
    try {
        $user = Auth::user();
        $receivedpayment = new Customerreceivepayment();
        $receivedpayment->customer = $customerId;
        $receivedpayment->invoice_no=$invoiceNo;
        $receivedpayment->amount = $paymentAmount;
        $receivedpayment->type = $type;
        $receivedpayment->added_by = $user->id;
        $receivedpayment->approved = 1;
        $receivedpayment->save();

        // Return the ID of the newly created record
        return $receivedpayment->id;

    } catch (\Throwable $th) {
        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
        ]);
        // You might want to return null or false here if the save fails
        return null;
    }
}

    public function loadPayments()
{
    $this->payments = Customerpayment::where('customer',  $this->customer)
                            ->where('order_no',$this->orderId)
                            ->orderBy('created_at', 'desc')
                            ->get();
              $existingPayment = Customerpayment::where('do_no', $this->doNo)
        ->where('order_no', $this->orderId)
        ->where('customer', $this->customer)
        ->first();


         if($existingPayment && $existingPayment->to_be_paid > 0){
     $this->pendingAmount=$existingPayment->total - $existingPayment->paid_amount ;
      $this->checkandUpdate($existingPayment);
    }
    elseif($existingPayment && $existingPayment->to_be_paid <= 0){

 $this->pendingAmount=0;
    }
    else{

        $this->pendingAmount=$this->totalAmount;
    }
}

public function checkandUpdate($existingPayment){

    $toBePaid=Customerpayment::where('order_no',$existingPayment->order_no)->sum('to_be_paid');
    $totalAmount=$existingPayment->total;
    $soData=Customerpayment::where('order_no',$existingPayment->order_no)->sum('paid_amount');
    $totalpaid=$soData;

    if($totalAmount <= $totalpaid){
      Customerpayment::where('order_no', $existingPayment->order_no)->update(['to_be_paid' => 0]);
        $this->pendingAmount=0;
        Salesorder::where('order_no',$existingPayment->order_no)->update(['due' => 0]);
    }
    else{

        $dueamount=$toBePaid;
        $newtobepaid=$totalAmount - $totalpaid;
        $this->pendingAmount=$newtobepaid;
         Salesorder::where('order_no',$existingPayment->order_no)->update(['due' => $newtobepaid]);

    }
}



public function editPayment($paymentId)
{
    // Logic to edit payment
    $payment = Customerpayment::find($paymentId);
    // Fill the form with payment details
    $this->paymentType = $payment->payment_type;
    $this->paymentAmount = $payment->amount;
    // ... other fields
}

public function confirmDelete($paymentId)
{
    // Show confirmation dialog before deleting
    $this->dispatchBrowserEvent('confirm-delete', ['paymentId' => $paymentId]);
}

public function deletePayment($paymentId)
{
    try {
        Customerpayment::find($paymentId)->delete();
        $this->loadPayments();
        session()->flash('message', 'Payment deleted successfully');
    } catch (\Exception $e) {
        session()->flash('errorsaved', 'Error deleting payment');
    }
}

public function viewPayment($paymentId){
        $this->dispatch('openpaymentmodal',$paymentId);
}

public function printInvoice($paymentId)
{
    // Logic to print invoice
    //return redirect()->route('invoice.print', $paymentId);
}
    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.payment.paymentdashboard')->layout('livewire.admin.dashboard.layout.master');
    }
}
