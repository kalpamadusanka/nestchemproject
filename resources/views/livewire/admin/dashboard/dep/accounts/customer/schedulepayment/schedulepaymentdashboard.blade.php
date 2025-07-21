<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <h4 class="me-3">Payment Schedule Dashboard</h4>

            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary me-3" onclick="window.history.back()">
                    <i class="bi bi-arrow-left-circle me-2"></i>Back
                </button>
                <livewire:admin.dashboard.notifylayout />
            </div>
        </div>

        <!-- Stats Cards Row -->
        {{-- <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card bg-success-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Completed</h6>
                            <h3 class="mb-0">1,254</h3>
                        </div>
                        <div class="bg-success rounded-circle p-3">
                            <i class="bi bi-check-circle-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-warning-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Pending</h6>
                            <h3 class="mb-0">328</h3>
                        </div>
                        <div class="bg-warning rounded-circle p-3">
                            <i class="bi bi-clock-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: 20%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-danger-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Failed</h6>
                            <h3 class="mb-0">42</h3>
                        </div>
                        <div class="bg-danger rounded-circle p-3">
                            <i class="bi bi-exclamation-triangle-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-danger" style="width: 5%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-info-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Upcoming</h6>
                            <h3 class="mb-0">87</h3>
                        </div>
                        <div class="bg-info rounded-circle p-3">
                            <i class="bi bi-calendar2-event-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: 15%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

        <!-- Main Content Area -->
        <div class="row">
            <!-- Schedule List -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Payment Schedules</h5>
                        <div class="input-group" style="width: 250px;" hidden>
                            <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search schedules...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Schedule Date</th>
                                        <th>Amount</th>

                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($schedulepayment)
                                        @foreach ($schedulepayment as $schedule)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">

                                                        <div>
                                                            <h6 class="mb-0">
                                                                {{ $schedule->scheduleData->customerData->company_name ?? 'N/A' }}
                                                            </h6>
                                                            <small
                                                                class="text-muted">{{ $schedule->scheduleData->customerData->email ?? 'N/A' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>

                                                    @php
                                                        $scheduleDate = \Carbon\Carbon::parse(
                                                            $schedule->scheduleData->date,
                                                        );
                                                        $today = \Carbon\Carbon::today();

                                                        if ($scheduleDate->isSameDay($today)) {
                                                            echo 'Today';
                                                        } elseif ($scheduleDate->isSameDay($today->copy()->subDay())) {
                                                            echo 'Yesterday';
                                                        } elseif ($scheduleDate->isSameDay($today->copy()->addDay())) {
                                                            echo 'Tomorrow';
                                                        } else {
                                                            echo $schedule->date;
                                                        }
                                                    @endphp
                                                </td>
                                                <td>LKR&nbsp;{{ number_format($schedule->scheduleData->amount ?? 0, 2) }}
                                                </td>

                                                <td><span class="badge bg-success-light text-success">Active</span></td>
                                                <td>
                                                    @if ($schedule->scheduleData->taken_by == null)
                                                         <button class="btn btn-sm btn-outline-primary" wire:click="markasreceived({{ $schedule->payment_schedule_id }})">Mark as received</i></button>
                                                    @else
                                                         <button class="btn btn-sm btn-outline-primary" >Received</i></button>
                                                    @endif


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
                                    {{ $schedulepayment->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar and Quick Actions -->
            <div class="col-lg-4">
                <div class="card mb-4">

                    <div class="card-body">
                        <div class="calendar-container">
                            <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                                <button class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-chevron-left"></i></button>
                               <h6 class="mb-0 fw-bold"><?php echo date('F Y'); ?></h6>
                                <button class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-chevron-right"></i></button>
                            </div>

                            <!-- Calendar Stats Summary -->
                            <div class="row mb-3 g-2">
                                <div class="col-md-4">
                                    <div class="border rounded p-2 text-center bg-light">
                                        <small class="text-muted d-block">Today's Scheduled</small>
                                        <h5 class="mb-0 text-primary">{{ $todayscheduleCount ?? 0 }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-2 text-center bg-light">
                                        <small class="text-muted d-block">Total Scheduled</small>
                                        <h5 class="mb-0 text-info">{{ $totalschedule ?? 0 }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-2 text-center bg-light">
                                        <small class="text-muted d-block">Today's Completed</small>
                                        <h5 class="mb-0 text-success">{{ $todaycompleted ?? 0 }}</h5>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Today's Payments Section -->
                        <div class="today-payments border-top pt-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-muted mb-0">Today's Payments</h6>
                                @php
                                    $today = \Carbon\Carbon::today()->toDateString();
                                @endphp
                                <span class="badge bg-primary rounded-pill">{{ $today }}</span>
                            </div>

                            <div class="list-group mb-3">
                               @if ($todaypayments)
                                   @foreach ($todaypayments as $payment)
                                         <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold">{{ $payment->customerData->company_name ?? 'N/A' }}</span>
                                            <small class="d-block text-muted">Invoice {{ $payment->invoice_no ?? 'N/A' }}</small>
                                        </div>
                                        <div class="text-end">
                                            <span class="d-block">LKR&nbsp;{{ number_format($payment->amount ?? 0, 2) }}</span>
                                            @if ($payment->status == 1)
                                                 <small class="badge bg-success">Completed</small>
                                            @elseif($payment->approved == 0)
                                                <small class="badge bg-secondary">Approval pending</small>
                                            @endif

                                        </div>
                                    </div>
                                </a>
                                   @endforeach
                               @endif


                            </div>

                            <div class="d-grid" hidden>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-plus-circle me-1"></i> Add Payment for Today
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-outline-primary w-100 mb-2">
                            <i class="bi bi-file-earmark-text me-2"></i> Generate Report
                        </button>
                        <button class="btn btn-outline-success w-100 mb-2" hidden>
                            <i class="bi bi-send-check me-2"></i> Send Reminders
                        </button>
                        <button class="btn btn-outline-danger w-100">
                            <i class="bi bi-slash-circle me-2"></i> Cancel Schedule
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Schedule Modal (would be at the bottom of the page) -->
    <div class="modal fade" id="newScheduleModal" tabindex="-1" aria-hidden="true">
        <!-- Modal content would go here -->
    </div>

<script>
       window.addEventListener('markasreceived', function() {


            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Mark as received successfully!',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        });
</script>
</div>
