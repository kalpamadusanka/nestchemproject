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
                <div class="mb-3 mb-md-0">

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

                        <!-- Bootstrap CSS -->


                        <!-- Bootstrap Bundle with Popper -->


                        <div class="card-body">
                            <div class="container-fluid">
                                <!-- Header -->
                                <header
                                    class="d-flex justify-content-between align-items-center py-3 mb-4 border-bottom">
                                    <h1 class="h4 mb-0">
                                        <i class="bi bi-box-seam me-2"></i>
                                        <span class="d-none d-sm-inline">Unloading - DO:{{ $do_no ?? 'N/A' }}</span>
                                        <span class="d-sm-none">SMS</span>
                                    </h1>

                                    @if ($doStatus == null)
                                        <button class="btn" type="button" wire:click="verifyunload">
                                            <i class="bi bi-person-circle me-1"></i>
                                            Verify
                                        </button>
                                    @else
                                        <button class="btn" type="button"
                                            >
                                            <i class="bi bi-person-circle me-1"></i>
                                            Verified
                                        </button>
                                    @endif


                                </header>

                                <!-- Dashboard -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card">

                                            <div class="card-body">
                                                <div class="row text-center">
                                                    @if ($loadedproducts)
                                                        <div class="row">
                                                            @foreach ($loadedproducts as $index => $p)
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="form-control-plaintext mb-2">
                                                                        {{ $p->productData->product_name }}</div>
                                                                      <div class="input-group">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            wire:click="decrement({{ $index }})">-</button>
                                                                        <input type="number"
                                                                            class="form-control text-center"
                                                                            wire:model="quantities.{{ $index }}"
                                                                            min="0" readonly>
                                                                        <button class="btn btn-secondary" type="button"
                                                                            wire:click="increment({{ $index }})">+</button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-12 text-end">
                                                             @if ($doStatus != null)
                                                                     <button class="btn btn-primary mt-3"
                                                               disabled>Save Unload Records</button>
                                                             @else
                                                                  <button class="btn btn-primary mt-3"
                                                                wire:click="saveProducts">Save Unload Records</button>
                                                            @endif

                                                        </div>

                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function adjustQty(id, change) {
                                        const input = document.getElementById(id);
                                        let value = parseInt(input.value) + change;
                                        if (value < 0) value = 0;
                                        input.value = value;
                                    }
                                </script>


                                <!-- Main Table -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Product Unloading Records</h5>
                                        <div>
                                            <button class="btn btn-sm btn-outline-secondary me-2">
                                                <i class="bi bi-funnel"></i> Filters
                                            </button>
                                            <div class="input-group input-group-sm" style="width: 200px;">
                                                <input type="text" class="form-control" placeholder="Search..."
                                                    wire:model.live="searchrecord">
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
                                                        <th>Unload Quantity</th>
                                                        <th>Received By</th>
                                                        <th>Verified By</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @if ($unloadedproducts)
                                                        @foreach ($unloadedproducts as $load)
                                                            <tr>
                                                                <td>{{ $load->productData->product_code ?? 'N/A' }}</td>
                                                                <td>{{ $load->productData->product_name ?? 'N/A' }}</td>
                                                                <td>{{ $load->unload_qty ?? '0' }}</td>
                                                                <td>{{ $load->saleDispatch->loadingReceived->name ?? 'N/A' }}
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

                                    </div>
                                </div>

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
                                                                <td>{{ $load->productData->product_code ?? 'N/A' }}
                                                                </td>
                                                                <td>{{ $load->productData->product_name ?? 'N/A' }}
                                                                </td>
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
        window.addEventListener('unloadedsuccess', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Products unloaded successfully.',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
          window.addEventListener('unloadeddo', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'This DO unloaded successfully',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

    </script>

</div>
