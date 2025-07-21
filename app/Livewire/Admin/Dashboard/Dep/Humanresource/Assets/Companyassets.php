<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Assets;

use App\Models\Companyassets as ModelsCompanyassets;
use Livewire\Component;
use Livewire\WithPagination;

class Companyassets extends Component
{
    use WithPagination;
    public $search,$stdate,$eddate,$daterange;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['comapnyassetsadded' => 'render'];
    public function openassetsmodal(){
        $this->dispatch('openassetsmodal');
    }
    public function applyDate(){
        try {
           if ($this->daterange) {
               list($startDate, $endDate) = explode(' to ', $this->daterange);


              $this->stdate=$startDate;
              $this->eddate=$endDate;

           }
        } catch (\Throwable $th) {
           //throw $th;
        }

    }

       public function activeassetrecord($id){
        $companyassets = ModelsCompanyassets::find($id);
        $companyassets->status = 1;
        $companyassets->update();
        $this->dispatch('comapnyassetsadded');
       }

       public function deactiveassetrecord($id){
        $companyassets = ModelsCompanyassets::find($id);
        $companyassets->status = 0;
        $companyassets->update();
        $this->dispatch('comapnyassetsadded');
       }

       public function deleteassetdata($id){
        $companyassets = ModelsCompanyassets::find($id);
        $companyassets->delete();
        $this->dispatch('comapnyassetsadded');
       }

       public function viewassetdetails($id){
        $this->dispatch('viewassetdetailsmodal', $id);
       }
    public function render()
    {

        $companyassets = ModelsCompanyassets::whereNotNull('status');
        if ($this->search) {
            $companyassets->where(function ($query) {
                $query->where('item', 'like', '%' . $this->search . '%')
                      ->orWhere('code', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->stdate && $this->eddate) {
            $companyassets->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }

        $companyassets = $companyassets->paginate(10);
        return view('livewire.admin.dashboard.dep.humanresource.assets.companyassets',compact('companyassets'))->layout('livewire.admin.dashboard.layout.master');
    }
}
