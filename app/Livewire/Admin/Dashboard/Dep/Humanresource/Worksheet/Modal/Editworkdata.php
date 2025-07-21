<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Worksheet\Modal;

use App\Models\Worksheet;
use Livewire\Component;

class Editworkdata extends Component
{
    public $employee_name,$note,$selectedId;
    public $opeeditnworkmodal=false;
    protected $listeners = ['editworksheetdata' => 'openworksheetModal'];

    public function openworksheetModal($id){
        $this->selectedId=$id;
     $this->opeeditnworkmodal=true;
     $userworkData=Worksheet::find($id);
     $this->employee_name=$userworkData->employeeData->username;
     $this->note=$userworkData->note;


    }
    public function closeModal(){
        $this->opeeditnworkmodal=false;
    }
    public function submit(){
      $editworkData=Worksheet::find($this->selectedId);
      $editworkData->note=$this->note;
      $editworkData->save();
      $this->opeeditnworkmodal=false;
      $this->dispatch('worksheetdataadded');

    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.worksheet.modal.editworkdata');
    }
}
