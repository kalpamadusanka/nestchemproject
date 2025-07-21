<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Expenses Management</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>
        <!-- Activation alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>



        <!-- Grid of Cards -->
        <div class="container">
            <div class="d-flex justify-content-between align-items-center ">
                <div>
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Expenses</h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Company</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Expenses</li>
                        </ol>
                    </nav>
                </div>
                <div class="action-buttons">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="exportDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Export
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                            <li><a class="dropdown-item" href="#">PDF</a></li>
                            <li><a class="dropdown-item" href="#">Excel</a></li>
                        </ul>
                    </div>

                    <a href="{{ route('admin.dashboard.humanresource.expenses.expensecategory.dashboard') }}" wire:navigate class="btn btn-primary" >
                         Expenses categories
                    </a>
                    <a href="{{ route('admin.dashboard.humanresource.expenses.payment.methods.dashboard') }}" wire:navigate class="btn btn-primary" >
                        Payment Methods
                   </a>
                    <button class="btn btn-primary" wire:click="addexpenses">
                        <i class="bi bi-plus-circle"></i> Add Expenses
                    </button>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card p-3">
                        <div class="card-stats d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Total Expenses</p>

                                <h5>LKR {{ $total_expenses ? number_format($total_expenses, 2) : '0.00' }}</h5>
                            </div>
                            <div class="icon-design" style="width: 50px; height: 50px; background-color: #08cc32; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-coins" style="color: white; font-size: 24px;"></i>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <div class="card-stats d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Company Expenses</p>

                                <h5> LKR {{ $company_expenses ? number_format($company_expenses, 2) : '0.00' }}</h5>
                            </div>
                            <div class="icon-design" style="width: 50px; height: 50px; background-color: #cc08c2; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-coins" style="color: white; font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <div class="card-stats d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Employee Expenses</p>

                                <h5>LKR {{ $employee_expenses ? number_format($employee_expenses, 2) : '0.00' }}</h5>
                            </div>
                            <div class="icon-design" style="width: 50px; height: 50px; background-color: #f1ba21; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-coins" style="color: white; font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h4 class="card-title mb-0">Expenses List</h4>

                        </div>

                        <div class="card-body">

                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">

                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-12">
                                                <!-- Search input aligned to the right -->
                                                <div id="datatable_filter" class="dataTables_filter d-flex gap-2 justify-content-end align-items-center">
                                                    <label>
                                                        <input type="search" class="form-control form-control-sm" placeholder="Search records" wire:model.live="search" aria-controls="datatable">
                                                    </label>
                                                    <div class="d-flex gap-2">
                                                        <div class="form-group">

                                                            <input type="text" id="date-range" class="form-control form-control-sm" wire:model="daterange"
                                                                placeholder="Select date range">
                                                        </div>
                                                        <script>
                                                            document.addEventListener('livewire:navigated', () => {
                                                                flatpickr("#date-range", {
                                                                    mode: "range",
                                                                    dateFormat: "Y-m-d", // Customize as needed
                                                                    wrap: false, // Set to false if you are not using a wrapper element
                                                                    onReady: function(selectedDates, dateStr, instance) {
                                                                        // Create and append the "Apply" button
                                                                        const applyButton = document.createElement("button");
                                                                        applyButton.type = "button";
                                                                        applyButton.innerText = "Apply";
                                                                        applyButton.className =
                                                                        "flatpickr-apply-btn btn btn-primary mt-2"; // Add custom styles if needed

                                                                        // Append the button below the calendar
                                                                        instance.calendarContainer.appendChild(applyButton);

                                                                        // Handle "Apply" button click
                                                                        applyButton.addEventListener("click", () => {
                                                                            // Trigger Livewire model update with selected date range
                                                                            const dateRange = instance.input.value;
                                                                            @this.set('daterange', dateRange);
                                                                            @this.call('applyDate');
                                                                            // Close the Flatpickr calendar
                                                                            instance.close();
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable"
                                            class="table table-striped table-bordered dataTable dtr-inline"
                                            cellspacing="0" width="100%" role="grid"
                                            aria-describedby="datatable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 330px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Expenses For</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Transaction No</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Office: activate to sort column ascending">Expenses Category
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">Amount</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">Date</th>
                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 330px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" class="text-end">Total:</th>
                                                    <th>LKR {{ number_format($expenses->sum('amount'), 2) }}</th>
                                                    <th colspan="3"></th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                             @if ($expenses)
                                                 @foreach ($expenses as $expense)
                                                     <tr>
                                                        <td>{{ $expense->expense_for ?? 'Not Updated' }}</td>
                                                        <td>{{ $expense->transcation_no ?? 'Not Updated' }}</td>
                                                        <td>{{ $expense->expenses_category ?? 'Not Updated' }}</td>
                                                        <td>{{ $expense->currency }}&nbsp;{{ $expense->amount ? number_format($expense->amount, 2) : 'Not Updated' }}</td>
                                                        <td>
                                                            @if ($expense->status == 0)
                                                            <span class="badge badge-danger">Deactive</span>

                                                            @else
                                                            <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $expense->created_at->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-right">

                                                            <a href="#"
                                                            class="btn btn-round btn-info btn-icon btn-sm remove" wire:click="viewexpensedetails({{ $expense->id }})"><i
                                                                class="fas fa-eye"></i></a>
                                                                <a href="#"
                                                                class="btn btn-round btn-warning btn-icon btn-sm remove" wire:click="viewexpensedoc({{ $expense->id }})"><i
                                                                    class="fas fa-file"></i></a>



                                                                    <a href="#"
                                                                    class="btn btn-round btn-danger btn-icon btn-sm remove" wire:click="deleteexpenses({{ $expense->id }})"><i
                                                                        class="fas fa-trash"></i></a>

                                                        </td>
                                                     </tr>
                                                 @endforeach
                                             @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_full_numbers" id="datatable_paginate">
                                            <ul class="pagination">
                                                {{ $expenses->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end content-->
                    </div>
                </div>
            </div>

            <livewire:admin.dashboard.dep.humanresource.expenses.modal.addexpensesmodal/>
            <livewire:admin.dashboard.dep.humanresource.expenses.modal.viewexpensedocmodal/>
            <livewire:admin.dashboard.dep.humanresource.expenses.modal.viewexpensesdetailsmodal/>

        </div>
    </div>

    <style>
      .card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-stats {
    padding: 10px;
}

.icon {
    display: flex;
    align-items: center;
    justify-content: center;
}
.icon-design {
    background-color: #007bff;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}
        .icon-container {
            font-size: 30px;
            color: #007bff;
        }

        .dashboard-title {
            margin-top: 20px;
            font-size: 18px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }

        .alert {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            margin-bottom: 20px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }

        .nav-link {
            color: #000;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #007bff;
        }

        .btn-new {
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .btn-new:hover {
            background-color: #6c757d;
            color: #fff;
        }

        .notification-badge {
            background-color: #dc3545;
            color: #fff;
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 14px;
        }

        .profile-icon {
            width: 30px;
            height: 30px;
            background-color: #6c757d;
            color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card .card-header {
            font-size: 1.2rem;
            font-weight: bold;
            background-color: transparent;
            border-bottom: none;
        }

        .card-stats {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-stats .icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .ticket-item {
            background: #ffffff;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .ticket-item .badge {
            font-size: 0.9rem;
            padding: 0.4em 0.8em;
            border-radius: 12px;
        }

        .ticket-categories {
            background: #ffffff;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .ticket-categories h5 {
            margin-bottom: 1rem;
        }

        .ticket-categories .list-group-item {
            border: none;
            padding: 0.5rem 1rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons .btn {
            border-radius: 12px;
        }
    </style>
</div>
