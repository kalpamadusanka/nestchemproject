<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Modal;

use App\Models\Expenses;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Viewexpensesdetailsmodal extends Component
{

    use WithFileUploads;
    public $expensesfor,$transactionno,$expensecategory,$amount,$paymentmethod,$merchant,$note,$document,$selectedId;
    public $openexpensedetailsmodal=false;
    protected $listeners = ['openexpensedetailsModal' => 'openModal'];

    public function openModal($id){
      $this->selectedId=$id;
      $this->openexpensedetailsmodal=true;
      $expensesdetails=Expenses::find($id);
      $this->expensesfor=$expensesdetails->expense_for;
      $this->transactionno=$expensesdetails->transcation_no;
      $this->expensecategory=$expensesdetails->expenses_category;
      $this->amount=$expensesdetails->amount;
      $this->paymentmethod=$expensesdetails->payment_method;
      $this->merchant=$expensesdetails->merchant;
      $this->note=$expensesdetails->note;
    }

    public function closeModal(){
        $this->openexpensedetailsmodal=false;
    }

    public function submit(){
     $editexpenses=Expenses::find($this->selectedId);
     $editexpenses->note=$this->note;
     if($this->document){
        if ($editexpenses->doc) {
            $existingPath = "expensesdoc/{$editexpenses->doc}";
            if (Storage::disk('public')->exists($existingPath)) {
                Storage::disk('public')->delete($existingPath);
            }
        }

        // Save the new document
        $extension = $this->document->getClientOriginalExtension();
        $uniqueFilename = time() . '.' . $extension;
        $storedPath = $this->document->storeAs('expensesdoc', $uniqueFilename, 'public');

        $editexpenses->doc = $uniqueFilename;
     }
     $editexpenses->doc=$uniqueFilename;
     $editexpenses->update();
     $this->closeModal();


    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.expenses.modal.viewexpensesdetailsmodal');
    }
}
