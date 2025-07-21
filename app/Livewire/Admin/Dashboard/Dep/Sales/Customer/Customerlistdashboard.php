<?php

namespace App\Livewire\Admin\Dashboard\Dep\Sales\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Customerlistdashboard extends Component
{

    use WithPagination;

    public $search,$stdate,$eddate,$daterange;
    protected $paginationTheme = 'bootstrap';
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

       public function editrecord($id){

        $this->dispatch('openadditionalmodal',$id);
       }
    public function render()
    {
        $customerdata=Customer::where('status',1);
        if ($this->stdate && $this->eddate ) {
            $customerdata->whereBetween('created_at', [$this->stdate, $this->eddate]);
        }
        if ($this->search) {
            $customerdata->where(function ($query) {
                $query->where('company_name', 'like', '%' . $this->search . '%');

            });
        }
        $customerdata=$customerdata->paginate(10);
        return view('livewire.admin.dashboard.dep.sales.customer.customerlistdashboard',compact('customerdata'))->layout('livewire.admin.dashboard.layout.master');
    }
}
