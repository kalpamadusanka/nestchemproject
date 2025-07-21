<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

       <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Unloading Management</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>

        <!-- Grid of Cards -->
        <div class="container-fluid px-0 px-md-2" style="padding-top: 3%">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="mb-3 mb-md-0" >
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Unloading</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <h4 class="card-title mb-2 mb-md-0">Unloading List</h4>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">

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
                                                            class="form-control form-control-sm" wire:model="daterange"
                                                            placeholder="Select date range">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <link rel="stylesheet"
                                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
                            <div class="row">
                                @if ($createddo)
                                    @foreach ($createddo as $do)
                                        <div class="col-md-4 p-2">
                                            <div class="card shelf-card h-100 border-0 shadow-sm">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                                        @if ($do->load_status == 0)
                                                            <span class="badge bg-secondary">Loading</span>
                                                        @elseif ($do->load_status == 1)
                                                            <span class="badge bg-success">Loading</span>
                                                        @else
                                                        @endif
                                                        @if ($do->unload_status == 0)
                                                            <span class="badge bg-secondary">Unloading</span>
                                                        @elseif($do->unload_status == 1)
                                                            <span class="badge bg-success">Unloading</span>
                                                        @endif
                                                        @if ($do->status == 1)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-success">Deactive</span>
                                                        @endif
                                                    </div>

                                                    <h5 class="card-title fw-bold mb-3">DO: {{ $do->do_no }}</h5>

                                                    <div class="card-details mb-4">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="bi bi-truck me-2 text-muted"></i>
                                                            <span class="text-muted">Vehicle:</span>
                                                            <span
                                                                class="ms-2 fw-medium">{{ $do->vehicleCheck->item ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="bi bi-person-badge me-2 text-muted"></i>
                                                            <span class="text-muted">Sales Rep:</span>
                                                            <span
                                                                class="ms-2 fw-medium">{{ $do->salePerson->name ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-person me-2 text-muted"></i>
                                                            <span class="text-muted">Driver:</span>
                                                            <span
                                                                class="ms-2 fw-medium">{{ $do->driverCheck->name ?? 'N/A' }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="d-grid">
                                                        <a href="{{ route('admin.sale.do.unload', ['do_no' => $do->do_no]) }}"
                                                            wire:navigate
                                                            class="btn btn-primary d-flex align-items-center justify-content-center">
                                                            <i class="bi bi-plus-circle me-2"></i>Unload
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                @endif

                            </div>
  <nav aria-label="Table pagination">
                                            <ul class="pagination justify-content-end">
                                                {{ $createddo->links() }}
                                            </ul>
                                        </nav>
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
        window.addEventListener('productstocknotavailable', function(event) {
            Swal.fire({
                icon: 'warning', // Change icon to 'error' instead of 'success'
                title: 'warning!',
                text: 'The product you are looking for is currently not available on the shelf. Please check back later or contact a staff member for assistance.', // Show the error message
                showConfirmButton: false,
                timer: 5000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('stockadjustmentsuccess', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Stock adjustment successful. Inventory updated!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
    </script>

</div>
