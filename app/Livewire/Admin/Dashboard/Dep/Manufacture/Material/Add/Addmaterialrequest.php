<?php

namespace App\Livewire\Admin\Dashboard\Dep\Manufacture\Material\Add;

use App\Models\Material;
use App\Models\Materialrequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Addmaterialrequest extends Component
{
    public $rows = [];
    public $suggestions = [];
    public function addRow()
    {
        $this->rows[] = [
            'item' => '',
            'description' => '',
            'quantity' => 0,
            'uom'=>'',
            'reqcode'=>'MAT-MR ' . rand(100000, 999999),

        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reindex the array
    }
    public function fetchSuggestions($index)
    {
        $query = $this->rows[$index]['item'] ?? '';

        if (strlen($query) > 1) {
            $this->suggestions[$index] = $this->getMatchingItems($query);
        } else {
            $this->suggestions[$index] = [];
        }
    }

    private function getMatchingItems($query)
    {
        return Material::where('name', 'like', "%$query%")
        ->orWhere('code', 'like', "%$query%")
        ->limit(5)
        ->pluck('code')
        ->toArray();

    }

    public function selectItem($index, $item)
    {
        $this->rows[$index]['item'] = $item;
        $this->suggestions[$index] = [];
    }

    public function submit(){

        $this->validate([
            'rows.*.item' => 'required',
            'rows.*.quantity' => 'required',
            'rows.*.uom' => 'required',
            'rows.*.reqcode' => 'required',
        ]);
      try {
        $user=Auth::user();
        foreach ($this->rows as $row) {
            Materialrequest::create([
                'material_id' => $row['item'],
                'description' => $row['description'],
                'quantity' => $row['quantity'],
                 'uom'=> $row['uom'],
                 'req_code'=> $row['reqcode'],
                 'req_status'=>'pending',
                'added_by'=>$user->id,
                'status'=>1,
            ]);
        }
        $this->dispatch('materialrequested');
      } catch (\Throwable $th) {
        DB::table('error_logs')->insert([
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
            'created_at' => now(),
       ]);
      }
      $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.manufacture.material.add.addmaterialrequest')->layout('livewire.admin.dashboard.layout.master');
    }
}
