<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Do\Modal;

use App\Models\Companyassets;
use App\Models\Loadingactivity;
use App\Models\Saledispatch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Adddomodal extends Component
{
    public $openadddomodal=false;

    public $area,$do_no,$sale_represntative,$vehicle,$driver,$date,$note;

    public $salesrepresentatives,$vehicles,$drivers;
    protected $listeners = ['opendomodal' => 'openModal'];

    protected $rules=[
      'do_no' => 'required|unique:sale_dispatch,do_no',
      'area'=>'required',
      'sale_represntative'=>'required',
      'vehicle'=>'required',
      'driver'=>'required',
      'date'=>'required',

    ];

    public function openModal(){
     $this->openadddomodal=true;
    }
    public function closeModal(){
        $this->openadddomodal=false;
    }

    public function submit(){
    try {
        $this->validate();
    $user=Auth::user();
     $saledispatch=new Saledispatch();
     $saledispatch->do_no=$this->do_no;
     $saledispatch->area=$this->area;
     $saledispatch->date=$this->date;
     $saledispatch->sale_represntative=$this->sale_represntative;
     $saledispatch->vehicle=$this->vehicle;
     $saledispatch->driver=$this->driver;
     $saledispatch->note=$this->note;
     $saledispatch->added_by=$user->id;
     $saledispatch->load_status=0;
     $saledispatch->unload_status=0;
     $saledispatch->status=1;
     $saledispatch->save();
     $this->dispatch('docreated');
     $this->reset();
     $this->closeModal();
     $this->dispatch('doAdded');
     $this->notifyloaded($saledispatch->do_no);
    } catch (\Throwable $th) {
        $this->dispatch('errordoAdded', message: $th->getMessage());

        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
        ]);
    }

    }

    public function notifyloaded($doNo){
        $loadactivity=new Loadingactivity();
        $loadactivity->do_no=$doNo;
        $loadactivity->type='loading';
        $loadactivity->activity='New load request received';
        $loadactivity->save();
    }

    public function mount(){
        $this->salesrepresentatives=User::where('role','Sales Officer')->get();
        $this->vehicles=Companyassets::whereHas('assettype', function ($query) {
            $query->where('assets_type', 'Vehicle');
        })->get();
        $this->drivers=User::where('role','driver')->get();

    }
    public function render()
    {
        $this->mount();
        return view('livewire.admin.dashboard.dep.sales.do.modal.adddomodal');
    }
}
