<div class="main-panel ps ps--active-y p-2" id="main-panel">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h4 class="me-3">Purchase Orders</h4>
            <nav class="nav">
                <!-- Navigation elements here -->
            </nav>
        </div>
        <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
            <i class="bi bi-arrow-left-circle me-2"></i>Back
        </button>
        <livewire:admin.dashboard.notifylayout />
    </div>

    <!-- Activation Alert -->
    <div class="alert alert-danger" hidden>
        <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
    </div>

    <!-- Purchases Overview Section -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Purchases Overview</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard.dep.production.po.create.po') }}" wire:navigate
                            class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> New Purchase Order
                        </a>
                        <div class="btn-group">
                            <button class="btn btn-outline-primary" wire:click="allRecord">All</button>
                            <button class="btn btn-outline-primary" wire:click="draftRecord">Draft
                                ({{ $draftcount }})</button>
                            <button class="btn btn-outline-primary" wire:click="awaitingRecord">Awaiting Approval
                                ({{ $awaitingcount }})</button>
                            <button class="btn btn-outline-primary" wire:click="approvedRecord">Approved
                                ({{ $approvedcount }})</button>
                            <button class="btn btn-outline-primary" wire:click="billedRecord">Billed
                                ({{ $billedcount }})</button>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <input type="search" class="form-control form-control-sm" placeholder="Search records">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatable" class="table table-striped table-bordered dataTable dtr-inline"
                            cellspacing="0" width="100%" role="grid" aria-describedby="datatable_info"
                            style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable"
                                        rowspan="1" colspan="1" style="width: 330px;" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending">
                                        PO No</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                        colspan="1" style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">
                                        Supplier</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                        colspan="1" style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">
                                        Subtotal</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                        colspan="1" style="width: 330px;"
                                        aria-label="Position: activate to sort column ascending">
                                        Total</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                        colspan="1" style="width: 330px;"
                                        aria-label="Position: activate to sort column ascending">
                                        Due</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                        colspan="1" style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">
                                        Received Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                        colspan="1" style="width: 230px;"
                                        aria-label="Position: activate to sort column ascending">
                                        Received Mark By</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                        colspan="1" style="width: 330px;"
                                        aria-label="Age: activate to sort column ascending">Status</th>
                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                        aria-controls="datatable" rowspan="1" colspan="1" style="width: 430px;"
                                        aria-label="Actions: activate to sort column ascending">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>



                            </tfoot>

                            <tbody>
                                @if ($purchaseorder)
                                    @foreach ($purchaseorder as $porder)
                                        <tr>
                                            <td>{{ $porder->order_no }}</td>
                                            <td>{{ $porder->contact_person->contact_person }}</td>
                                            <td>LKR {{ number_format($porder->subtotal, 2, '.', ',') }}
                                            <td>LKR {{ number_format($porder->total, 2, '.', ',') }}
                                            </td>
                                            <td>LKR {{ number_format($porder->due_amount, 2, '.', ',') }}
                                            </td>
                                            <td>
                                                @if ($porder->received_date != null)
                                                    {{ \Carbon\Carbon::parse($porder->received_date)->format('Y M d h.i A') ?? 'Not Updated' }}
                                                @else
                                                    Not Updated
                                                @endif
                                            </td>
                                            <td>{{ $porder->checkReceived->name ?? 'Not Updated' }}</td>
                                            <td>
                                                @if ($porder->po_status == 'awaiting_approve')
                                                    <span class="badge badge-warning">Awaiting Approve</span>
                                                @elseif($porder->po_status == 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif ($porder->po_status == 'billed')
                                                    <span class="badge badge-success">Paid</span>
                                                @else
                                                    <span class="badge badge-danger">Draft</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-round btn-warning btn-icon btn-sm edit"
                                                wire:click="viewitems({{ $porder->id }})"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="View items" style="cursor: pointer;">
                                                <i class="fas fa-file-alt"></i>
                                                <!-- Change this to another icon if needed -->
                                            </a>
                                                @if ($porder->po_status == 'awaiting_approve')
                                                    <a class="btn btn-round btn-warning btn-icon btn-sm edit"
                                                        wire:click="setasdraft({{ $porder->id }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Set draft" style="cursor: pointer;">
                                                        <i class="fas fa-file-alt"></i>
                                                        <!-- Change this to another icon if needed -->
                                                    </a>
                                                    <a class="btn btn-round btn-dark btn-icon btn-sm edit"
                                                        wire:click="editrecord({{ $porder->id }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Edit" style="cursor: pointer;">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endif


                                                @if ($userAuth == $porder->attention && $porder->po_status != 'approved' && $porder->po_status != 'billed')
                                                    <a class="btn btn-round btn-success btn-icon btn-sm remove"
                                                        wire:click="activerecord({{ $porder->id }})"><i
                                                            class="fas fa-check"></i></a>
                                                @endif

                                                @if ($porder->received_status == null && $porder->po_status != 'awaiting_approve')
                                                    <a class="btn btn-round btn-success btn-icon btn-sm remove"
                                                        wire:click="markasreceived({{ $porder->id }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Mark as Received" style="cursor: pointer;"><i
                                                            class="fas fa-check"></i></a>

                                                         @if ($porder->due_amount >0)
                                                         <a class="btn btn-round btn-success btn-icon btn-sm remove"
                                                         wire:click="markasbilled({{ $porder->id }})"
                                                         data-bs-toggle="tooltip" data-bs-placement="top"
                                                         title="Mark as billed" style="cursor: pointer;">
                                                         <i class="fas fa-file-invoice"></i>
                                                         <!-- Change icon class if needed -->
                                                     </a>
                                                         @endif
                                                @endif

                                                @if ($porder->po_status == 'approved' && $porder->received_status != null)
                                                    <a class="btn btn-round btn-success btn-icon btn-sm remove"
                                                        wire:click="markasbilled({{ $porder->id }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Mark as billed" style="cursor: pointer;">
                                                        <i class="fas fa-file-invoice"></i>
                                                        <!-- Change icon class if needed -->
                                                    </a>

                                                        <a class="btn btn-round btn-warning btn-icon btn-sm edit"
                                                            wire:click="viewitems({{ $porder->id }})"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="View items" style="cursor: pointer;">
                                                            <i class="fas fa-file-alt"></i>
                                                            <!-- Change this to another icon if needed -->
                                                        </a>
                                                @endif

                                                @if ($porder->po_status == 'billed')
                                                <a class="btn btn-round btn-dark btn-icon btn-sm "
                                                 data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Generate Invoice" style="cursor: pointer;"
                                                wire:click="generateinvoice({{ $porder->id }})"><i class="fas fa-file-invoice"></i>
                                            </a>
                                                @endif

                                                @if (auth()->user()->role == 'Superadmin')
                                                    <a class="btn btn-round btn-info btn-icon btn-sm "
                                                        wire:click="viewpayments({{ $porder->id }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="View Payments" style="cursor: pointer;"><i
                                                            class="fas fa-file"></i></a>
                                                    <a href="#"
                                                        class="btn btn-round btn-danger btn-icon btn-sm remove"
                                                        wire:click="deletedata({{ $porder->id }})"><i
                                                            class="fas fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                            <ul class="pagination">
                                {{ $purchaseorder->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.dashboard.dep.production.po.modal.billedmodal />
    <livewire:admin.dashboard.dep.production.po.modal.editpurchasemodal />
    <livewire:admin.dashboard.dep.production.po.modal.viewfilemodal />
    <livewire:admin.dashboard.dep.production.po.modal.receivedmodal />
    <livewire:admin.dashboard.dep.production.po.modal.vieworderitemmodal/>
    <livewire:admin.dashboard.dep.production.po.modal.viewpaymentmodal/>


    <script>
        window.addEventListener('documentnotfound', function() {


            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Documents are not available!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('showGeneratingAlert', function () {
        Swal.fire({
            title: 'Generating Invoice...',
            text: 'Please wait while the invoice is being created.',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });
    window.addEventListener('hideGeneratingAlertDelayed', function () {
        console.log("Event received: hideGeneratingAlertDelayed"); // Debugging log
        setTimeout(function() {
            console.log("Executing Swal.close() after delay"); // Debugging log
            Swal.close(); // Close the alert after 5 seconds
        }, 4000);
    });



    </script>
</div>
