<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Distribute\Orders\Payment\Modal;

use App\Models\Customerpayment;
use Livewire\Component;

class Paymentmodal extends Component
{

     public $openpaidmodal=false;
     public $payId,$order_no,$customer,$invoice_no,$type,$status,$total,$paid_amount,$to_be_paid,$cheque_number,$checkimg,$bank_name,$cheque_date,$created_at,$updated_at;
    protected $listeners = ['openpaymentmodal' => 'openModal'];

    public function openModal($id){
     $this->openpaidmodal=true;
     $customerPayment=Customerpayment::where('id',$id)->first();
     $this->payId=$customerPayment->received_id;

     $this->order_no=$customerPayment->order_no;
     $this->customer=$customerPayment->customerData->contact_person ?? 'Not Found';
     $this->invoice_no=$customerPayment->invoice_no;
     $this->type=$customerPayment->type;
     $this->status=$customerPayment->status;
     $this->total=$customerPayment->total;
     $this->paid_amount=$customerPayment->paid_amount;
     $this->to_be_paid=$customerPayment->to_be_paid;
     $this->cheque_number=$customerPayment->cheque_number;
     $this->checkimg=$customerPayment->cheque_image;
     $this->bank_name=$customerPayment->bank_name;
     $this->cheque_date=$customerPayment->cheque_date;
     $this->created_at=$customerPayment->created_at;
     $this->updated_at=$customerPayment->updated_at;
    }

    public function closeModal(){
         $this->openpaidmodal=false;
    }

    public function render()
    {
        return view('livewire.admin.dashboard.dep.sales.distribute.orders.payment.modal.paymentmodal');
    }
}
