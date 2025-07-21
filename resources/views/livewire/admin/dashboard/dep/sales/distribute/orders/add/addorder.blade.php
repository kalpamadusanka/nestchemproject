<div class="main-panel ps ps--active-y p-2" id="main-panel">
    <!-- Header Section -->
     <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Order Management</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>

    <!-- Purchases Overview Section -->
    <div class="container mt-4" style="padding-top: 3%">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add Order Form</h4>

            </div>

            <div class="card-body">
                <form wire:submit.prevent="submit">
                    <div class="row mb-3">
                        <div class="col-md-5 position-relative">
                            <label for="product_group"
                                class="form-label @error('product_group') is-invalid @enderror">Invoice No</label>
                            <div class="input-group">
                                <input type="text" wire:model="invoice_no" class="form-control">
                                <button class="btn btn-primary" type="button"
                                    wire:click="generateInvoiceNo">Generate</button>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="product"
                                class="form-label @error('product') is-invalid @enderror">Customer</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Company name"
                                    wire:model.live="customer" autocomplete="off">

                                @if (!empty($suggestions))
                                    <ul class="list-group position-absolute w-100 z-10"
                                        style="max-height: 200px; overflow-y: auto; padding-top: 15%;z-index:1">
                                        @foreach ($suggestions as $suggestion)
                                            <li class="list-group-item list-group-item-action"
                                                wire:click="selectSuggestion('{{ $suggestion }}')">
                                                {{ $suggestion }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- Material Selection Panel -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Products</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive mb-4" style="max-height: 300px; overflow-y: auto;">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Search product name..." wire:model.live="searchTerm">
                                        </div>


                                        <div class="product-grid">
                                            @if ($products)
                                                @foreach ($products as $index => $p)
                                                    <div class="card product-card shadow-sm border">
                                                        <div class="card-body">
                                                            <div class="form-check mb-2">
                                                                <input type="checkbox" class="form-check-input"
                                                                    wire:model="products.{{ $index }}.selected"
                                                                    id="selectProduct{{ $index }}">
                                                                <label class="form-check-label fw-bold"
                                                                    for="selectProduct{{ $index }}">
                                                                    {{ $p['product_name'] ?? 'N/A' }}
                                                                </label>
                                                                <input type="hidden"
                                                                    wire:model="products.{{ $index }}.product_name"
                                                                    value="{{ $p['product_name'] }}">
                                                                <input type="hidden"
                                                                    wire:model="products.{{ $index }}.stock_id"
                                                                    value="{{ $p['stock_id'] }}">
                                                                    <input type="hidden"
                                                                    wire:model="products.{{ $index }}.loading_id"
                                                                    value="{{ $p['loading_id'] }}">

                                                            </div>

                                                            <div class="mb-2 text-muted">
                                                                Available: <strong>{{ $p['total_qty'] }}
                                                                    {{ $p['uom'] }}</strong>
                                                            </div>

                                                            <div class="input-group input-group-sm align-items-center"
                                                                style="max-width: 100%;">
                                                                <button class="btn btn-outline-secondary px-3"
                                                                    style="background-color: #8b8b8b" type="button"
                                                                    wire:click="decreaseQuantity({{ $p['product_id'] }})">-</button>

                                                                <input type="text" class="form-control text-center"
                                                                    wire:model="products.{{ $index }}.quantity"
                                                                    readonly style="min-width: 40px;">

                                                                <button class="btn btn-outline-secondary px-3"
                                                                    style="background-color: #8b8b8b" type="button"
                                                                    wire:click="increaseQuantity({{ $p['product_id'] }}, {{ $p['total_qty'] }})">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Can Size</th>
                                                        <th>Purchased</th>
                                                        <th>Exchanged</th>
                                                        <th>Price per Can</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($canRecords as $index => $record)
                                                        <tr>
                                                            <td>{{ $record['size'] }}</td>
                                                            <td>
                                                                <input type="number"
                                                                    wire:model.live="canRecords.{{ $index }}.purchased"
                                                                    class="form-control" min="0">
                                                            </td>
                                                            <td>
                                                                <input type="number"
                                                                    wire:model.live="canRecords.{{ $index }}.exchanged"
                                                                    class="form-control" min="0">
                                                            </td>
                                                            <td>
                                                                <input type="number"
                                                                    wire:model.live="canRecords.{{ $index }}.price"
                                                                    class="form-control" min="0"
                                                                    step="0.01">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <button wire:click.prevent="calculateCanTotal"
                                                class="btn btn-primary mt-3">Calculate Can Price</button>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div id="map" style="height: 400px;" wire:ignore></div>
                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

                        <script>
                            document.addEventListener('livewire:navigated', function() {
                                // Get location
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(function(position) {
                                        let lat = position.coords.latitude;
                                        let lng = position.coords.longitude;

                                        // Send to Livewire
                                        @this.call('updateDeviceLocation', lat, lng);

                                        console.log("located", lat, lng)
                                        // Show map
                                        var map = L.map('map').setView([lat, lng], 13);
                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '© OpenStreetMap contributors'
                                        }).addTo(map);

                                        L.marker([lat, lng]).addTo(map)
                                            .bindPopup("Your Location").openPopup();
                                    });
                                } else {
                                    alert("Geolocation is not supported by this browser.");
                                }
                            });
                        </script>
                    </div>
                    <div class="row mb-3 py-2">
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-muted">Quantity</h5>
                                    <h2 class="text-primary fw-bold">{{ $qty ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-muted">Total</h5>
                                    <h2 class="text-success fw-bold">Rs. {{ number_format($total ?? 0, 2) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">
                                <span class="indicator-label" wire:loading.remove>Add</span>
                                <span class="indicator-progress" wire:loading>Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>

                            <button class="btn btn-danger" wire:click="resetForm">Reset</button>
                            <button class="btn btn-danger" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .product-card {
            flex: 0 0 calc(20% - 1rem);
            /* 5 per row with spacing */
            min-width: 200px;
        }

        @media (max-width: 992px) {
            .product-card {
                flex: 0 0 calc(33.33% - 1rem);
                /* 3 per row on medium screens */
            }
        }

        @media (max-width: 768px) {
            .product-card {
                flex: 0 0 calc(50% - 1rem);
                /* 2 per row on small screens */
            }
        }

        @media (max-width: 576px) {
            .product-card {
                flex: 0 0 100%;
                /* 1 per row on extra small screens */
            }
        }
    </style>
    <script>
        window.addEventListener('errorsalesAdded', function(event) {
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

        window.addEventListener('salesAdded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'New Sales record added successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
    </script>
</div>
