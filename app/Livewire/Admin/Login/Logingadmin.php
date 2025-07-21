<?php

namespace App\Livewire\Admin\Login;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logingadmin extends Component
{

    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Authentication was successful...
            $user = Auth::user();
            $user->last_login = now(); // Store current timestamp
            $user->save();
            session()->flash('message', 'Login successful!');
            return redirect()->route('admin.dashboard'); // redirect to a dashboard or home page
        } else {
            // Authentication failed...
            session()->flash('error', 'Invalid credentials.');
        }
    }
    public function render()
    {
        return view('livewire.admin.login.logingadmin')->layout('livewire.admin.login.layout.adminlayout');
    }
}
