<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Shelf Management</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Loading</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- Bootstrap CSS -->


                        <!-- Bootstrap Bundle with Popper -->


                        <div class="card-body">
                            <div class="container-fluid">
                                <!-- Header -->
                                <header
                                    class="d-flex justify-content-between align-items-center py-3 mb-4 border-bottom">
                                    <h1 class="h4 mb-0">
                                        <i class="bi bi-box-seam me-2"></i>
                                        <span class="d-none d-sm-inline">Loading - DO:{{ $do_no ?? 'N/A' }}</span>
                                        <span class="d-sm-none">SMS</span>
                                    </h1>

                                    @if ($doStatus == null)
                                        <button class="btn" type="button" wire:click="verifyload">
                                            <i class="bi bi-person-circle me-1"></i>
                                            Verify
                                        </button>
                                    @else
                                        <button class="btn" type="button" >
                                            <i class="bi bi-person-circle me-1"></i>
                                            Verified
                                        </button>
                                    @endif


                                </header>

                                <!-- Dashboard -->
                                <div class="row mb-4">
                                    <!-- Quick Actions -->
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Quick Actions</h5>
                                                <div class="row g-3">
                                                    <div class="col-6">
                                                        <div class="card quick-action-card text-center py-3"
                                                            wire:click="setnewload({{ $do_no }})">
                                                            <i class="bi bi-plus-circle fs-3 text-primary"></i>
                                                            <div class="mt-2">New Load</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card quick-action-card text-center py-3">
                                                            <i class="bi bi-file-earmark-text fs-3 text-primary"></i>
                                                            <div class="mt-2">Reports</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card quick-action-card text-center py-3" wire:click="inventorycheck({{ $do_no }})">
                                                            <i class="bi bi-boxes fs-3 text-primary"></i>
                                                            <div class="mt-2">Inventory</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card quick-action-card text-center py-3">
                                                            <i class="bi bi-bell fs-3 text-primary"></i>
                                                            <div class="mt-2">Alerts</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Statistics -->
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Today's Overview</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Products Loaded Today
                                                        <span class="badge bg-primary rounded-pill">142</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Pending Verification
                                                        <span class="badge bg-warning rounded-pill">23</span>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        Avg. Processing Time
                                                        <span class="badge bg-secondary rounded-pill">12m</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Recent Activity -->
                                    <div class="col-md-12 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Recent Activity</h5>
                                                <div class="list-group list-group-flush" style="max-height: 250px; overflow-y: auto;">
                                                    @if ($activities)
                                                        @foreach ($activities as $a)
                                                        <div class="list-group-item">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <small class="text-muted">{{ $a->created_at }}</small>
                                                            </div>
                                                            <p class="mb-1">{{ $a->activity }}</p>
                                                        </div>
                                                        @endforeach
                                                    @endif



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Main Table -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Product Loading Records</h5>
                                        <div>
                                            <button class="btn btn-sm btn-outline-secondary me-2">
                                                <i class="bi bi-funnel"></i> Filters
                                            </button>
                                            <div class="input-group input-group-sm" style="width: 200px;">
                                                <input type="text" class="form-control" placeholder="Search..."
                                                    wire:model.live="search">
                                                <button class="btn btn-outline-secondary" type="button">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Product Code</th>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Current Qty</th>
                                                        <th>Prepared By</th>
                                                        <th>Verified By</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($loadedproducts)
                                                        @foreach ($loadedproducts as $load)
                                                            <tr>
                                                                <td>{{ $load->productData->product_code ?? 'N/A' }}</td>
                                                                <td>{{ $load->productData->product_name ?? 'N/A' }}</td>
                                                                <td>{{ $load->qty ?? '0' }}</td>
                                                                <td>{{ $load->in_loading_stock ?? '0' }}</td>
                                                                <td>{{ $load->saleDispatch->loadingPrepared->name ?? 'N/A' }}
                                                                </td>
                                                                <td>{{ $load->saleDispatch->loadingStorekeeper->name ?? 'N/A' }}
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        wire:click="deleteloadeditem({{ $load->id }})">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                </tbody>
                                            </table>
                                        </div>
                                        <nav aria-label="Table pagination">
                                            <ul class="pagination justify-content-end">
                                                {{ $loadedproducts->links() }}
                                            </ul>
                                        </nav>
                                    </div>
                                </div>

                                <!-- New Load Modal (Example) -->
                                <livewire:admin.dashboard.dep.sales.load.loadproduct.modal.loadproductmodal />
                                <livewire:admin.dashboard.dep.sales.load.loadproduct.modal.loadinventorymodal />

                            </div>

                            <!-- Bootstrap JS Bundle with Popper -->
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                            <script>
                                // Example JavaScript to trigger the modal
                                document.querySelector('.quick-action-card:nth-child(1)').addEventListener('click', function() {
                                    var myModal = new bootstrap.Modal(document.getElementById('newLoadModal'));
                                    myModal.show();
                                });
                            </script>

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
        window.addEventListener('errorloadproductdelete', function(event) {
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

        window.addEventListener('errorloadingverified', function(event) {
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

        window.addEventListener('loadverified', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Load verified successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
        window.addEventListener('invalidQty', function(event) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Quantity',
                text: event.detail.message,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });


        window.addEventListener('errorloadingproducts', function(event) {
            Swal.fire({
                icon: 'error',
                title: 'Try again',
                text: event.detail.message,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });


        window.addEventListener('loadingproducts', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Loading products are saved successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });


        window.addEventListener('errorloadproductmodal', function(event) {
            Swal.fire({
                icon: 'error',
                title: 'This DO has already been loaded and verified. Please create a new DO.',
                text: event.detail.message,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('loadproductdelete', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Record deleted successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('loadingverified', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Successfully loaded verified products.!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
    </script>

</div>
