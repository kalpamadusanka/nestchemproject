<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Tickets;

use App\Models\Ticket;
use App\Models\TicketCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Alltickets extends Component
{

    public $alltickets,$categories,$priority,$status,$daterange,$newticket,$openedticket,$solvedticket,$pendingticket;
    public $t_status,$ticket;
    protected $listeners = ['ticketadded' => 'mount'];
    public function openticketModal(){
        $this->dispatch('opentickedaddmodal');
    }
    public function addticketCategory(){
        $this->dispatch('addticketcategory');
    }

    public function getCurrentuser(){
        $user=Auth::user();
        return $user;

    }
    public function Updatedpriority(){

      if($this->priority){
        $this->alltickets=Ticket::where('priority',$this->priority)->where('added_by',$this->getCurrentuser()->id)->get();
      }
      elseif($this->status){
        $this->alltickets=Ticket::where('t_status',$this->status)->where('priority',$this->priority)->where('added_by',$this->getCurrentuser()->id)->get();
      }
      else{
        $this->alltickets=Ticket::all();
      }

    }
    public function Updatedstatus(){

        if($this->priority){
            $this->alltickets=Ticket::where('t_status',$this->status)->where('priority',$this->priority)->where('added_by',$this->getCurrentuser()->id)->get();
        }
        elseif($this->status){
            $this->alltickets=Ticket::where('t_status',$this->status)->where('added_by',$this->getCurrentuser()->id)->get();
        }
        else{
            $this->alltickets=Ticket::all();
        }
    }
    public function applyDate(){
     try {
        if ($this->daterange) {
            list($startDate, $endDate) = explode(' to ', $this->daterange);


            if($this->priority){
                $this->alltickets=Ticket::whereBetween('created_at', [$startDate, $endDate])->where('priority',$this->priority)->where('added_by',$this->getCurrentuser()->id)->get();
            }
            elseif($this->status){
                $this->alltickets=Ticket::whereBetween('created_at', [$startDate, $endDate])->where('t_status',$this->status)->where('added_by',$this->getCurrentuser()->id)->get();
            }
            else{
                $this->alltickets=Ticket::whereBetween('created_at', [$startDate, $endDate])->where('added_by',$this->getCurrentuser()->id)->get();
            }

        }
     } catch (\Throwable $th) {
        //throw $th;
     }

    }

    public function changeStatus($ticketId)
    {
        $ticket = Ticket::find($ticketId);
        $ticket->t_status = $this->t_status;
        $ticket->save();
        $this->mount();
    }
    public function mount(){
        $this->alltickets = Ticket::where('added_by',$this->getCurrentuser()->id)->get();
        $this->categories = TicketCategory::withCount('tickets')->get();
        $this->newticket=  Ticket::whereDate('created_at', Carbon::today())->where('added_by',$this->getCurrentuser()->id)
        ->count();
        $this->openedticket=Ticket::where('t_status', 'inprogress')->where('added_by',$this->getCurrentuser()->id)->count();
        $this->solvedticket=Ticket::where('t_status', 'resolved')->where('added_by',$this->getCurrentuser()->id)->count();
        $this->pendingticket=Ticket::where('t_status', 'reopened')->where('added_by',$this->getCurrentuser()->id)->count();
    }
    public function render()
    {

        return view('livewire.admin.dashboard.dep.humanresource.tickets.alltickets')->layout('livewire.admin.dashboard.layout.master');
    }
}
