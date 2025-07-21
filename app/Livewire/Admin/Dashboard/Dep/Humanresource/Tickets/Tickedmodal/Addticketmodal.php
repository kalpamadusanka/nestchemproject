<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Tickets\Tickedmodal;

use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addticketmodal extends Component
{
    public $openticketmodal=false;
    public $systemusers,$categories;
    public $title,$evntcategory,$subject,$assignuser,$ticket_description,$priority,$status;

    protected $rules=[
        'title' => 'required',
        'evntcategory' => 'required',
        'subject' => 'required',
        'assignuser' => 'required',
        'ticket_description' => 'required',
        'priority' => 'required',
        'status' => 'required',
    ];
    protected $listeners = ['opentickedaddmodal' => 'openModal'];

    public function openModal(){
        $this->openticketmodal = true;
    }
    public function closeModal(){
        $this->openticketmodal = false;
    }

    public function mount(){
        $this->systemusers = User::where('id', '!=', auth()->id())->get();
        $this->categories=TicketCategory::all();


    }

    public function submit(){
        $currentuser=Auth::user();
        $this->validate();
        $ticket = new Ticket();
        $ticket->title = $this->title;
        $ticket->ticket_no=
        $ticket->t_category = $this->evntcategory;
        $ticket->subject = $this->subject;
        $ticket->assign_to = $this->assignuser;
        $ticket->description = $this->ticket_description;
        $ticket->priority = $this->priority;
        $ticket->t_status = $this->status;
        $ticket->added_by = $currentuser->id;
        $ticket->status = 1;
        $ticket->save();
        $this->closeModal();
        $this->dispatch('ticketadded');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.tickets.tickedmodal.addticketmodal');
    }
}
