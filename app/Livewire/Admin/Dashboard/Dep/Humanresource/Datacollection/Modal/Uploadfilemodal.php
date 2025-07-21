<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Datacollection\Modal;

use App\Models\Hrdatafiles;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Uploadfilemodal extends Component
{
    use WithFileUploads;

    public $selectedId;
    public $files = [];
    public $viewaddfilemodal=false;

    protected $rules=[
        'files.*' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',

    ];
    protected $listeners = ['openuploadfileModal' => 'openModal'];

    public function openModal($id){
      $this->viewaddfilemodal=true;
      $this->selectedId=$id;
    }

    public function submit(){
     $this->validate();

        $user=Auth::user();
        if ($this->files) {
            foreach ($this->files as $file) {
                $extension = $file->getClientOriginalExtension();
                $uniqueFilename = time() . '.' . $extension;
                $storedPath = $file->storeAs('hrfile', $uniqueFilename, 'public');

                Hrdatafiles::create([
                    'hrdata_id' => $this->selectedId,
                    'doc' => $uniqueFilename,
                    'added_by' => $user->id,
                    'status' => 1,
                ]);
            }
        }

        $this->closeModal();
        $this->reset();
        $this->dispatch('hrdataadded');
    }

    public function closeModal(){
        $this->viewaddfilemodal=false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.datacollection.modal.uploadfilemodal');
    }
}
