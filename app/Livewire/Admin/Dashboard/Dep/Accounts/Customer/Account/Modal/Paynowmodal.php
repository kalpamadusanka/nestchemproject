<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Customer\Account\Modal;

use App\Models\Customer;
use App\Models\Customerreceivepayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Paynowmodal extends Component
{
    use WithFileUploads;
      public $openpaynowmodal=false;
      public $customerId,$amount,$payment_method;
       public $previewImage,$receipt;
      protected $rules=[
         'amount'=>'required',
         'payment_method'=>'required'
      ];
    protected $listeners = ['paynowmodal' => 'openModal'];
      public function openModal($id){
        $this->customerId=$id;
     $this->openpaynowmodal=true;
    }
    public function closeModal(){
        $this->openpaynowmodal=false;
    }

    public function submit(){

        $this->validate();
      try {
        $user=Auth::user();
        $receivedpayment=new Customerreceivepayment();
        $receivedpayment->customer=$this->customerId;
        $receivedpayment->invoice_no='INV-' . now()->format('YmdHis') . rand(1000, 9999);
        $receivedpayment->amount=$this->amount;
        $receivedpayment->type=$this->payment_method;

        if($this->receipt){
             $extension = $this->receipt->getClientOriginalExtension();
        $uniqueFilename = time() . '_' . uniqid() . '.' . $extension;
                    // Store the image in the public disk (storage/app/public/product)
        $path = $this->receipt->storeAs('customerschpaymentdoc', $uniqueFilename, 'public');
        $receivedpayment->doc=$uniqueFilename;
        }

        $receivedpayment->added_by=$user->id;
        $result=$receivedpayment->save();

        if($result){
  $this->dispatch('paymentrecordadd');
$this->closeModal();
        }
      } catch (\Throwable $th) {
            DB::table('error_logs')->insert([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                'created_at' => now(),
            ]);
      }
    }




// In your Livewire component class


public function previewFile()
{

    $this->validate([
        'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($this->receipt) {
        $extension = strtolower($this->receipt->getClientOriginalExtension());

        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $this->previewImage = $this->receipt->temporaryUrl();

        } else {
            // For PDF or other files
            $this->previewImage = 'pdf'; // Special identifier
        }
    }
}

public function removePreview()
{
    $this->reset('receipt', 'previewImage');
}
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.customer.account.modal.paynowmodal');
    }
}
