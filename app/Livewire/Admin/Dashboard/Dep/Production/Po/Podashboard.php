<?php

namespace App\Livewire\Admin\Dashboard\Dep\Production\Po;

use App\Models\Paymentacchistory;
use App\Models\Paymentaccount;
use App\Models\Poitems;
use App\Models\Purchaseorder;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Podashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$userAuth;
    public $draftcount,$awaitingcount,$approvedcount,$billedcount,$draftfilter,$awaitingfilter,$approvedfilter,$billedfilter,$allfilter;

    protected $listeners = ['dataupdated' => 'render','receivedsuccess'=>'render','billedsuccess'=>'render'];

    public function activerecord($id){
     $purchaseOrder=Purchaseorder::find($id);
     $purchaseOrder->po_status='approved';
     $purchaseOrder->update();
     $this->render();
    }

    public function mount(){
        $this->draftcount=Purchaseorder::where('po_status','draft')->count();
        $this->awaitingcount=Purchaseorder::where('po_status','awaiting_approve')->count();
        $this->approvedcount=Purchaseorder::where('po_status','approved')->count();
        $this->billedcount=Purchaseorder::where('po_status','billed')->count();
    }

    public function setasdraft($id){
        $purchaseOrder=Purchaseorder::find($id);
        $purchaseOrder->po_status='draft';
        $purchaseOrder->update();
        $this->render();
    }

    public function markasbilled($id){
        $this->dispatch('openbilledmodal',$id);

    }

    public function deletedata($id){
        $purchaseOrder=Purchaseorder::find($id);
        $purchaseOrder->delete();
        $this->render();
    }
    public function editrecord($id){
        $this->dispatch('editpurchaseorder',$id);
    }
    public function viewpayments($id){
        $this->dispatch('viewpaymentsmodal',$id);
    }

    public function markasreceived($id){
        $this->dispatch('viewreceivedmodal',$id);
    }

    public function draftRecord() {
        $this->resetFilters(); // Reset all filters before applying a new one
        $this->draftfilter = 'draft';
    }

    public function awaitingRecord() {
        $this->resetFilters(); // Reset all filters before applying a new one
        $this->awaitingfilter = 'awaiting_approve';
    }

    public function approvedRecord() {
        $this->resetFilters(); // Reset all filters before applying a new one
        $this->approvedfilter = 'approved';
    }

    public function billedRecord() {
        $this->resetFilters(); // Reset all filters before applying a new one
        $this->billedfilter = 'billed';
    }

    public function allRecord() {
        $this->resetFilters(); // Reset all filters before applying a new one
        $this->allfilter = 'all';
    }

    public function resetFilters() {
        $this->draftfilter = null;
        $this->awaitingfilter = null;
        $this->approvedfilter = null;
        $this->billedfilter = null;
        $this->allfilter = null;
    }

    public function viewitems($id){
        $this->dispatch('viewporderitemmodal',$id);
    }

    public function generateinvoice($id){
        $this->dispatch('showGeneratingAlert');

        $order = Purchaseorder::where('id',$id)->first();

        if (!$order) {
            $this->dispatch('documentnotfound');
            return;
        }

        // Get the order items
        $orderItems = Poitems::where('purchase_order_id',$id)->get();
        // Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('livewire.admin.dashboard.dep.production.po.invoice.poinvoice', compact('order','orderItems'));

        $this->dispatch('hideGeneratingAlertDelayed');
        return response()->stream(function () use ($pdf) {
            echo $pdf->output();
        }, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Invoice' . date('Y-m-d') . '.pdf"',
        ]);


    }

    public function partialPayment($id){
        $this->dispatch('openpaymentmodal',$id);
    }

    public function render() {
        $purchaseorder = Purchaseorder::whereNotNull('status');

        if ($this->search) {
            $purchaseorder->where(function ($query) {
                $query->where('order_no', 'like', '%' . $this->search . '%');
            });
        }

        // Apply status filters based on the selected filter
        if ($this->draftfilter) {
            $purchaseorder->where('po_status', 'draft');
        }

        if ($this->awaitingfilter) {
            $purchaseorder->where('po_status', 'awaiting_approve');
        }

        if ($this->approvedfilter) {
            $purchaseorder->where('po_status', 'approved');
        }

        if ($this->billedfilter) {
            $purchaseorder->where('po_status', 'billed');
        }

        if ($this->allfilter) {
            // If "All" is selected, ensure all records are shown
            $purchaseorder->whereNotNull('po_status');
        }

        // Paginate results
        $purchaseorder = $purchaseorder->paginate(10);

        $user = Auth::user();
        $this->userAuth = $user->id;

        return view('livewire.admin.dashboard.dep.production.po.podashboard', compact('purchaseorder'))
            ->layout('livewire.admin.dashboard.layout.master');
    }

}
