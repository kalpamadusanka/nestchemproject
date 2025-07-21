<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Inventory Adjustment</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>
        <!-- Activation alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>



        <!-- Grid of Cards -->
        <div class="container">
            <div class="d-flex justify-content-between align-items-center ">
                <div>
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Adjustment </h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Material</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Item Code - {{ $itemCode }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="action-buttons">

                    <a wire:click="addadjustmentmodal" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Adjustment
                    </a>
                    <a href="{{ route('admin.dashboard.material.adjustment.type') }}" wire:navigate
                        class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>Add Adjustment Type
                    </a>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h4 class="card-title mb-0">Adjustment List</h4>

                        </div>

                        <div class="card-body">

                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="datatable_length"><label>Show <select
                                                    name="datatable_length" aria-controls="datatable"
                                                    class="custom-select custom-select-sm form-control form-control-sm"
                                                    fdprocessedid="95g48">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="-1">All</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-12">
                                                <!-- Search input aligned to the right -->
                                                <div id="datatable_filter"
                                                    class="dataTables_filter d-flex gap-2 justify-content-end align-items-center">
                                                    <label>
                                                        <input type="search" class="form-control form-control-sm"
                                                            placeholder="Search records" wire:model.live="search"
                                                            aria-controls="datatable">
                                                    </label>
                                                    <div class="d-flex gap-2">
                                                        <div class="form-group">

                                                            <input type="text" id="date-range" class="form-control form-control-sm" wire:model="daterange"
                                                                placeholder="Select date range">
                                                        </div>
                                                        <script>
                                                            document.addEventListener('livewire:navigated', () => {
                                                                flatpickr("#date-range", {
                                                                    mode: "range",
                                                                    dateFormat: "Y-m-d", // Customize as needed
                                                                    wrap: false, // Set to false if you are not using a wrapper element
                                                                    onReady: function(selectedDates, dateStr, instance) {
                                                                        // Create and append the "Apply" button
                                                                        const applyButton = document.createElement("button");
                                                                        applyButton.type = "button";
                                                                        applyButton.innerText = "Apply";
                                                                        applyButton.className =
                                                                            "flatpickr-apply-btn btn btn-primary mt-2"; // Add custom styles if needed

                                                                        // Append the button below the calendar
                                                                        instance.calendarContainer.appendChild(applyButton);

                                                                        // Handle "Apply" button click
                                                                        applyButton.addEventListener("click", () => {
                                                                            // Trigger Livewire model update with selected date range
                                                                            const dateRange = instance.input.value;
                                                                            @this.set('daterange', dateRange);
                                                                            @this.call('applyDate');
                                                                            // Close the Flatpickr calendar
                                                                            instance.close();
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable"
                                            class="table table-striped table-bordered dataTable dtr-inline"
                                            cellspacing="0" width="100%" role="grid"
                                            aria-describedby="datatable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 330px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">
                                                        Material Code</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 230px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Adjustment Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 230px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Qty</th>

                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Previous Stock</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        New Stock</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Reason</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Reference No</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Adjustment Date</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Adjusted By</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">Status</th>
                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 430px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>

                                                @if ($adjustmentdata)
                                                @foreach ($adjustmentdata as $adjust)
                                                    <tr>
                                                        <td>{{ $adjust->material->code ?? 'Not Updated' }}</td>
                                                        <td>{{ $adjust->adjustmentType->adjustment_type ?? 'Not Updated' }}</td>
                                                        <td>{{ $adjust->quantity ?? '0' }}</td>
                                                        <td>{{ $adjust->previous_stock ?? '0' }}</td>
                                                        <td>{{ $adjust->new_stock ?? '0' }}</td>
                                                        <td>{{ $adjust->reason ?? 'Not Updated' }}</td>
                                                        <td>{{ $adjust->reference_number ?? 'Not Updated' }}</td>
                                                        <td>{{ $adjust->adjustment_date ?? 'Not Updated' }}</td>
                                                        <td>{{ $adjust->addedUser->name ?? 'Not Updated' }}</td>
                                                        <td>
                                                            @if ($adjust->approved == 1)
                                                                <span class="badge badge-success">Approved By <br>{{ $adjust->approvedBy->name ?? 'Not Updated' }}</span>
                                                            @else
                                                                <span class="badge badge-warning">Pending<br> Approvel</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                             @if ($adjust->approved ==0)
                                                             <a class="btn btn-round btn-success btn-icon btn-sm remove"
                                                             wire:click="approveadjustment({{ $adjust->id }})"
                                                             data-bs-toggle="tooltip" data-bs-placement="top"
                                                             title="Approve Adjustment" style="cursor: pointer;"><i
                                                                 class="fas fa-check"></i></a>
                                                             @endif
                                                            @if (auth()->user()->role == 'Superadmin')
                                                                <a href="#"
                                                                    class="btn btn-round btn-danger btn-icon btn-sm remove"
                                                                    wire:click="deletedata({{ $adjust->id }})"><i
                                                                        class="fas fa-trash"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif


                                            </tfoot>

                                            <tbody>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                                            <ul class="pagination">
                                               {{ $adjustmentdata->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end content-->
                    </div>
                </div>
            </div>

            <livewire:admin.dashboard.dep.production.material.adjustment.modal.adadjustmentmodal />

        </div>
    </div>



</div>
