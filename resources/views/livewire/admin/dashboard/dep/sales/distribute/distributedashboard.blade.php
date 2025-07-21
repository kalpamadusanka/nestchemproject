<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

         <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Distributing</h4>
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
                            <li class="breadcrumb-item"><a href="#">Product</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Distributing</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div
                                class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                                    <input type="checkbox" id="jobCheckbox" wire:model.live="isJobChecked">
                                    <label for="jobCheckbox" class="mb-0">My Job</label>
                                    <h4 class="card-title mb-0 ms-3">Distributing List</h4>
                                </div>
                            </div>

                        </div>


                        <div class="card-body">
    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-lg-row gap-3 justify-content-between align-items-stretch">
                <div class="search-box flex-grow-1">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text bg-transparent">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="search" class="form-control form-control-lg"
                               placeholder="Search DO numbers..."
                               wire:model.live="search"
                               aria-controls="datatable">
                    </div>
                </div>

                <div class="date-filter">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text bg-transparent">
                            <i class="bi bi-calendar"></i>
                        </span>
                        <input type="text" id="date-range"
                               class="form-control form-control-lg"
                               wire:model="daterange"
                               placeholder="Filter by date range">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DO Cards Grid -->
    <div class="row g-4">
        @if ($createddo)
            @foreach ($createddo as $do)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card delivery-card h-100 border-0">
                        <!-- Card Header with Status Badges -->
                        <div class="card-header bg-white border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2">
                                    @if ($do->load_status == 0)
                                        <span class="badge bg-soft-secondary text-secondary">
                                            <i class="bi bi-box-seam me-1"></i> Loading
                                        </span>
                                    @elseif ($do->load_status == 1)
                                        <span class="badge bg-soft-success text-success">
                                            <i class="bi bi-check-circle me-1"></i> Loaded
                                        </span>
                                    @endif

                                    @if ($do->unload_status == 0)
                                        <span class="badge bg-soft-secondary text-secondary">
                                            <i class="bi bi-upload me-1"></i> Unloading
                                        </span>
                                    @elseif($do->unload_status == 1)
                                        <span class="badge bg-soft-success text-success">
                                            <i class="bi bi-check-circle me-1"></i> Unloaded
                                        </span>
                                    @endif
                                </div>

                                <div class="dropdown">
                                    <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body pt-2">
                            <!-- DO Number and Summary -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">
                                    <span class="text-muted small">DO#</span>
                                    <strong>{{ $do->do_no }}</strong>
                                </h4>
                                <span class="badge bg-soft-{{ $do->status ? 'success' : 'danger' }}">
                                    {{ $do->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <!-- Delivery Details -->
                            <div class="delivery-details mb-4">
                                <div class="detail-item">
                                    <div class="detail-icon bg-soft-primary">
                                        <i class="bi bi-truck text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="detail-label">Vehicle</p>
                                        <p class="detail-value">{{ $do->vehicleCheck->item ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-icon bg-soft-info">
                                        <i class="bi bi-person-badge text-info"></i>
                                    </div>
                                    <div>
                                        <p class="detail-label">Sales Rep</p>
                                        <p class="detail-value">{{ $do->salePerson->name ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-icon bg-soft-warning">
                                        <i class="bi bi-person text-warning"></i>
                                    </div>
                                    <div>
                                        <p class="detail-label">Driver</p>
                                        <p class="detail-value">{{ $do->driverCheck->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Show Orders Button (Always visible) -->
                            <div class="mb-3">
                                @if ($user->id == $do->sale_represntative || $user->role == 'Superadmin')
                                @if ($do->start_time)
                                     <a href="{{ route('admin.sale.do.orders', ['do_no' => $do->do_no]) }}"
                                       wire:navigate
                                       class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-list-ul me-2"></i> Show Orders
                                    </a>
                                @endif

                                @endif
                            </div>
                                                   <div class="mb-3">
                               @if ($user->id == $do->sale_representative || $do->driver)
    <a href="{{ route('admin.sale.do.vehicle.dashboard', ['do_no' => $do->do_no]) }}"
       wire:navigate
       class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
        <i class="bi bi-list-ul me-2"></i> Update Vehicle Record
    </a>
     <a href="{{ route('admin.sale.do.expenses.dashboard', ['do_no' => $do->do_no]) }}"
       wire:navigate
       class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
        <i class="bi bi-list-ul me-2"></i> Expenses
    </a>
@endif
                            </div>

                            <!-- Timeline and Actions -->
                            <div class="delivery-timeline">
                                @if ($do->start_time)
                                    <div class="timeline-container">
                                        <div class="timeline-progress {{ $do->end_time ? 'completed' : 'in-progress' }}">
                                            <div class="progress-bar"></div>
                                            <div class="milestone start">
                                                <div class="milestone-icon">
                                                    <i class="bi bi-play-fill"></i>
                                                </div>
                                                <div class="milestone-details">
                                                    <p class="milestone-label">Started</p>
                                                    <p class="milestone-time">
                                                        {{ \Carbon\Carbon::parse($do->start_time)->format('M j, h:i A') }}
                                                    </p>
                                                </div>
                                            </div>

                                            @if ($do->end_time)
                                                <div class="milestone end">
                                                    <div class="milestone-icon">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                    </div>
                                                    <div class="milestone-details">
                                                        <p class="milestone-label">Completed</p>
                                                        <p class="milestone-time">
                                                            {{ \Carbon\Carbon::parse($do->end_time)->format('M j, h:i A') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="duration-badge">
                                                    <i class="bi bi-clock-history"></i>
                                                    {{ \Carbon\Carbon::parse($do->start_time)->diffForHumans(\Carbon\Carbon::parse($do->end_time), true) }}
                                                </div>
                                            @endif
                                        </div>

                                        @unless ($do->end_time)
                                            <button class="btn btn-danger btn-sm mt-3 w-100"
                                                    onclick="if(confirm('Are you sure you want to end this delivery?')) @this.call('end', {{ $do->do_no }})">
                                                <i class="bi bi-stop-circle me-1"></i> End Delivery
                                            </button>
                                        @endunless
                                    </div>
                                @else
                                    {{-- @if ($do->sale_represntative == $user->id)
                                        <button class="btn btn-primary w-100"
                                            wire:click="start({{ $do->do_no }})">
                                        <i class="bi bi-play-fill me-1"></i> Start Delivery
                                    </button>
                                    @endif --}}
                                     <button class="btn btn-primary w-100"
                                            wire:click="start({{ $do->do_no }})">
                                        <i class="bi bi-play-fill me-1"></i> Start Delivery
                                    </button>
                                @endif
                            </div>

                            <!-- Sales Summary -->
                            <div class="sales-summary mt-3">
                                @php
                                    $totalSale = App\Models\Salesorder::where('do_no', $do->do_no)->sum('total');
                                @endphp
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Total Sales</span>
                                    <h4 class="mb-0 text-success">LKR {{ number_format($totalSale, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-truck"></i>
                    <h4>No Delivery Orders Found</h4>
                    <p>Create a new delivery order to get started</p>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* Modern Card Styling */
    .delivery-card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }

    .delivery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    /* Detail Items */
    .delivery-details {
        background: #f9fafc;
        border-radius: 10px;
        padding: 15px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }

    .detail-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-bottom: 2px;
    }

    .detail-value {
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0;
    }

    /* Timeline */
    .timeline-container {
        position: relative;
        padding: 15px 0;
    }

    .timeline-progress {
        position: relative;
        padding-left: 40px;
    }

    .timeline-progress:before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-progress.in-progress:before {
        background: linear-gradient(to bottom, #0d6efd 50%, #e9ecef 50%);
    }

    .timeline-progress.completed:before {
        background: #0d6efd;
    }

    .milestone {
        position: relative;
        margin-bottom: 20px;
    }

    .milestone:last-child {
        margin-bottom: 0;
    }

    .milestone-icon {
        position: absolute;
        left: -40px;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        background: #e9ecef;
    }

    .milestone.start .milestone-icon {
        background: #0d6efd;
    }

    .milestone.end .milestone-icon {
        background: #198754;
    }

    .milestone-label {
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .milestone-time {
        font-size: 0.75rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    .duration-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        background: #f8f9fa;
        border-radius: 20px;
        font-size: 0.75rem;
        margin-top: 10px;
    }

    .duration-badge i {
        margin-right: 5px;
    }

    /* Sales Summary */
    .sales-summary {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 12px 15px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 15px;
    }

    .empty-state h4 {
        color: #6c757d;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #adb5bd;
    }
</style>
                    </div>
                </div>
            </div>
        </div>

        <livewire:admin.dashboard.dep.sales.do.modal.adddomodal />
    </div>
    <style>
        /* Started State Styles */
        .started-container {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 12px 16px;
            display: inline-block;
        }

        .started-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .started-icon {
            background-color: #22c55e;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .started-label {
            font-weight: 600;
            color: #166534;
            font-size: 14px;
        }

        .started-time {
            color: #15803d;
            font-size: 13px;
            margin-top: 2px;
        }

        .time-separator {
            color: #86efac;
            margin: 0 4px;
        }

        /* Start Button Styles */
        .start-button {
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .start-button:hover {
            background-color: #2563eb;
        }

        .start-icon {
            font-size: 12px;
        }
    </style>
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
        .sale-summary {
            background: linear-gradient(135deg, #4CAF50, #8BC34A);
            border-radius: 8px;
            padding: 15px;
            color: white;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .sale-header {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .sale-icon {
            font-size: 20px;
            margin-right: 8px;
        }

        .sale-header h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 500;
        }

        .sale-amount {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }

        .sale-footer {
            display: flex;
            align-items: center;
            font-size: 12px;
            opacity: 0.9;
            justify-content: center;
        }

        .trend-icon {
            margin-right: 5px;
        }

        /* Add responsive styles */
        .time-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
            max-width: 300px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Status Badges */
        .time-card-header {
            display: flex;
            gap: 8px;
            margin-bottom: 12px;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .started {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        .completed {
            background-color: #dcfce7;
            color: #166534;
        }

        /* Time Rows */
        .time-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .time-row {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .time-icon {
            font-size: 18px;
            margin-top: 2px;
        }

        .time-label {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 2px;
        }

        .time-value {
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
        }

        /* Duration Row */
        .duration-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #e2e8f0;
            font-size: 13px;
            color: #475569;
        }

        .duration-icon {
            font-size: 16px;
        }

        /* Start Button */
        .start-button {
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .start-button:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }

        .start-icon {
            font-size: 12px;
        }

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

        window.addEventListener('dostarted', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'The Delivery Order has been successfully initiated.!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
        window.addEventListener('doended', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'The Delivery Order has been successfully processed and finalized.!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
    </script>

</div>
