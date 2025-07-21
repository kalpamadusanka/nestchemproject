<div>
   <div class="main-panel ps ps--active-y p-2" id="main-panel">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h4 class="me-3">DO Account Details</h4>
            <nav class="nav">
                <!-- Optional navigation tabs can go here -->
            </nav>
        </div>
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-secondary me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />
        </div>
    </div>

    <!-- DO Summary Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 border-end">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-lg bg-light-primary text-primary rounded-3 me-3">
                                    <i class="bi bi-file-text fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">DO Number</h6>
                                    <h4 class="mb-0">DO-{{ $dono ?? 'N/A' }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 border-end">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-lg bg-light-info text-info rounded-3 me-3">
                                    <i class="bi bi-calendar fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Date</h6>
                                    <h4 class="mb-0">{{ $dispatch_date ?? 'N/A' }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-lg bg-light-success text-success rounded-3 me-3">
                                    <i class="bi bi-person fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Sales Rep</h6>
                                    <h4 class="mb-0">{{ $sales_rep ?? 'N/A' }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Overview -->
    <div class="row mb-4">
    <!-- Total Revenue Card -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-start-primary border-3 shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">Total Revenue</h6>
                        <h6 class="mb-0">LKR&nbsp;{{ $total_revenue ?? 'N/A' }}</h6>
                    </div>
                    <div class="icon-shape icon-lg bg-light-primary text-primary rounded-3">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-success">
                        <i class="bi bi-arrow-up me-1"></i> 8.5% from average
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Expenses Card -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-start-danger border-3 shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">Total Expenses</h6>
                        <h6 class="mb-0">LKR&nbsp;{{ $total_expenses ?? 'N/A' }}</h6>
                    </div>
                    <div class="icon-shape icon-lg bg-light-danger text-danger rounded-3">
                        <i class="bi bi-currency-dollar fs-3"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-danger">
                        <i class="bi bi-arrow-up me-1"></i> 12% from average
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Credit Card -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-start-warning border-3 shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">Total Credit</h6>
                        <h6 class="mb-0">LKR&nbsp;{{ $total_credit ?? 'N/A' }}</h6>
                    </div>
                    <div class="icon-shape icon-lg bg-light-warning text-warning rounded-3">
                        <i class="bi bi-credit-card fs-3"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-arrow-up me-1"></i> {{ $credit_change ?? '0' }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Debit Card (New Card) -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-start-info border-3 shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">Total Receving</h6>
                        <h6 class="mb-0">LKR&nbsp;{{ $total_receiving ?? 'N/A' }}</h6>
                    </div>
                    <div class="icon-shape icon-lg bg-light-info text-info rounded-3">
                        <i class="bi bi-cash-coin fs-3"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-info">
                        <i class="bi bi-arrow-down me-1"></i> {{ $debit_change ?? '0' }}%
                    </span>
                </div>
            </div>
        </div>
    </div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Net Profit Card -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-start-success border-3 shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">Net Profit</h6>
                      <h6 class="mb-0 @if($net_profit < 0) text-danger animate__animated animate__fadeIn @endif">
    LKR&nbsp;{{ $net_profit < 0 ? number_format(abs($net_profit), 2) : ($net_profit ?? 'N/A') }}
    @if($net_profit < 0)
        <span class="badge bg-danger ms-2">Loss</span>
    @endif
</h6>
                    </div>
                    <div class="icon-shape icon-lg bg-light-success text-success rounded-3">
                        <i class="bi bi-graph-up fs-3"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <!-- Detailed Sections -->
    <div class="row">
        <!-- Customer Payments Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Payments</h6>
                    <button class="btn btn-sm btn-primary">
                        <i class="bi bi-plus me-1"></i> Add Payment
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount (LKR)</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @if ($customerPayments)
                                 @foreach ($customerPayments as $payments)
                                <tr>
                                    <td>{{ $payments->created_at ?? 'N/A' }}</td>
                                    <td>{{ $payments->paid_amount ?? 'N/A' }}</td>
                                    <td>{{ $payments->type ?? 'N/A' }}</td>
                                    <td>
                                     @if ($payments->status ==1)
                                        <span class="badge bg-success"> Active</span>
                                    @else
                                      <span class="badge bg-danger">Deactive</span>
                                     @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                 @endforeach
                             @endif


                            </tbody>
                            <tfoot>
                                <tr class="table-light">
                                    <th>Total</th>
                                   <th>LKR&nbsp;{{ isset($total_revenue) ? number_format((float)$total_revenue, 2) : 'N/A' }}</th>

                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expenses Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger">Expenses Breakdown</h6>
                    <button class="btn btn-sm btn-danger">
                        <i class="bi bi-plus me-1"></i> Add Expense
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount(LKR)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @if ($expenses)
                                 @foreach ($expenses as $exp)
                                      <tr>
                                    <td>{{ $exp->date ?? 'N/A' }}</td>
                                    <td>{{ $exp->note ?? 'N/A' }}</td>
                                    <td>{{ $exp->amount ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                 @endforeach
                             @endif


                            </tbody>
                            <tfoot>
                                <tr class="table-light">
                                    <th>Total</th>
                                    <th colspan="2"></th>
                                   <th>LKR&nbsp;{{ isset($total_expenses) ? number_format((float)$total_expenses, 2) : 'N/A' }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Details Section -->
    <div class="row">
        <!-- Documents & Attachments -->

<livewire:admin.dashboard.dep.accounts.do.document.dodocument :dono="$dono" />
        <!-- Activity Log -->
      <livewire:admin.dashboard.dep.accounts.do.finalpayment.finalizepayment :dono="$dono" :orderNo />
    </div>
</div>

<!-- CSS for Timeline -->

<script>
     window.addEventListener('dofinalizesuccess', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'This DO is finalized successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
</script>
<style>
    .timeline {
        position: relative;
        padding-left: 1rem;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    .timeline-item-marker {
        position: absolute;
        left: -1rem;
    }
    .timeline-item-marker-indicator {
        width: 12px;
        height: 12px;
        border-radius: 100%;
        background-color: #dee2e6;
    }
    .timeline-item-content {
        padding-left: 1.5rem;
    }
    .icon-shape {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
    }
</style>

    </div>
