<?php

namespace App\Livewire\Admin\Dashboard\Systemuser;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Adminmanagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshComponent' => 'refresh'];

   public $search;
    public function addAdmin(): void{
     $this->dispatch('openAdminModal');
    }
    public function assignRole($id){

        $this->dispatch('openAssignRoleModal', $id);
    }

    public function refresh(){
        $this->render();
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        $this->deleteEmpdata($id);
        $this->dispatch('refreshComponent');
    }
    public function deleteEmpdata($id){
        $emp=Employee::where('user_id', $id)->first();
        $emp->delete();
    }
    public function render()
    {
        $systemusers =User::where('role', '!=', 'Superadmin')
        ->where(function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%') // Search by name
                  ->orWhere('email', 'LIKE', '%' . $this->search . '%'); // Or search by email
        })
        ->paginate(10);
        return view('livewire.admin.dashboard.systemuser.adminmanagement',compact('systemusers'))->layout('livewire.admin.dashboard.layout.master');
    }
}
