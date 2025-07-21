<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

         <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">DO Management</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>

        <!-- Grid of Cards -->
        <div class="container-fluid px-0 px-md-2" style="padding-top: 4%">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="mb-3 mb-md-0">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DO</li>
                        </ol>
                    </nav>
                </div>
                <div class="action-buttons">
                    <a wire:click="opendomodal" class="btn btn-primary btn-sm btn-md">
                        <i class="bi bi-plus-circle"></i>&nbsp;Add DO
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <h4 class="card-title mb-2 mb-md-0">DO List</h4>
                        </div>

                        <div class="card-body">
                            <div class="toolbar"></div>
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                                        <div class="dataTables_length">
                                            <label>Show
                                                <select name="datatable_length" aria-controls="datatable"
                                                    class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="-1">All</option>
                                                </select> entries
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div
                                                    class="dataTables_filter d-flex flex-column flex-md-row gap-2 justify-content-md-end align-items-stretch align-items-md-center">
                                                    <label class="w-100">
                                                        <input type="search" class="form-control form-control-sm"
                                                            placeholder="Search records" wire:model.live="search"
                                                            aria-controls="datatable">
                                                    </label>
                                                    <div class="d-flex gap-2">
                                                        <div class="form-group flex-grow-1">
                                                            <input type="text" id="date-range"
                                                                class="form-control form-control-sm"
                                                                wire:model="daterange"
                                                                placeholder="Select date range">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="datatable"
                                                class="table table-striped table-bordered dataTable dtr-inline"
                                                cellspacing="0" width="100%" role="grid"
                                                aria-describedby="datatable_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting sorting_asc">Do No</th>
                                                        <th class="sorting">Area</th>
                                                        <th class="sorting">Date</th>
                                                        <th class="sorting">Sale represntative</th>
                                                        <th class="sorting">Vehicle</th>
                                                        <th class="sorting">Driver</th>
                                                        <th class="sorting">Prepared By</th>
                                                        <th class="sorting">Verified By</th>
                                                        <th class="sorting">Unloading Prepared By</th>
                                                        <th class="sorting">Unloading Verified By</th>
                                                        <th class="sorting">Note</th>
                                                        <th class="sorting">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($saledispatch)
                                                        @foreach ($saledispatch as $sale)
                                                            <tr>
                                                                <td>{{ $sale->do_no }}</td>
                                                                <td>{{ $sale->area ?? 'Not Updated' }}</td>
                                                                <td>
                                                                    {{ $sale->date ?? 'Not Updated' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sale->salePerson->name ?? 'Not Updated' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sale->vehicleCheck->item ?? 'Not Updated' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sale->driverCheck->name ?? 'Not Updated' }}
                                                                </td>
                                                                <td>{{ $sale->loadingPrepared->name ?? 'Not Updated' }}</td>
                                                                <td>{{ $sale->loadingStorekeeper->name ?? 'Not Updated' }}</td>
                                                                <td>{{ $sale->unloadingPrepared->name ?? 'Not Updated' }}</td>
                                                                <td>{{ $sale->unloadingStorekeeper->name ?? 'Not Updated' }}</td>
                                                                <td>{{ $sale->note }}</td>
                                                                <td class="text-right">

                                                                    @if (auth()->user()->role == 'Superadmin')
                                                                        <a href="#"
                                                                            class="btn btn-round btn-danger btn-icon btn-sm remove"
                                                                            wire:click="deletedata({{ $sale->id }})"><i
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
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-7">
                                        <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                                            <ul class="pagination">
                                                {{ $saledispatch->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <livewire:admin.dashboard.dep.sales.do.modal.adddomodal />
    </div>

    <script>
        document.addEventListener('livewire:navigated', () => {
            flatpickr("#date-range", {
                mode: "range",
                dateFormat: "Y-m-d",
                wrap: false,
                onReady: function(selectedDates, dateStr, instance) {
                    const applyButton = document.createElement("button");
                    applyButton.type = "button";
                    applyButton.innerText = "Apply";
                    applyButton.className = "flatpickr-apply-btn btn btn-primary mt-2";

                    instance.calendarContainer.appendChild(applyButton);

                    applyButton.addEventListener("click", () => {
                        const dateRange = instance.input.value;
                        @this.set('daterange', dateRange);
                        @this.call('applyDate');
                        instance.close();
                    });
                }
            });
        });
    </script>

    <style>
        /* Add responsive styles */
        @media (max-width: 767.98px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .card-header,
            .card-body {
                padding: 0.75rem;
            }

            .dataTables_filter {
                flex-direction: column !important;
            }

            .dataTables_filter label {
                width: 100% !important;
                margin-bottom: 0.5rem;
            }

            .dataTables_length select {
                width: 80px !important;
            }
        }

        @media (min-width: 768px) {
            .dataTables_filter {
                flex-direction: row !important;
                align-items: center;
            }
        }
    </style>
    <script>
        window.addEventListener('errordoAdded', function(event) {
            Swal.fire({
                icon: 'error', // Change icon to 'error' instead of 'success'
                title: 'Error!',
                text: event.detail.message, // Show the error message
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });


        window.addEventListener('deletedo', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Existing Do deleted successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('errordeletedo', function() {


            Swal.fire({
                icon: 'error', // Change icon to 'error' instead of 'success'
                title: 'Error!',
                text: 'Verified DO cannot be deleted!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
        window.addEventListener('doAdded', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'New DO created successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
    </script>

</div>
