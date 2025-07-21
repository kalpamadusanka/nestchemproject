<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Account Book</h4>
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
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Payment </h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Accounts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Account book</li>
                        </ol>
                    </nav>
                </div>

            </div>


            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h4 class="card-title mb-0">Record List</h4>

                        </div>

                        <div class="card-body">

                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="datatable_length"><label>Show <select
                                                    name="datatable_length" aria-controls="datatable"
                                                    class="custom-select custom-select-sm form-control form-control-sm"
                                                    fdprocessedid="95g48">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="-1">All</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-12">
                                                <!-- Search input aligned to the right -->
                                                <div id="datatable_filter"
                                                    class="dataTables_filter d-flex gap-2 justify-content-end align-items-center">
                                                    <label>
                                                        <input type="search" class="form-control form-control-sm"
                                                            placeholder="Search records" wire:model.live="search"
                                                            aria-controls="datatable">
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
                                    <div class="col-sm-12" style="overflow-x: auto; ">
                                        <table id="datatable"
                                            class="table table-striped table-bordered dataTable dtr-inline"
                                            cellspacing="0" width="120%" role="grid"
                                            aria-describedby="datatable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 330px;" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Account
                                                        name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 230px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Payment method</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 230px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Balance Before</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Balance After</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Transaction Type</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Type</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Description</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Added By</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Created at</th>

                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 430px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total Cash In</th>
                                                    <th colspan="2">LKR {{ number_format($totalCashIn, 2, '.', ',') }}</th>
                                                    <th colspan="2">Total Cash Out</th>
                                                    <th colspan="2">LKR {{ number_format($totalCashOut, 2, '.', ',') }}</th>
                                                    <th colspan="2"></th>
                                                </tr>


                                            </tfoot>

                                            <tbody>
                                               @if ($paymenthistorydata)
                                                   @foreach ($paymenthistorydata as $history)
                                                     <tr>
                                                        <td>{{ $history->paymentAccount->account_name ?? 'Not updated'}}</td>
                                                        <td>{{ $history->paymentMethod->payment_method ?? 'Not updated'}}</td>
                                                        <td>LKR {{ number_format($history->amount, 2, '.', ',') }}
                                                        <td>LKR {{ number_format($history->balance_before, 2, '.', ',') }}
                                                        <td>LKR {{ number_format($history->balance_after, 2, '.', ',') }}
                                                        <td>{{ $history->transaction_type }}</td>
                                                        <td>
                                                         @if ($history->type == 'in')
                                                             Cash In
                                                         @else
                                                            Cash Out
                                                         @endif
                                                        </td>
                                                        <td>
                                                         {{ $history->description ?? 'Not Updated'}}
                                                        </td>
                                                        <td>{{ $history->added_user->name ?? 'Not updated' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($history->date)->format('Y M d h.i A') ?? 'Not Updated'}}</td>
                                                        <td>
                                                         @if (auth()->user()->role == 'Superadmin')
                                                         <a href="#"
                                                         class="btn btn-round btn-danger btn-icon btn-sm"
                                                         wire:click="deletedata({{ $history->id }})"><i
                                                             class="fas fa-trash"></i></a>
                                                         @endif
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
                                                {{ $paymenthistorydata->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end content-->
                    </div>
                </div>
            </div>





        </div>
    </div>



</div>
