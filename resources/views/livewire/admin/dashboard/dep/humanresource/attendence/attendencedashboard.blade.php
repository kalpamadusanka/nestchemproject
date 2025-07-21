<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Attendence Management</h4>
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
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Leaves</h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leaves</li>
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

                    <a href="{{ route('admin.dashboard.humanresource.attendence.attendencemonitor') }}" wire:navigate class="btn btn-primary" >
                         Monitor attendance
                    </a>
                    <button class="btn btn-primary" wire:click="openleavemodal">
                        <i class="bi bi-plus-circle"></i> Add Leave
                    </button>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="card-stats d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Total Leaves</p>
                                <h4>{{ $total_leaveform ?? '0' }}</h4>
                            </div>
                            <div class="icon-design" style="width: 50px; height: 50px; background-color: #08cc32; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-alt" style="color: white; font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="card-stats d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Planned Leaves</p>
                                <h4>{{ $total_plannedleave ?? '0' }}</h4>
                            </div>
                            <div class="icon-design" style="width: 50px; height: 50px; background-color: #cc08c2; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-alt" style="color: white; font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="card-stats d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Unplanned Leaves</p>
                                <h4>{{ $total_unplannedleave ?? '0' }}</h4>
                            </div>
                            <div class="icon-design" style="width: 50px; height: 50px; background-color: #f1ba21; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-alt" style="color: white; font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="card-stats d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Pending request</p>
                                <h4>{{ $total_pendingleave ?? '0' }}</h4>
                            </div>
                            <div class="icon-design" style="width: 50px; height: 50px; background-color: #3dcaf5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-alt" style="color: white; font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h4 class="card-title mb-0">Leave List</h4>

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
                                                <div id="datatable_filter" class="dataTables_filter" style="float: right;">
                                                    <label><input type="search" class="form-control form-control-sm" placeholder="Search records" wire:model.live="search" aria-controls="datatable"></label>
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
                                                        aria-label="Name: activate to sort column descending">Employee</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Leave Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Office: activate to sort column ascending">From
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">To</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">No of Days</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1" style="width: 330px;"
                                                        aria-label="Age: activate to sort column ascending">Status</th>
                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatable" rowspan="1" colspan="1"
                                                        style="width: 330px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Employee</th>
                                                    <th rowspan="1" colspan="1">Leave Type</th>
                                                    <th rowspan="1" colspan="1">From</th>
                                                    <th rowspan="1" colspan="1">To</th>
                                                    <th rowspan="1" colspan="1">No of date</th>
                                                    <th rowspan="1" colspan="1">Status</th>
                                                    <th class="disabled-sorting text-right" rowspan="1"
                                                        colspan="1">Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if ($leaves)
                                                @foreach ($leaves as $l)
                                                <tr class="odd">
                                                   <td class="dtr-control sorting_1" tabindex="0">{{ $l->employee->username ?? 'Not updated' }}</td>
                                                   <td>
                                                    @if ($l->leave_type == 'casual_leave')
                                                    Casual Leave
                                                    @elseif ($l->leave_type == 'medical_leave')
                                                    Medical Leave
                                                    @elseif ($l->leave_type == 'annual_leave')
                                                    Annual Leave
                                                    @elseif ($l->leave_type == 'short_leave')
                                                    Short Leave
                                                    @elseif ($l->leave_type == 'half_day')
                                                    Half Day
                                                    @endif
                                                   </td>
                                                   <td>{{ $l->from_date ? \Carbon\Carbon::parse($l->from_date)->format('Y M d h:i A') : 'Not updated' }}</td>
                                                   <td>{{ $l->to_date ? \Carbon\Carbon::parse($l->to_date)->format('Y M d h:i A') : 'Not updated' }}</td>
                                                   <td>{{ $l->no_of_date }} Days</td>
                                                   <td>
                                                    @if ($l->leave_status == 'pending')
                                                    <span class="badge badge-danger">{{ $l->leave_status }}</span>
                                                    @elseif ($l->leave_status == 'approved')
                                                    <span class="badge badge-success">{{ $l->leave_status }}</span>
                                                    @else
                                                    <span class="badge badge-warning">{{ $l->leave_status }}</span>
                                                    @endif

                                                   </td>
                                                   <td class="text-right">

                                                    @if (auth()->user() && auth()->user()->role == 'HR & Administration Executive')
                                                       <a
                                                           class="btn btn-round btn-warning btn-icon btn-sm edit" wire:click="editleave({{ $l->id }})"><i class="fas fa-pencil-alt"></i>
                                                       </a>
                                                    @endif
                                                    @if (auth()->user()->role == 'Superadmin')
                                                    <a href="#"
                                                        class="btn btn-round btn-info btn-icon btn-sm edit" wire:click="viewleave({{ $l->id }})"><i class="fas fa-eye"></i>
                                                    </a>
                                                 @endif

                                                       @if (auth()->user() && auth()->user()->role == 'HR & Administration Executive' || auth()->user()->role == 'Superadmin')

                                                       <a href="#"
                                                       class="btn btn-round btn-success btn-icon btn-sm remove" wire:click="approve({{ $l->id }})"><i
                                                           class="fas fa-check"></i></a>


                                                       <a href="#"
                                                           class="btn btn-round btn-danger btn-icon btn-sm remove" wire:click="reject({{ $l->id }})"><i
                                                           class="fas fa-times"></i></a>
                                                           <a href="#"
                                                           class="btn btn-round btn-danger btn-icon btn-sm remove" wire:click="deleteleave({{ $l->id }})"><i
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
                                                {{ $leaves->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end content-->
                    </div>
                </div>
            </div>

<livewire:admin.dashboard.dep.humanresource.attendence.leavemodal.addleavemodal/>
<livewire:admin.dashboard.dep.humanresource.attendence.leavemodal.editleavemodal/>
<livewire:admin.dashboard.dep.humanresource.attendence.leavemodal.viewleavemodal/>
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
