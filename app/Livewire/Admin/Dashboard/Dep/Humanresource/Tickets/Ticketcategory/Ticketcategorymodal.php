<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Tickets\Ticketcategory;

use App\Models\TicketCategory;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Livewire\Component;

class Ticketcategorymodal extends Component
{

    public $ticketcategory,$ticketcategorylist;
    public $openticketcategorymodal=false;
    protected $listeners = ['addticketcategory' => 'openModal'];

    protected $rules = [
        'ticketcategory' => 'required',

    ];

    public function openModal(){

        $this->openticketcategorymodal=true;
    }
    public function closeModal(){
        $this->openticketcategorymodal=false;
    }

    public function submit(){
    $currentuser=FacadesAuth::user();
    $this->validate();
    $ticketcategory=new TicketCategory();
    $ticketcategory->category_name=$this->ticketcategory;
    $ticketcategory->added_by=$currentuser->id;
    $ticketcategory->status=1;
    $ticketcategory->save();
     $this->mount();
     $this->reset('ticketcategory');

    }

    public function mount(){
        $this->ticketcategorylist=TicketCategory::all();
    }

    public function delete($id){
        $ticketcategory=TicketCategory::find($id);
        $ticketcategory->delete();
        $this->mount();
    }


    public function render()
    {

        return view('livewire.admin.dashboard.dep.humanresource.tickets.ticketcategory.ticketcategorymodal');
    }
}
