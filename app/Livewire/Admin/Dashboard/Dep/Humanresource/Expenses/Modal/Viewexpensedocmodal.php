<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Expenses\Modal;

use App\Models\Expenses;
use Livewire\Component;

class Viewexpensedocmodal extends Component
{

    public $viewexpensedoc=false;
    public $document;
public $documentPreviewUrl;
    protected $listeners = ['openexpensedocModal' => 'openModal'];

    public function openModal($id){
        $this->viewexpensedoc=true;
        $documentPath = Expenses::findOrFail($id)->doc; // Adjust model and column names
        $this->documentPreviewUrl = $documentPath ? asset("storage/expensesdoc/{$documentPath}") : null;
        $this->viewexpensedoc = true;
    }

    public function closeModal(){
        $this->viewexpensedoc=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.expenses.modal.viewexpensedocmodal');
    }
}
