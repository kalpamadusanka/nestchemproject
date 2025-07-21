<?php

namespace App\Livewire\Admin\Dashboard\Systemuser\Addadmin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Addadminmodal extends Component
{
    use WithFileUploads;
    public $viewsystemusermodal=false;

    public $avatar,$user_name,$user_email,$password,$location,$user_role;

    public $roles;

    protected $rules = [
        'user_name' => 'required',
        'user_email' => 'required|email',
        'password' => 'required|min:6',
        'location'=>'required',
    ];

    protected $listeners = ['openAdminModal' => 'openModal'];

    public function openModal(){
        $this->viewsystemusermodal=true;
    }

    public function closeModal(){
        $this->reset();
        $this->viewsystemusermodal=false;
    }

    public function submit(){
        $this->validate();
         if ($this->avatar) {
            $extension = $this->avatar->getClientOriginalExtension();
            $uniqueFilename = time() . '.' . $extension;
            $storedPath = $this->avatar->storeAs('avatars', $uniqueFilename, 'public');
            $user = new \App\Models\User();
            $user->name = $this->user_name;
            $user->email = $this->user_email;
            $user->password = bcrypt($this->password);
            $user->location = $this->location;
            $user->profile_img=$uniqueFilename;
            $user->role = $this->user_role;
            $user->status=1;
            $user->save();
            $user->assignRole($this->user_role);
            $this->dispatch('systemuseradded');
            $this->dispatch('refreshComponent');
            $this->reset();
            $this->closeModal();
         }

         $this->dispatch('systemusererror');

    }

    public function render()
    {
        $this->roles=Role::where('name', '!=', 'Superadmin')->get();
        return view('livewire.admin.dashboard.systemuser.addadmin.addadminmodal');
    }
}
