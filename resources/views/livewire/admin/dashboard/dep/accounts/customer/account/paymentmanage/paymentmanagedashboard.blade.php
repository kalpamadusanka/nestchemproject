<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <h4 class="me-3">Payments Management</h4>

            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-secondary me-3" onclick="window.history.back()">
                    <i class="bi bi-arrow-left-circle me-2"></i>Back
                </button>

                <livewire:admin.dashboard.notifylayout />
            </div>
        </div>
<div class="payment-management-dashboard">


    <!-- Dashboard Summary Cards -->
    <div class="row mb-4">
        <!-- Total Payments Card -->
        <div class="col-md-3">
            <div class="card summary-card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Payments</h5>
                    <h5 class="amount">LKR&nbsp;{{ number_format($totalpayment ?? 0, 2) }}</h5>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i> 12% from last month
                    </div>
                </div>
            </div>
        </div>

        <!-- Allocated Payments Card -->
        <div class="col-md-3">
            <div class="card summary-card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Allocated</h5>
                    <h5 class="amount">LKR&nbsp;{{ number_format($totalallocated ?? 0, 2) }}</h5>
                    <div class="percentage">75% of total</div>
                </div>
            </div>
        </div>

        <!-- Unallocated Payments Card -->
        <div class="col-md-3">
            <div class="card summary-card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Unallocated</h5>
                    <h5 class="amount">LKR&nbsp;{{ number_format($totalunallocated ?? 0, 2) }}</h5>
                    <div class="percentage">25% of total</div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="col-md-3">
            <div class="card summary-card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Recent Activity</h5>
                    <div class="activity-item">{{ $newpaymentcount ?? 0 }} new payments today</div>
                    <div class="activity-item">{{ $allocationpendingcount ?? 0 }} allocations pending</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Action Bar -->
    <div class="card filter-bar mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" wire:model.live="search" placeholder="Search payments...">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary me-2">
                            <i class="bi bi-download"></i> Export
                        </button>
                        <button class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> New Allocation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Payment Tables -->
    <div class="row">
        <!-- Allocated Payments Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-check-circle me-2"></i>Allocated Payments
                        <span class="badge bg-light text-dark float-end">{{ $allocatecount ?? 0 }} records</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($allocatedpayment)
                                    @foreach ($allocatedpayment as $allocate)
                                   <tr>
                                    <td>PAY-{{ $allocate->id }}</td>
                                    <td>{{ $allocate->paymentData->account_name ?? 0 }}</td>
                                    <td>LKR&nbsp;{{ number_format($allocate->amount ?? 0, 2) }}</td>
                                    <td>2023-06-15</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-receipt"></i>
                                        </button>
                                    </td>
                                </tr>
                                    @endforeach
                                @endif

                                <!-- More rows would appear here -->
                            </tbody>
                        </table>
                    </div>
                     <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                                <ul class="pagination">
                                    {{ $allocatedpayment->links() }}
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <!-- Unallocated Payments Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-exclamation-circle me-2"></i>Unallocated Payments
                        <span class="badge bg-light text-dark float-end">{{ $unallocatecount ?? 0 }} records</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Source</th>
                                    <th>Amount</th>
                                    <th>Received</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($unallocatedpayment)
                                   @foreach ($unallocatedpayment as $unallocate)
                                              <tr>
                                    <td>PAY-{{ $unallocate->id }}</td>
                                    <td>{{ $unallocate->type ?? 'N/A' }}</td>
                                    <td>LKR&nbsp;{{ number_format($unallocate->amount ?? 0, 2) }}</td>
                                 <td>{{ $unallocate->created_at->format('Y F d h:i A') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success me-1" wire:click="allocatepayment({{ $unallocate->id }})">
                                            <i class="bi bi-check"></i> Allocate
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                   @endforeach
                                @endif

                                <!-- More rows would appear here -->
                            </tbody>
                        </table>
                    </div>
                   <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                                <ul class="pagination">
                                    {{ $unallocatedpayment->links() }}
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Allocation Activity -->
    <div class="card mt-4" hidden>
        <div class="card-header">
            <h5>Recent Allocation Activity</h5>
        </div>
        <div class="card-body">
            <ul class="timeline">
                <li>
                    <div class="timeline-badge success"><i class="bi bi-check"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h6 class="timeline-title">Payment allocated to account</h6>
                            <p><small class="text-muted"><i class="bi bi-clock"></i> 2 hours ago</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>PAY-78234 ($320.00) allocated to ACC-10245 (Sarah Johnson) by admin@example.com</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-badge warning"><i class="bi bi-exclamation"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h6 class="timeline-title">Unallocated payment received</h6>
                            <p><small class="text-muted"><i class="bi bi-clock"></i> 4 hours ago</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>New payment received via Credit Card (PAY-89126, $125.00)</p>
                        </div>
                    </div>
                </li>
                <!-- More timeline items would appear here -->
            </ul>
        </div>
    </div>
</div>

<style>
    /* Summary Cards */
.summary-card {
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.summary-card:hover {
    transform: translateY(-5px);
}

.summary-card .amount {
    font-weight: 700;
    margin: 10px 0;
}

.summary-card .trend.up {
    color: #d1f7d1;
}

.summary-card .trend.down {
    color: #ffcccc;
}

/* Tables */
.table-responsive {
    max-height: 400px;
    overflow-y: auto;
}

.table thead {
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 10;
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 50px;
    list-style: none;
}

.timeline:before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline > li {
    position: relative;
    margin-bottom: 20px;
}

.timeline-badge {
    position: absolute;
    left: -50px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    text-align: center;
    line-height: 30px;
    color: white;
}

.timeline-badge.success {
    background: #28a745;
}

.timeline-badge.warning {
    background: #ffc107;
}

.timeline-panel {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }

    .col-md-6 {
        width: 100%;
        margin-bottom: 20px;
    }
}
</style>

</div>
 <livewire:admin.dashboard.dep.accounts.customer.account.paymentmanage.modal.allocatemodalpayment/>
 <script>
      window.addEventListener('paymentallocated', function() {


                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Payment allocated successfully.',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: 'top-end'
                });
            });
 </script>
</div>
