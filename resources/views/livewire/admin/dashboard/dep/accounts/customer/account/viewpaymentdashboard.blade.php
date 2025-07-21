<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <h4 class="me-3">Customer Account Management</h4>
                {{-- <nav class="nav">
                <a class="nav-link active" href="#">Current Expenses</a>
                <a class="nav-link" href="#">Approval History</a>
                <a class="nav-link" href="#">Reports</a>
            </nav> --}}
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-secondary me-3" onclick="window.history.back()">
                    <i class="bi bi-arrow-left-circle me-2"></i>Back
                </button>

                <livewire:admin.dashboard.notifylayout />
            </div>
        </div>


        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Customer Payment Dashboard</h5>
            </div>
            <div class="card-body">
                <!-- Customer Summary Row -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h6 class="card-subtitle mb-2 text-muted">Total Balance</h6>
                                <h4 class="card-text text-primary">LKR&nbsp;{{ number_format($totalSum ?? 0, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h6 class="card-subtitle mb-2 text-muted">Paid Amount</h6>
                                <h4 class="card-text text-success">LKR&nbsp;{{ number_format($paidAmount ?? 0, 2) }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h6 class="card-subtitle mb-2 text-muted">Due Amount</h6>
                                <h4 class="card-text text-danger">
                                    LKR&nbsp;{{ number_format($totalDue->to_be_paid ?? 0, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h6 class="card-subtitle mb-2 text-muted">Next Payment Due</h6>
                                <h4 class="card-text text-warning">May 15, 2023</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment History and Schedule Section -->
                <div class="row">
                    <!-- Payment History -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">Recent Payment History</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                                <th>AddedBy</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($paymentsdata)
                                                @foreach ($paymentsdata as $payment)
                                                    <tr>
                                                        <td>{{ $payment->created_at->format('Y F j h:i:s A') }}</td>
                                                        <td>LKR&nbsp;{{ number_format($payment->amount, 2) }}
                                                            @if ($payment->doc)

                                                            <a href="{{ asset('customerschpaymentdoc/' . $payment->doc) }}"
                                                                target="_blank" class="btn btn-sm btn-primary">
                                                                View Receipt
                                                            </a>
                                                        </td>
                                                @endif
                                                </td>
                                                <td>{{ $payment->type ?? 'N/A' }}</td>
                                                <td>{{ $payment->userData->name ?? 'N/A' }}</td>
                                                <td>

                                                    @if ($payment->approved == 0)
                                                        @if (auth()->user()->role == 'Accountant' || 'Superadmin')
                                                            <a href="#" class="btn btn-sm btn-outline-primary"
                                                                wire:click="approvepayment({{ $payment->id }})">Approve</a>
                                                        @else
                                                            <span class="badge bg-warning">Pending
                                                                Approval</span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-success">Approved</span>
                                                    @endif
                                                     <a href="#" class="btn btn-sm btn-outline-primary"
                                                                wire:click="printreceipt({{ $payment->id }})">Print</a>
                                                </td>
                                                </tr>
                                            @endforeach
                                            @endif


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                                        <ul class="pagination">
                                            {{ $paymentsdata->links() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Actions -->
                    <div class="col-md-4">
                        <!-- Due Payments -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-white">
                                <h6 class="mb-0">Due Payments</h6>
                            </div>
                            <div class="card-body">
                                <div style="max-height: 200px; overflow-y: auto;">
                                    <ul class="list-group list-group-flush">
                                        @if ($schedulepaymentsdata)
                                            @foreach ($schedulepaymentsdata as $schedule)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        {{ $schedule->date }}
                                                        @if ($schedule->payment_method)
                                                            <span
                                                                class="badge bg-info ms-2">{{ $schedule->payment_method }}</span>
                                                        @endif
                                                    </div>
                                                    <span
                                                        class="badge bg-danger">LKR&nbsp;{{ number_format($schedule->amount, 2) }}</span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <button class="btn btn-warning w-100 mt-3" wire:click="openpaymodal">Pay Now</button>
                            </div>
                        </div>

                        <!-- Schedule Next Payment -->
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">Schedule Next Payment</h6>
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="submit">
                                    <div class="mb-3">
                                        <label for="paymentAmount" class="form-label">Amount</label>
                                        <input type="number" wire:model="amount" class="form-control"
                                            id="paymentAmount" placeholder="Enter amount">
                                    </div>
                                    <div class="mb-3">
                                        <label for="paymentDate" class="form-label">Date</label>
                                        <input type="date" wire:model="date" class="form-control" id="paymentDate">
                                    </div>
                                    <div class="mb-3">
                                        <label for="paymentMethod" class="form-label">Payment Method</label>
                                        <select class="form-select" id="paymentMethod" wire:model="payment_method">
                                            <option selected>Select method</option>
                                            <option>Credit Card</option>
                                            <option>Bank Transfer</option>
                                            <option>Check</option>
                                            <option>Cash</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <span wire:loading.remove>Schedule Payment</span>
                                        <span wire:loading>Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <livewire:admin.dashboard.dep.accounts.customer.account.modal.paynowmodal />
        <livewire:admin.dashboard.dep.accounts.customer.account.modal.receiptmodal />

        <!-- New Expense Modal (hidden by default) -->

    </div>
    <script>
        window.addEventListener('paymentrecordapprovederror', function(event) {
            Swal.fire({
                icon: 'warning', // Change icon to 'error' instead of 'success'
                title: 'warning!',
                text: 'Something went wrong!', // Show the error message
                showConfirmButton: false,
                timer: 5000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('paymentrecordapproved', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Payment received successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
        window.addEventListener('paymentschedule', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Next payment schedule recorded successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('paymentScheduleError', function(event) {
            Swal.fire({
                icon: 'error', // Changed from 'warning' to 'error' for better visual indication
                title: 'Error!',
                text: event.detail.message, // Access the message from event.detail
                showConfirmButton: false,
                timer: 5000,
                toast: true,
                position: 'top-end'
            });
        });
    </script>
</div>
