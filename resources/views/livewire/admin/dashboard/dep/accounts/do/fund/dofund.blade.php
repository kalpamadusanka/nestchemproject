<div>
  <div class="main-panel ps ps--active-y p-2" id="main-panel">
    <!-- Header Section -->
    <div class="header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h4 class="me-3">DO Expenses Management</h4>
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
            <button class="btn btn-primary me-3" wire:click='showdoexpensesmodal'>
                <i class="bi bi-plus-circle me-2"></i>New Expense
            </button>
            <livewire:admin.dashboard.notifylayout />
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-light-primary">
                <div class="card-body">
                    <h6 class="card-title">Total Allocated</h6>
                    <h4 class="mb-0">LKR&nbsp;{{ number_format($allocatedAmount ?? 0, 2) }}</h4>
                    <small class="text-muted">This month</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light-success">
                <div class="card-body">
                    <h6 class="card-title">Total Approved</h6>
                    <h4 class="mb-0">LKR&nbsp;{{ number_format($approvedAmount ?? 0, 2) }}</h4>
                    <small class="text-muted">This month</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light-warning">
                <div class="card-body">
                    <h6 class="card-title">Pending Approval</h6>
                    <h4 class="mb-0">LKR&nbsp;{{ number_format($pendingApprove ?? 0, 2) }}</h4>
                    <small class="text-muted">{{ $requestCountpending ?? 0 }} requests</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light-danger">
                <div class="card-body">
                    <h6 class="card-title">Rejected</h6>
                    <h4 class="mb-0">LKR&nbsp;{{ number_format($rejectedAmount ?? 0, 2) }}</h4>
                    <small class="text-muted">{{ $rejectCountpending ?? 0 }} requests</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Expense List Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Recent Expense Requests</h5>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                    <i class="bi bi-filter me-1"></i> Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">All</a></li>
                    <li><a class="dropdown-item" href="#">Pending</a></li>
                    <li><a class="dropdown-item" href="#">Approved</a></li>
                    <li><a class="dropdown-item" href="#">Rejected</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Rep Name</th>
                            <th>Amount</th>
                            <th>DO</th>
                             <th>Payment Account</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($doexpenses)
                            @foreach ($doexpenses as $exp)
                                <tr>
                            <td>{{ $exp->doData->salePerson->name ?? 'N/A' }}</td>
                           <td>LKR&nbsp;{{ number_format($exp->amount ?? 0, 2) }}</td>
                            <td>{{ $exp->do_no ?? 'N/A' }}</td>
                             <td>{{ $exp->accData->account_name ?? 'N/A' }}</td>
                            <td>{{ $exp->created_at ?? 'N/A' }}</td>
                            <td>
                                @if ($exp->approved == 1)
                                    <span class="badge bg-success">Approved</span>
                                    @elseif ($exp->approved == 2)
                                     <span class="badge bg-danger">Rejected</span>
                                     @else
                                     <span class="badge bg-warning">Pending</span>
                                @endif


                            </td>
                            <td>
                                {{-- @if ($user->role == 'Accountant')
                                <button class="btn btn-sm btn-outline-primary" wire:click="acceptexpenses({{ $exp->id }})">Accept</button>
                                 <button class="btn btn-sm btn-outline-primary" wire:click="rejectexpenses({{ $exp->id }})">Reject</button>
                                @endif --}}
                                 @if ($exp->approved==0)
                                      <button class="btn btn-sm btn-outline-primary" wire:click="acceptexpenses({{ $exp->id }})">Accept</button>
                                         <!-- Button to trigger modal -->
<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#rejectConfirmationModal-{{ $exp->id }}">
    Reject
</button>

<!-- Confirmation Modal -->
<div class="modal fade" id="rejectConfirmationModal-{{ $exp->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectConfirmationModalLabel">Confirm Rejection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Money will be returned to payment account and this action cannot be undone.</p>
                <p>Are you sure you want to reject this expense?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
                <button type="button" class="btn btn-danger" wire:click="rejectexpenses({{ $exp->id }})" data-dismiss="modal">Yes, Reject</button>
            </div>
        </div>
    </div>
</div>
                                @else
                                 <!-- Button to trigger modal -->
<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#rejectConfirmationModal-{{ $exp->id }}">
    Reject
</button>

<!-- Confirmation Modal -->
<div class="modal fade" id="rejectConfirmationModal-{{ $exp->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectConfirmationModalLabel">Confirm Rejection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Money will be returned to payment account and this action cannot be undone.</p>
                <p>Are you sure you want to reject this expense?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
                <button type="button" class="btn btn-danger" wire:click="rejectexpenses({{ $exp->id }})" data-dismiss="modal">Yes, Reject</button>
            </div>
        </div>
    </div>
</div>
                                 @endif

                            </td>
                        </tr>
                            @endforeach
                        @endif


                        <!-- More rows would go here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <nav>
                <ul class="pagination justify-content-center mb-0">
                    {{ $doexpenses->links() }}
                </ul>
            </nav>
        </div>
    </div>

    <!-- New Expense Modal (hidden by default) -->
  <livewire:admin.dashboard.dep.accounts.do.fund.modal.doexpensesmodal/>
  <script>


     window.addEventListener('insufficentfund', function() {


            Swal.fire({
                icon: 'error', // Change icon to 'error' instead of 'success'
                title: 'Error!',
                text: 'Please ensure the account has sufficient balance and try again!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
          window.addEventListener('expensesapproved', function() {


            Swal.fire({
             icon: 'success',
                title: 'Success!',
                text: 'Expenses record has been successfully approved.',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

       window.addEventListener('amountdeducted', function() {
    Swal.fire({
        icon: 'success',
        title: 'Transaction Completed',
        text: 'The payment has been successfully processed and deducted from the account.',
        showConfirmButton: false,
        timer: 3000,
        toast: true,
        position: 'top-end'
    });
});

window.addEventListener('insufficientbalance', function() {
    Swal.fire({
        icon: 'error',
        title: 'Transaction Declined',
        text: 'The payment could not be processed due to insufficient funds in the account.',
        showConfirmButton: false,
        timer: 3000,
        toast: true,
        position: 'top-end'
    });
});


         window.addEventListener('expensesrejected', function() {


            Swal.fire({
               icon: 'success',
                title: 'Success!',
                text: 'Expenses record has been successfully rejected.',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('dofundexpensesadded', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Record added successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
  </script>
</div>
</div>
