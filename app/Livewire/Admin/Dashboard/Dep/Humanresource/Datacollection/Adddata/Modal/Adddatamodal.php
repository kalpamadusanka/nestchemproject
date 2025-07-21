<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Datacollection\Adddata\Modal;

use App\Models\Datacollection;
use App\Models\Hrdata;
use App\Models\Hrdatafiles;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Adddatamodal extends Component
{

    public $viewadddatamodal=false;
    use WithFileUploads;

    public $files = [];
    public $dataname,$collection;
    protected $listeners = ['openaddDataModal' => 'openModal'];

    protected $rules=[
        'files.*' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        'dataname'=>'required',
        'collection'=>'required',
    ];

    public function openModal(){
       $this->viewadddatamodal=true;
    }

    public function closeModal(){
        $this->viewadddatamodal=false;
    }

    public function submit(){
        // dd($this->files);
        $this->validate();
        $user=Auth::user();
        $data = new Hrdata();
        $data->name = $this->dataname;
        $data->collection_id = $this->collection;
        $data->status=1;
        $data->added_by=$user->id;

        if ($data->save()) {
            foreach ($this->files as $file) {
                $extension = $file->getClientOriginalExtension();
                $uniqueFilename = time() . '.' . $extension;
                $storedPath = $file->storeAs('hrfile', $uniqueFilename, 'public');

                Hrdatafiles::create([
                    'hrdata_id' => $data->id,
                    'doc' => $uniqueFilename,
                    'added_by' => $user->id,
                    'status' => 1,
                ]);
            }
        }

        $this->closeModal();
        $this->dispatch('hrdataadded');
    }
    public function render()
    {
        $datacollection=Datacollection::where('status',1)->get();
        return view('livewire.admin.dashboard.dep.humanresource.datacollection.adddata.modal.adddatamodal',compact('datacollection'));
    }
}
