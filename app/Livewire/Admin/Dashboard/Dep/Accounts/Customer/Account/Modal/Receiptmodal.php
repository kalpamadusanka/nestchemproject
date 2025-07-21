<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account\Modal;

use App\Models\Customer;
use App\Models\Customerpayment;
use App\Models\Customerreceivepayment;
use Livewire\Component;

class Receiptmodal extends Component
{
    public $paymentreceiveId,$type,$paid_amount,$to_be_paid,$invoice_no,$payId,$customer;
    public $openreceiptmodal=false;
    protected $listeners = ['paymentrecordapproved' => 'openModal'];
      public function openModal($id){
        $this->paymentreceiveId=$id;
     $this->openreceiptmodal=true;
     $payment=Customerreceivepayment::where('id',$id)->first();
      $this->type=$payment->type;
      $this->paid_amount=$payment->amount;
      $customerData=Customer::find($payment->customer);
      $this->to_be_paid=$customerData->to_be_paid;
      $this->invoice_no =$payment->invoice_no;
      $this->payId=$id;
      $this->customer=$customerData->company_name;
    }
    private function generateInvoiceNumber() {
    // Get today's date in YYYYMMDD format
    $today = date('Ymd');

    // You might want to get the last invoice number from database
    // and increment the unique number. For this example, we'll use a simple approach

    // If you're storing invoices in a database, you would query:
    // SELECT MAX(invoice_no) FROM invoices WHERE invoice_no LIKE 'INV-{$today}%'
    // Then extract the last number and increment

    // For simplicity, we'll use a random number here
    $uniqueNumber = str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);

    // Or if you want sequential numbers per day, you might store a counter somewhere

    return 'INV-' . $today . '-' . $uniqueNumber;
}
    public function closeModal(){
        $this->openreceiptmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.customer.account.modal.receiptmodal');
    }
}
