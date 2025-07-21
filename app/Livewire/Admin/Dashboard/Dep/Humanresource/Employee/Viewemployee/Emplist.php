<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewemployee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Emplist extends Component
{
    use WithPagination;

    public $totalemp,$active,$inactive,$newjoiner;
    public $search;
    protected $paginationTheme = 'bootstrap';

    public function draganddrop($id){
        $this->dispatch('viewdragandropmodal',$id);
    }
    public function editempData($id){
        $this->dispatch('editemployeemodal',$id);
    }

    public function deleteUser($id){
       $user=Employee::find($id);
       $user->status=0;
       $user->save();
       $this->render();
    }
    public function mount()
    {
        $this->totalemp=Employee::count();
        $this->active=Employee::where('status', 1)->count();
        $this->inactive=Employee::where('status', 0)->count();
        $this->newjoiner=Employee::where('status', 1)->whereDate('created_at', today())->count();
    }
    public function render()
    {
        $systemusers =Employee::where('status', 1)
        ->where(function ($query) {
            $query->where('username', 'LIKE', '%' . $this->search . '%') // Search by name
                  ->orWhere('email', 'LIKE', '%' . $this->search . '%'); // Or search by email
        })
        ->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewemployee.emplist',compact('systemusers'))->layout('livewire.admin.dashboard.layout.master');
    }
}
