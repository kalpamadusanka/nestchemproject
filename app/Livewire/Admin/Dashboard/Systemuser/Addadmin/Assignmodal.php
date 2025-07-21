<?php

namespace App\Livewire\Admin\Dashboard\Systemuser\Addadmin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Assignmodal extends Component
{
    public $roles = [];
    public $user_role = null;
    public $viewassignmodal = false;
    public $uid;

    protected $listeners = ['openAssignRoleModal' => 'openassignModal'];

    public function openassignModal($id)
    {
        $this->uid=$id;
        $user = User::find($id);
        $this->user_role = $user->role ?? null; // Assuming role is a single value, not an array
        $this->viewassignmodal = true;
    }

    public function closeModal()
    {
        $this->reset(['user_role', 'viewassignmodal']); // Reset only specific properties
    }

    public function submit()
    {
      $selecteduser=User::find($this->uid);
      $selecteduser->syncRoles($this->user_role);
      $selecteduser->role = $this->user_role;
      $selecteduser->save();
      $this->closeModal();

     $this->dispatch('refreshComponent');

    }

    public function render()
    {
        $this->roles = Role::where('name', '!=', 'Superadmin')->get();
        return view('livewire.admin.dashboard.systemuser.addadmin.assignmodal');
    }
}
