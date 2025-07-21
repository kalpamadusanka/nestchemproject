<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Datacollection\Modal;

use App\Models\Hrdatafiles;
use Livewire\Component;

class Docviewmodal extends Component
{
    public $selectedId,$documents;

    public $opendocviewmodal=false;
    protected $listeners = ['openviewDataModal' => 'openModal'];

    public function openModal($id){
        $this->opendocviewmodal=true;
     $this->selectedId=$id;

    }

    public function closeModal(){
        $this->opendocviewmodal=false;
    }
    public function download($documentId)
    {


        $document = Hrdatafiles::findOrFail($documentId);

        // Assuming your document is stored in 'documents' directory in storage
        $filePath = public_path('storage/hrfile/' . $document->doc);


        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        else{
            $this->dispatch('docfounderror');
        }

    }

    public function removedoc($docid){
        $documentexist = Hrdatafiles::findOrFail($docid);

        // Assuming your document is stored in 'documents' directory in storage
        $filePath = public_path('storage/hrfile/' . $documentexist->doc);


        if (file_exists($filePath)) {
            unlink($filePath);

            // Delete the record from the database
            $documentexist->delete();
        }
        else{
            $this->dispatch('docfounderror');
        }
    }
    public function render()
    {
        $this->documents=Hrdatafiles::where('hrdata_id',$this->selectedId)->get();
        return view('livewire.admin.dashboard.dep.humanresource.datacollection.modal.docviewmodal');
    }
}
