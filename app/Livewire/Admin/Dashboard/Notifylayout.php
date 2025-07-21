<?php

namespace App\Livewire\Admin\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Notifylayout extends Component
{

    public $load;
    public $storage;
    public $working;
    protected $listeners = ['refresh' => 'getSystemInfo'];

    public function mount()
    {
        $this->getSystemInfo();
    }


public function hydrate()
{
    $this->getSystemInfo();
}

    public function getSystemInfo()
    {
        // Get system load (Linux/Unix systems)
          if (function_exists('sys_getloadavg')) {
        $load = sys_getloadavg();
        $this->load = $load[0]; // 1-minute average
    }
    // Alternative method for systems where sys_getloadavg is disabled
    elseif (function_exists('shell_exec')) {
        $load = shell_exec('cat /proc/loadavg | awk \'{print $1}\'');
        $this->load = trim($load) ?: 'N/A';
    }
    else {
        $this->load = 'N/A';
    }

        // Get storage usage
        $total = disk_total_space('/');
        $free = disk_free_space('/');
        $used = $total - $free;
        $this->storage = round(($used / $total) * 100);

        // Get number of processes (Linux/Unix)
        if (function_exists('shell_exec')) {
            $processes = shell_exec('ps aux | wc -l');
            $this->working = (int)trim($processes) - 1; // Subtract the header line
        } else {
            $this->working = 'N/A';
        }
    }
    public function render()
    {
        $notifications= DB::table('notifications')
        ->orderBy('created_at', 'desc') // Change 'created_at' to your relevant column
        ->get();

        $notificationcount=$notifications->count();
        return view('livewire.admin.dashboard.notifylayout',compact('notificationcount','notifications'));
    }
}
