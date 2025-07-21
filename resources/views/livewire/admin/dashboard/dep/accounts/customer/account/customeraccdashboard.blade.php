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
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical text-gray-400"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">View All</a></li>
                        <li><a class="dropdown-item" href="#">Export</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
    <div class="col-md-6">
        <form wire:submit.prevent="searchCustomer">
            <div class="input-group">
                <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Search by name, email, phone...">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>To be paid</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($customeracc)
                                @foreach ($customeracc as $acc)
                                   <tr>
                                     <td>{{ $acc->id ?? 1 }}</td>
                                    <td>{{ $acc->company_name ?? 'N/A' }}</td>
                                    <td>{{ $acc->address ?? 'N/A' }}</td>
                                    <td>{{ $acc->contact_person ?? 'N/A' }}</td>
                                    <td>{{ $acc->email ?? 'N/A' }}</td>
                                    <td>{{ $acc->phone ?? 'N/A' }}</td>
                                    <td style="color: red;">LKR&nbsp;{{ number_format($acc->to_be_paid ?? 0, 2) }}</td>
                                    <td>
                                        @if ($acc->status == 1)
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Deactive</span>
                                        @endif

                                    </td>
                                    <td>
                                         @php
                                            $encryptedCusId = encrypt($acc->id);
                                        @endphp
                                        <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.dashboard.accounts.customer.payments.view', ['encryptedcusId' => $encryptedCusId]) }}"
                                                wire:navigate>
                                                Payments
                                            </a>
                                        </td>
                                   </tr>
                                @endforeach

                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- New Expense Modal (hidden by default) -->
        <livewire:admin.dashboard.dep.accounts.do.fund.modal.doexpensesmodal />
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
