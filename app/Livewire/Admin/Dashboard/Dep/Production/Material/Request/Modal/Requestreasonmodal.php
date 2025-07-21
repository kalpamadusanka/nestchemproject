<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Material\Request\Modal;

use App\Models\Materialrequest;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class Requestreasonmodal extends Component
{

    public $description,$selectedID;
    public $requestmodal=false;
    protected $listeners = ['declinedmodal' => 'openModal'];

    public function openModal($id){
    $this->requestmodal = true;
    $this->selectedID = $id;
    $reqData= Materialrequest::find($id);
    $this->description=$reqData->description;



    }

    public function submit(){
        $reqData= Materialrequest::find($this->selectedID);
        $reqData->description=$this->description;
        $reqData->req_status = 'declined';
        $reqData->update();
        $this->closeModal();
        $this->dispatch('requestupdated');

        $this->creatingnotification($reqData);
    }

    public function creatingnotification($req){
        DB::table('notifications')->insert([
            'id' => Str::uuid(),
            'type' => 'Requested material',
            'notifiable_id' => $req->id,
            'notifiable_type' => 'App\Models\Material',
            'data' => json_encode(['message' => 'Material requesting rejected', 'id' => $req->req_code]),
            'read_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    public function closeModal(){
        $this->requestmodal = false;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.production.material.request.modal.requestreasonmodal');
    }
}
