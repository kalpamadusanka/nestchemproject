<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewemployee;

use App\Models\Employeedoc;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Docmodal extends Component
{
    use WithFileUploads;
    public $viewdocmodal=false;
    public $userid;


    public $documents = [];

    protected $listeners = ['viewdragandropmodal' => 'openModal'];

    public function openModal($id){

        $this->userid=$id;
        $this->viewdocmodal=true;
    }

    public function submit()
    {

        $currentuser=Auth::user();
        foreach ($this->documents as $document) {
            $originalName = $document->getClientOriginalName(); // Get the original file name
            $documentPath = $document->storeAs('documents', $originalName, 'public');
            Employeedoc::create([
                'user_id'=>$this->userid,
                'doc' => $originalName, // The file name
                'added_by'=>$currentuser->id,
                'status'=>1

            ]);


        }

        // Clear the documents property after upload
        $this->documents = [];

        // Close the modal or show success message
        $this->dispatch('docsaved');
        $this->closeModal();
    }

    public function closeModal(){
        $this->viewdocmodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewemployee.docmodal');
    }
}
