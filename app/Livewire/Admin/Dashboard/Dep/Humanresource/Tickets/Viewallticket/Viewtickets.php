<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Tickets\Viewallticket;

use App\Models\Ticket;
use App\Models\TicketCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Viewtickets extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $categories,$priority,$status,$daterange;
    public $t_status,$ticket;

    public function changeStatus($ticketId)
    {
        $ticket = Ticket::find($ticketId);
        $ticket->t_status = $this->t_status;
        $ticket->save();
        $this->mount();
    }
    public function mount(){

        $this->categories = TicketCategory::withCount('tickets')->get();

    }
    public function applyDate(){
        $this->render();

    }
    public function render()
    {

        try {
            if ($this->daterange) {
                list($startDate, $endDate) = explode(' to ', $this->daterange);


                if($this->priority){
                    $alltickets=Ticket::whereBetween('updated_at', [$startDate, $endDate])->where('priority',$this->priority)->paginate(5);
                }
                elseif($this->status){
                    $alltickets=Ticket::whereBetween('updated_at', [$startDate, $endDate])->where('t_status',$this->status)->paginate(5);
                }
                else{
                    $alltickets = Ticket::where('status',1)->paginate(2);
                }
                $alltickets=Ticket::whereBetween('updated_at', [$startDate, $endDate])->paginate(5);
            }

              else{
                $alltickets = Ticket::where('status',1)->paginate(5);
              }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return view('livewire.admin.dashboard.dep.humanresource.tickets.viewallticket.viewtickets',compact('alltickets'))->layout('livewire.admin.dashboard.layout.master');
    }
}
