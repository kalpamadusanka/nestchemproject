<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewemployee\Empdoc;

use App\Models\Employee;
use App\Models\Employeedoc;
use App\Models\User;
use Livewire\Component;

class Documentview extends Component
{
    public $userName,$userid,$user,$documents;

    public function mount()
    {
        $this->userid = request()->query('userid');

        $this->user = Employee::where('user_id',$this->userid)->first();
        $this->userName = $this->user->username;

    }
    public function download($documentId)
    {

        $document = Employeedoc::findOrFail($documentId);

        // Assuming your document is stored in 'documents' directory in storage
        $filePath = public_path('documents/' . $document->doc);


        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        else{
            $this->dispatch('docfounderror');
        }

    }


    public function render()
    {
        $this->documents=Employeedoc::where('user_id',$this->userid)->get();
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewemployee.empdoc.documentview')->layout('livewire.admin.dashboard.layout.master');
    }
}
