<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">

        <nav class="navbar navbar-expand-lg navbar-transparent   navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">Customer Payments</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <livewire:admin.dashboard.nav.navitem />
            </div>
        </nav>

        <!-- Grid of Cards -->
        <div class="container-fluid px-0 px-md-2" style="padding-top: 6%">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="mb-3 mb-md-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Payments</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customer</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <h4 class="card-title mb-2 mb-md-0">Payments - {{ $orderId ?? 'Order ID Not FOund' }}</h4>
                        </div>

                        <!-- payment-form.blade.php -->
                        <div class="card-body">
                            <!-- Total Amount Display -->
                            <form wire:submit.prevent="submit">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="alert alert-primary">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="mb-0">Total Amount Due</h4>
                                                @if ($pendingAmount > 0)
                                                  <h2 class="mb-0 font-weight-bold">
                                                    LKR&nbsp;{{ number_format($pendingAmount, 2) }}</h2>

                                                    @elseif ($pendingAmount < 0)
                                                      <h2 class="mb-0 font-weight-bold">
                                                    LKR&nbsp;{{ number_format($pendingAmount, 2) }}</h2>
                                                @else
                                                 <h2 class="mb-0 font-weight-bold">
                                                    Total Paid</h2>

                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Options -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h5 class="mb-3">Payment Options</h5>
                                        <div class="btn-group btn-group-toggle w-100">
                                            <label
                                                class="btn btn-outline-primary @if ($paymentType === 'credit') active @endif">
                                                <input type="radio" wire:model.live="paymentType" value="credit"
                                                    autocomplete="off"> Credit Sale
                                            </label>
                                            <label
                                                class="btn btn-outline-primary @if ($paymentType === 'cash') active @endif">
                                                <input type="radio" wire:model.live="paymentType" value="cash"
                                                    autocomplete="off"> Cash Payment
                                            </label>
                                            <label
                                                class="btn btn-outline-primary @if ($paymentType === 'cheque') active @endif">
                                                <input type="radio" wire:model.live="paymentType" value="cheque"
                                                    autocomplete="off"> Cheque Payment
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Amount Input -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="paymentAmount">Payment Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" class="form-control" id="paymentAmount"
                                                    wire:model="paymentAmount"
                                                    @if ($paymentType === 'credit') readonly @endif step="0.01">
                                            </div>
                                            @if ($paymentType === 'credit')
                                                <small class="form-text text-muted">Amount will be 0 for credit
                                                    sales</small>
                                            @endif
                                            @error('paymentAmount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Cheque Details -->
                                @if ($showChequeFields)
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="mb-3">Cheque Details</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="chequeNumber">Cheque Number</label>
                                                        <input type="text" class="form-control" id="chequeNumber"
                                                            wire:model.live="chequeNumber" placeholder="Enter cheque number">
                                                        @error('chequeNumber')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bankName">Bank Name</label>
                                                        <input type="text" class="form-control" id="bankName"
                                                            wire:model.live="bankName" placeholder="Enter bank name">
                                                        @error('bankName')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="chequeDate">Cheque Date</label>
                                                        <input type="date" class="form-control" id="chequeDate"
                                                            wire:model.live="chequeDate">
                                                        @error('chequeDate')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="chequeImage">Upload Cheque Image</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="chequeImage" wire:model.live="chequeImage">
                                                            <label class="custom-file-label" for="chequeImage">
                                                                @if ($chequeImage)
                                                                    {{ $chequeImage->getClientOriginalName() }}
                                                                @else
                                                                    Choose file
                                                                @endif
                                                            </label>
                                                        </div>
                                                        @error('chequeImage')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Back
                                        </button>
                                        <div>
                                            <button type="button" class="btn btn-light mr-2" hidden>
                                                <i class="bi bi-save"></i> Save Draft
                                            </button>
                                            <button type="button" class="btn btn-success"
                                                wire:click="processPayment">
                                                <i class="bi bi-credit-card"></i> Process Payment
                                            </button>
                                            <button type="button" class="btn btn-primary ml-2" hidden>
                                                <i class="bi bi-printer"></i> Print Invoice
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                @if (session()->has('message'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                 @if (session()->has('errorsaved'))
                                    <div class="alert alert-danger mt-3">
                                        {{ session('errorsaved') }}
                                    </div>
                                @endif
   </form>
                        </div>
                        <div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">Payment Records</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Invoice No</th>
                        <th>Payment Type</th>
                        <th>Amount (LKR)</th>
                         <th>Paid Amount (LKR)</th>
                        <th>Cheque Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @if ($payments)
                        @forelse($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                        <td>{{ $payment->invoice_no ?? 0 }}</td>
                        <td>
                            @if($payment->type === 'cash')
                                <span class="badge badge-success">Cash</span>
                            @elseif($payment->type === 'cheque')
                                <span class="badge badge-info">Cheque</span>
                            @else
                                <span class="badge badge-warning">Credit</span>
                            @endif
                        </td>
                        <td class="text-right">{{ number_format($payment->total, 2) }}</td>
                        <td class="text-right">{{ number_format($payment->paid_amount, 2) }}</td>

                        <td>
                            @if($payment->type === 'cheque')
                                <small>
                                    Bank: {{ $payment->bank_name }}<br>
                                    Cheque No: {{ $payment->cheque_number }}<br>
                                    Date: {{ $payment->cheque_date }}
                                </small>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <button wire:click="viewPayment({{ $payment->id }})" class="btn btn-sm btn-info" title="View">
                                <i class="bi bi-eye"></i>
                            </button>
                            @if($payment->status === 'pending')
                                <button wire:click="editPayment({{ $payment->id }})" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button wire:click="confirmDelete({{ $payment->id }})" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No payment records found</td>
                    </tr>
                    @endforelse
                  @endif
                </tbody>

            </table>
        </div>
    </div>

</div>

                    </div>
                </div>
            </div>
        </div>

        <livewire:admin.dashboard.dep.sales.distribute.orders.payment.modal.paymentmodal />
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

        window.addEventListener('paymentrecordadd', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Payment record add successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

    </script>

</div>
